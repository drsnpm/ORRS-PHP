<!--Start Server side code to give us and hold session-->
<?php
session_start();
include('assets/inc/config.php');
include('assets/inc/checklogin.php');
check_login();
$aid = $_SESSION['pass_id'];

// Fetch user details before processing form submission
$ret = "SELECT * FROM orrs_passenger WHERE pass_id = ?";
$stmt = $mysqli->prepare($ret);
$stmt->bind_param('i', $aid);
$stmt->execute();
$res = $stmt->get_result();
$passenger_data = $res->fetch_assoc(); // Fetch data as associative array

if (isset($_POST['train_fare_confirm_checkout'])) {
    // Check to prevent duplicate submission within 10 seconds
    if (isset($_SESSION['train_fare_confirm_checkout_clicked_time']) && (time() - $_SESSION['train_fare_confirm_checkout_clicked_time']) <= 10) {
        $err = "Ticket payment confirmed! Please take a printout";
    } else {
        $_SESSION['train_fare_confirm_checkout_clicked_time'] = time();

        // Set variables, falling back to fetched data if $_POST variables are not set
        $pass_id = $aid;
        $pass_name = $_POST['pass_name'] ?? $passenger_data['pass_fname'] . ' ' . $passenger_data['pass_lname'];
        $pass_addr = $_POST['pass_addr'] ?? $passenger_data['pass_addr'];
        $pass_email = $_POST['pass_email'] ?? $passenger_data['pass_email'];
        $train_name = $_POST['train_name'];
        $train_no = $_POST['train_no'];
        $pass_train_route = $_POST['pass_train_route'];
        $train_dep_date = $_POST['train_dep_date'];
        $train_arr_time = $_POST['train_arr_time'];
        $train_dep_time = $_POST['train_dep_time'];
        $train_fare = $_POST['train_fare'];
        $fare_payment_code = $_POST['fare_payment_code'];

        // Insert ticket information
        $query = "INSERT INTO orrs_train_tickets (pass_id, pass_name, pass_addr, pass_email, train_no, train_name, pass_train_route, train_dep_date, train_dep_time, train_arr_time, train_fare, fare_payment_code) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('ssssssssssss', $pass_id, $pass_name, $pass_addr, $pass_email, $train_no, $train_name, $pass_train_route, $train_dep_date, $train_dep_time, $train_arr_time, $train_fare, $fare_payment_code);
        $stmt->execute();

        if ($stmt) {
            // Clear passenger reservation details
            $query_clear_pass_fare_payment = "UPDATE orrs_passenger 
                                              SET pass_fare_payment_code = '', pass_train_number = '', pass_train_name = '', pass_train_route = '', pass_train_fare = '', pass_dep_date = '', pass_dep_station_time = '', pass_arr_station_time = '', pass_train_fare = ''
                                              WHERE pass_id = ?";
            $stmt_clear_pass_fare_payment = $mysqli->prepare($query_clear_pass_fare_payment);
            $stmt_clear_pass_fare_payment->bind_param('i', $aid);
            $stmt_clear_pass_fare_payment->execute();
            
            if ($stmt_clear_pass_fare_payment) {
                $succ = "Ticket Payment Confirmed";
            } else {
                $err = "Error clearing passenger data, please try again.";
            }
        } else {
            $err = "Please Try Again Later";
        }
    }
}
?>
<!--End Server side scriptiing-->
<!DOCTYPE html>
<html lang="en">
<!--HeAD-->
  <?php include('assets/inc/head.php');?>
 <!-- end HEAD--> 
  <body>
    <div class="be-wrapper be-fixed-sidebar">
    <!--navbar-->
      <?php include('assets/inc/navbar.php');?>
      <!--End navbar-->
      <!--Sidebar-->
      <?php include('assets/inc/sidebar.php');?>
      <!--End Sidebar-->

      <div class="be-content">
      <div class="page-head">
          <h2 class="page-head-title">Confirm Checkout Tickets</h2>
          <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb page-head-nav">
              <li class="breadcrumb-item"><a href="pass-dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="">Train Tickets</a></li>
              <li class="breadcrumb-item active">Confirm Checkout</li>
            </ol>
          </nav>
        </div>
        <?php if(isset($succ)) {?>
            <script>
                setTimeout(function () { 
                    swal("Success!", "<?php echo $succ;?>!", "success");
                }, 100);
            </script>
        <?php } ?>
        <?php if(isset($err)) {?>
            <script>
                setTimeout(function () { 
                    swal("Failed!", "<?php echo $err;?>!", "error");
                }, 100);
            </script>
        <?php } ?>
        
        <div class="main-content container-fluid">
          <div class="row">
            <div class="col-sm-12">
              <div class="card card-table">
              
              <?php
              /**
               * We need to get firstname or username of logged in user!!
               */         
                $aid=$_SESSION['pass_id'];
                $ret="select * from orrs_passenger where pass_id=?";
                $stmt= $mysqli->prepare($ret) ;
                $stmt->bind_param('i',$aid);
                $stmt->execute() ;//ok
                $res=$stmt->get_result();
                //$cnt=1;
                while($row=$res->fetch_object())
                 {
                    ?>
                <div class="card-header"><?php echo $row->pass_fname;?> <?php echo $row->pass_lname;?>  This Is Your Booked Train Ticket Proceed to Confirm checkout your ticket!</div>
                <?php }?>             
                

                <div class="card-body">
                  <table class="table table-striped table-bordered table-hover table-fw-widget" id="table1">
                    <thead class="thead-dark">
                      <tr>
                        <th>Train Number</th>
                        <th>Train</th>
                        <th>Route</th>
                        <th>Departure Date</th>
                        <th>Departure Time</th>
                        <th>Arrival Time</th>
                        <th>Amount</th>
                        <th>Payment Code</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                        /**
                         *Lets select train booking details of logged in user using PASSENGER ID as the session
                         */
                            //$aid=$_SESSION['pass_id'];
                            $ret="SELECT * from orrs_passenger WHERE pass_id=? && pass_fare_payment_code !=''";//sql to get details of our user
                            $stmt= $mysqli->prepare($ret) ;
                            $stmt->bind_param('i',$aid);
                            $stmt->execute() ;//ok
                            $res=$stmt->get_result();
                            //$cnt=1;
                        while($row=$res->fetch_object())
                        {
                        ?>
                      <tr>
                          <td><?php echo $row->pass_train_number; ?></td>
                          <td><?php echo $row->pass_train_name; ?></td>
                          <td><?php echo $row->pass_train_route; ?></td>
                          <td><?php echo $row->pass_dep_date; ?></td>
                          <td><?php echo $row->pass_dep_station_time; ?></td>
                          <td><?php echo $row->pass_arr_station_time; ?></td>
                          <td>₹<?php echo $row->pass_train_fare; ?></td>
                          <td><?php echo $row->pass_fare_payment_code; ?></td>
                          <td>
                            <form method="post" action="">
                              <input type="hidden" name="train_no" value="<?php echo $row->pass_train_number; ?>">
                              <input type="hidden" name="train_name" value="<?php echo $row->pass_train_name; ?>">
                              <input type="hidden" name="pass_train_route" value="<?php echo $row->pass_train_route; ?>">
                              <input type="hidden" name="train_dep_date" value="<?php echo $row->pass_dep_date; ?>">
                              <input type="hidden" name="train_dep_time" value="<?php echo $row->pass_dep_station_time; ?>">
                              <input type="hidden" name="train_arr_time" value="<?php echo $row->pass_arr_station_time; ?>">
                              <input type="hidden" name="train_fare" value="<?php echo $row->pass_train_fare; ?>">
                              <input type="hidden" name="fare_payment_code" value="<?php echo $row->pass_fare_payment_code; ?>">
                              <button name="train_fare_confirm_checkout" type="submit" class="btn btn-sm btn-success">Confirm Payment</button>
                            </form>
                          </td>
                        </tr>
                        <?php }?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
         
         <!--footer-->
         <?php include('assets/inc/footer.php');?>
         <!--End Footer-->
        </div>
      </div>
     
    </div>
    <script src="assets/lib/jquery/jquery.min.js" type="text/javascript"></script>
    <script src="assets/lib/perfect-scrollbar/js/perfect-scrollbar.min.js" type="text/javascript"></script>
    <script src="assets/lib/bootstrap/dist/js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <script src="assets/js/app.js" type="text/javascript"></script>
    <script src="assets/lib/datatables/datatables.net/js/jquery.dataTables.js" type="text/javascript"></script>
    <script src="assets/lib/datatables/datatables.net-bs4/js/dataTables.bootstrap4.js" type="text/javascript"></script>
    <script src="assets/lib/datatables/datatables.net-buttons/js/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="assets/lib/datatables/datatables.net-buttons/js/buttons.flash.min.js" type="text/javascript"></script>
    <script src="assets/lib/datatables/jszip/jszip.min.js" type="text/javascript"></script>
    <script src="assets/lib/datatables/pdfmake/pdfmake.min.js" type="text/javascript"></script>
    <script src="assets/lib/datatables/pdfmake/vfs_fonts.js" type="text/javascript"></script>
    <script src="assets/lib/datatables/datatables.net-buttons/js/buttons.colVis.min.js" type="text/javascript"></script>
    <script src="assets/lib/datatables/datatables.net-buttons/js/buttons.print.min.js" type="text/javascript"></script>
    <script src="assets/lib/datatables/datatables.net-buttons/js/buttons.html5.min.js" type="text/javascript"></script>
    <script src="assets/lib/datatables/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js" type="text/javascript"></script>
    <script src="assets/lib/datatables/datatables.net-responsive/js/dataTables.responsive.min.js" type="text/javascript"></script>
    <script src="assets/lib/datatables/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(document).ready(function(){
      	//-initialize the javascript
      	App.init();
      	App.dataTables();
      });
    </script>
  </body>

</html>
<?php
  session_start();
  include('assets/inc/config.php');
  include('assets/inc/checklogin.php');
  check_login();
  $aid=$_SESSION['pass_id'];
?>
<!DOCTYPE html>
<html lang="en">
  <!--Head-->
    <?php include('assets/inc/head.php');?>
  <!--End Head-->
  <body>
    <div class="be-wrapper be-fixed-sidebar">
    <!--Nav Bar-->
      <?php include('assets/inc/navbar.php');?>
      <!--End Navbar-->
      <!--Sidebar-->
        <?php include('assets/inc/sidebar.php');?>
      <!--End Sidebar-->
      <div class="be-content">
        <div class="page-head">
          <h2 class="page-head-title">Train Ticket</h2>
          <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb page-head-nav">
              <li class="breadcrumb-item"><a href="#">Dashbaord</a></li>
              <li class="breadcrumb-item"><a href="#">Tickets</a></li>
              <li class="breadcrumb-item active">Print</li>
            </ol>
          </nav>
        </div>
        <div class="main-content container-fluid">
          <div class="row">
            <div class="col-sm-12">
              <div class="card card-table">
                <div class="card-header">Print Your Train Tickets                
                </div>
                <div class="card-body">
                  <table class="table table-striped table-bordered table-hover table-fw-widget" id="table1">
                    <thead class="thead-dark">
                      <tr>
                        <th>Train Number</th>
                        <th>Train Name</th>
                        <th>Train Route</th>
                        <th>Departure Date</th>
                        <th>Departure Time</th>
                        <th>Arrival Time</th>
                        <th>Amount</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    //Let's select train booking details of logged-in user using PASSENGER ID as the session
                    //$aid=$_SESSION['pass_id'];
                    $pass_id = $_SESSION['pass_id'];
                    $ret = "SELECT * FROM orrs_train_tickets WHERE pass_id=? AND confirmation !='Approved'";// ORDER BY ticket_id DESC LIMIT 1";
                    $stmt = $mysqli->prepare($ret);
                    $stmt->bind_param("s", $pass_id);
                    $stmt->execute();
                    $res = $stmt->get_result();
                    while ($row = $res->fetch_object())
                    {
                    ?>
                    <tr>
                        <td><?php echo $row->train_no;?></td>
                        <td><?php echo $row->train_name;?></td>
                        <td><?php echo $row->pass_train_route;?></td>
                        <td><?php echo $row->train_dep_date;?></td>
                        <td><?php echo $row->train_dep_time;?></td>
                        <td><?php echo $row->train_arr_time;?></td>
                        <td>₹<?php echo $row->train_fare;?></td>
                        <td class="center">
                            <!-- <a class ="badge badge-danger" href ="pass-cancel-train.php?del=<?php echo $row->pass_id;?>">Cancel</a> -->
                            <a class ="badge badge-primary" href ="pass-print-specific-ticket.php?ticket_id=<?php echo $row->ticket_id;?>">Print</a>
                            <!-- <a href="pass-cancel-train.php?del=<?php echo $row->ticket_id;?>"><button class="btn btn-danger btn-sm">Cancel</button></a>   -->
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
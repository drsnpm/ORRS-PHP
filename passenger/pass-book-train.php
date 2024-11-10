<?php
session_start();
include('assets/inc/config.php');
include('assets/inc/checklogin.php');
check_login();
$aid = $_SESSION['pass_id'];

if (isset($_POST['Book_Train'])) {
    if (isset($_SESSION['Book_Train_clicked_time']) && (time() - $_SESSION['Book_Train_clicked_time']) <= 10) {
        $err = "Train already reserved! Please proceed to check out.";
    } else {
        $_SESSION['Book_Train_clicked_time'] = time();
        $pass_train_number = $_POST['pass_train_number'];
        $pass_train_name = $_POST['pass_train_name'];
        $pass_train_route = $_POST['pass_train_route'];
        $pass_dep_date = $_POST['pass_dep_date'];
        $pass_dep_station_time = $_POST['pass_dep_station_time'];
        $pass_arr_station_time = $_POST['pass_arr_station_time'];
        $pass_train_fare = $_POST['pass_train_fare'];
        
        // SQL to update the passenger table with the new information
        $query = "UPDATE orrs_passenger SET pass_train_number = ?, pass_train_name = ?, pass_train_route = ?, pass_dep_date = ?, pass_dep_station_time = ?, pass_arr_station_time = ?, pass_train_fare = ? WHERE pass_id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('sssssssi', $pass_train_number, $pass_train_name, $pass_train_route, $pass_dep_date, $pass_dep_station_time, $pass_arr_station_time, $pass_train_fare, $aid);
        $stmt->execute();
        
        if ($stmt) {
            $succ = "Train reserved! Please proceed to check out.";
        } else {
            $err = "Please try again later.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('assets/inc/head.php'); ?>
<body>
    <div class="be-wrapper be-fixed-sidebar">
        <?php include('assets/inc/navbar.php'); ?>
        <?php include('assets/inc/sidebar.php'); ?>

        <div class="be-content">
            <div class="page-head">
                <h2 class="page-head-title">Book Train</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb page-head-nav">
                        <li class="breadcrumb-item"><a href="pass">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Book Train</a></li>
                        <li class="breadcrumb-item active">Reserve Train</li>
                    </ol>
                </nav>
            </div>

            <div class="main-content container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-table">
                            <div class="card-header">Please Book Your Train Accordingly</div>
                            <?php if(isset($succ)) { ?>
                                <script>
                                    setTimeout(function() {
                                        swal("Success!", "<?php echo $succ; ?>", "success");
                                    }, 100);
                                </script>
                            <?php } ?>
                            <?php if(isset($err)) { ?>
                                <script>
                                    setTimeout(function() {
                                        swal("Failed!", "<?php echo $err; ?>", "error");
                                    }, 100);
                                </script>
                            <?php } ?>
                            <div class="card-body">
                                <table class="table table-striped table-bordered table-hover" id="table1">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Train Number</th>
                                            <th>Train</th>
                                            <th>Route</th>
                                            <th>Departure Date</th>
                                            <th>Departure Time</th>
                                            <th>Arrival Time</th>
                                            <th>Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $ret = "SELECT * FROM orrs_train";
                                        $stmt = $mysqli->prepare($ret);
                                        $stmt->execute();
                                        $res = $stmt->get_result();
                                        
                                        while ($row = $res->fetch_object()) {
                                        ?>
                                            <tr>
                                                <td><?php echo $row->number; ?></td>
                                                <td><?php echo $row->name; ?></td>
                                                <td><?php echo $row->route; ?></td>
                                                <td><?php echo $row->date; ?></td>
                                                <td><?php echo $row->departure_time; ?></td>
                                                <td><?php echo $row->arrival_time; ?></td>
                                                <td>₹<?php echo $row->fare; ?></td>
                                                <td>
                                                    <form method="post" action="">
                                                        <input type="hidden" name="pass_train_number" value="<?php echo $row->number; ?>">
                                                        <input type="hidden" name="pass_train_name" value="<?php echo $row->name; ?>">
                                                        <input type="hidden" name="pass_train_route" value="<?php echo $row->route; ?>">
                                                        <input type="hidden" name="pass_dep_date" value="<?php echo $row->date; ?>">
                                                        <input type="hidden" name="pass_dep_station_time" value="<?php echo $row->departure_time; ?>">
                                                        <input type="hidden" name="pass_arr_station_time" value="<?php echo $row->arrival_time; ?>">
                                                        <input type="hidden" name="pass_train_fare" value="<?php echo $row->fare; ?>">
                                                        <button class="btn btn-success btn-sm" name="Book_Train" type="submit">Book</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include('assets/inc/footer.php'); ?>
            </div>
        </div>
    </div>
    <script src="assets/lib/jquery/jquery.min.js"></script>
    <script src="assets/lib/perfect-scrollbar/js/perfect-scrollbar.min.js"></script>
    <script src="assets/lib/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/lib/datatables/datatables.net/js/jquery.dataTables.js"></script>
    <script src="assets/lib/datatables/datatables.net-bs4/js/dataTables.bootstrap4.js"></script>
    <script src="assets/lib/datatables/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="assets/lib/datatables/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="assets/lib/datatables/jszip/jszip.min.js"></script>
    <script src="assets/lib/datatables/pdfmake/pdfmake.min.js"></script>
    <script src="assets/lib/datatables/pdfmake/vfs_fonts.js"></script>
    <script src="assets/lib/datatables/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="assets/lib/datatables/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="assets/lib/datatables/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="assets/lib/datatables/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="assets/lib/datatables/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/lib/datatables/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script>
      $(document).ready(function(){
        App.init();
        App.dataTables();
      });
    </script>
</body>
</html>

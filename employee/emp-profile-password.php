<?php
session_start();
include('assets/inc/config.php');
//date_default_timezone_set('Africa/Nairobi');
include('assets/inc/checklogin.php');
check_login();
$aid = $_SESSION['emp_id'];

if (isset($_POST['Update_Password'])) {
    $aid = $_SESSION['emp_id'];
    $emp_pwd_old = sha1(md5($_POST['emp_pwd'])); // Old password provided by user
    $emp_pwd_new = sha1(md5($_POST['emp_new_pwd'])); // New password provided by user
    
    // Check if old password matches
    $query_select_pwd = "SELECT emp_pwd FROM orrs_employee WHERE emp_id = ?";
    $stmt_select_pwd = $mysqli->prepare($query_select_pwd);
    $stmt_select_pwd->bind_param('i', $aid);
    $stmt_select_pwd->execute();
    $stmt_select_pwd->store_result();
    
    if ($stmt_select_pwd->num_rows > 0) {
        $stmt_select_pwd->bind_result($emp_pwd_db);
        $stmt_select_pwd->fetch();
        
        if ($emp_pwd_old === $emp_pwd_db) { // Check if old password matches the one in the database
            if ($emp_pwd_old !== $emp_pwd_new) { // Check if new password is different from old password
                // Update password
                $query_update_pwd = "UPDATE orrs_employee SET emp_pwd = ? WHERE emp_id = ?";
                $stmt_update_pwd = $mysqli->prepare($query_update_pwd);
                $stmt_update_pwd->bind_param('si', $emp_pwd_new, $aid);
                $stmt_update_pwd->execute();
                
                if ($stmt_update_pwd) {
                    $succ1 = "Password Updated";
                } else {
                    $err = "Please Try Again Later";
                }
            } else {
                $err = "Enter a new password different from the previous one";
            }
        } else {
            $err = "Incorrect old password. Please try again.";
        }
    } else {
        $err = "User not found.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<!--Head-->
<?php include('assets/inc/head.php');?>
<!--End Head-->
  <body>
    <div class="be-wrapper be-fixed-sidebar ">
    <!--Navigation Bar-->
      <?php include('assets/inc/navbar.php');?>
      <!--End Navigation Bar-->

      <!--Sidebar-->
      <?php include('assets/inc/sidebar.php');?>
      <!--End Sidebar-->
      <div class="be-content">
        <div class="page-head">
          <h2 class="page-head-title">Profile </h2>
          <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb page-head-nav">
              <li class="breadcrumb-item"><a href="pass-dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="#">Profile</a></li>
              <li class="breadcrumb-item active">Change Password | Profile Photo </li>
            </ol>mjknjnj
          </nav>
        </div>
        <?php if(isset($succ1)) {?>
                                <!--This code for injecting an alert-->
                <script>
                            setTimeout(function () 
                            { 
                                swal("Success!","<?php echo $succ1;?>!","success");
                            },
                                100);
                </script>

        <?php } ?>
        <?php if(isset($err)) {?>
  <!--This code for injecting an alert-->
      <script>
            setTimeout(function () 
            { 
              swal("Failed!","<?php echo $err;?>!","error");
            },
              100);
      </script>
					
			<?php } ?>
        <div class="main-content container-fluid">
        <?php
            $aid=$_SESSION['emp_id'];
            $ret="select * from orrs_employee where emp_id=?";
            $stmt= $mysqli->prepare($ret) ;
            $stmt->bind_param('i',$aid);
            $stmt->execute() ;//ok
            $res=$stmt->get_result();
            //$cnt=1;
            while($row=$res->fetch_object())
        {
        ?>     
            <div class="col-md-12">
              <div class="card card-border-color card-border-color-success">
                <div class="card-header card-header-divider">Change Password<span class="card-subtitle">Fill All Details</span></div>
                <div class="card-body">
                  <form method ="POST" >
                    <div class="form-group row">
                      <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3">Old Password</label>
                      <div class="col-12 col-sm-8 col-lg-6">
                        <input class="form-control" name="emp_pwd" id="inputText3" type="password" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3">New Password</label>
                      <div class="col-12 col-sm-8 col-lg-6">
                        <input class="form-control" name="emp_new_pwd"  id="inputText3" type="password" minlength="8" required>
                      </div>
                    </div>
                    <!-- <div class="form-group row">
                      <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3">Confirm New Password</label>
                      <div class="col-12 col-sm-8 col-lg-6">
                        <input class="form-control" name=""  id="inputText3" type="password">
                      </div>
                    </div> -->
                    <div class="col-sm-6">
                        <p class="text-right">
                          <input class="btn btn-space btn-success" value ="Change Password" name = "Update_Password" type="submit">
                          <!-- <button class="btn btn-space btn-danger">Cancel</button> -->
                        </p>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
        </div>
       
        <?php }?>
        
      </div>
      <!--footer-->
      <?php include('assets/inc/footer.php');?>
        <!--EndFooter-->

    </div>
    <script src="assets/lib/jquery/jquery.min.js" type="text/javascript"></script>
    <script src="assets/lib/perfect-scrollbar/js/perfect-scrollbar.min.js" type="text/javascript"></script>
    <script src="assets/lib/bootstrap/dist/js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <script src="assets/js/app.js" type="text/javascript"></script>
    <script src="assets/lib/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
    <script src="assets/lib/jquery.nestable/jquery.nestable.js" type="text/javascript"></script>
    <script src="assets/lib/moment.js/min/moment.min.js" type="text/javascript"></script>
    <script src="assets/lib/datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script src="assets/lib/select2/js/select2.min.js" type="text/javascript"></script>
    <script src="assets/lib/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="assets/lib/bootstrap-slider/bootstrap-slider.min.js" type="text/javascript"></script>
    <script src="assets/lib/bs-custom-file-input/bs-custom-file-input.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(document).ready(function(){
      	//-initialize the javascript
      	App.init();
      	App.formElements();
      });
    </script>
  </body>

</html>
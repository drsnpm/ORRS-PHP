<!--Server side code to handle passenger sign up-->

<?php
session_start();
include('assets/inc/config.php');

if(isset($_POST['Pwd_reset'])) {
    $email = $_POST['email'];
    $status = 'Pending';

    // Check if the email exists in the orrs_passenger table
    $check_query = "SELECT * FROM orrs_passenger WHERE pass_email = ?";
    $check_stmt = $mysqli->prepare($check_query);
    $check_stmt->bind_param('s', $email);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        // Email exists in the orrs_passenger table, proceed with password reset
        $query = "INSERT INTO orrs_passwordresets (email, status) VALUES (?, ?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('ss', $email, $status);
        $stmt->execute();

        // Check if the password reset request was successfully inserted
        if($stmt) {
            $success = "Check Your Email For Password Reset Instructions";
        } else {
            $err = "Please Try Again Or Try Later";
        }
    } else {
        // Email does not exist in the orrs_passenger table
        $err = "Email does not exist";
    }
}
?>



<!--End Server Side-->
<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/img/favicon.ico">
    <title>Online Railway Reservation System</title>
    <link rel="stylesheet" type="text/css" href="assets/lib/perfect-scrollbar/css/perfect-scrollbar.css"/>
    <link rel="stylesheet" type="text/css" href="assets/lib/material-design-icons/css/material-design-iconic-font.min.css"/>
    <link rel="stylesheet" href="assets/css/app.css" type="text/css"/>
  </head>
  <body class="be-splash-screen">
    <div class="be-wrapper be-login">
      <div class="be-content">
        <div class="main-content container-fluid">
          <div class="splash-container forgot-password">
            <div class="card card-border-color card-border-color-success">
              <div class="card-header"><img class="logo-img" src="assets/img/logo-xx.png" alt="logo" width="102" height="#{conf.logoHeight}"><span class="splash-description">Forgot your password?</span></div>
              <div class="card-body">
              <?php if(isset($success)) {?>
                                <!--This code for injecting an alert-->
                <script>
                            setTimeout(function () 
                            { 
                                swal("Success!","<?php echo $success;?>!","success");
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
              <!--Password Reset Form-->
                <form method ="POST" >
                  <p>Don't worry, we'll send you an email to reset your password.</p>
                  <div class="form-group pt-4">
                    <input class="form-control" type="email" name="email" required="" placeholder="Your Email" autocomplete="off">
                  </div>
                  <p class="pt-1 pb-4">Don't remember your email? <a href="#">Contact Support</a>.</p>
                  <div class="form-group pt-1"><input type ="submit" name ="Pwd_reset" class="btn btn-block btn-primary btn-xl" value = "Reset Password"></div>
                </form>
                <!--End Password Reset-->
              </div>
            </div>
            <div class="splash-footer"><a href = "../index.php">Home</a></div>
            <div class="splash-footer">&copy; 2022 - <?php echo date ('Y');?> Online Railway Reservation System | Developed By Darshan PM</div>
        </div>
      </div>
    </div>
    <script src="assets/lib/jquery/jquery.min.js" type="text/javascript"></script>
    <script src="assets/lib/perfect-scrollbar/js/perfect-scrollbar.min.js" type="text/javascript"></script>
    <script src="assets/lib/bootstrap/dist/js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <script src="assets/js/app.js" type="text/javascript"></script>
    <script src="assets/js/swal.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
      	//-initialize the javascript
      	App.init();
      });
      
    </script>
  </body>

</html>
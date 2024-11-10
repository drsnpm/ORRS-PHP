<!--Server side code to handle passenger sign up-->
<?php
	session_start();
	include('assets/inc/config.php');

	if(isset($_POST['pass_register'])) {
		$pass_fname = $_POST['pass_fname'];
		$pass_lname = $_POST['pass_lname'];
		$pass_phone = $_POST['pass_phone'];
		$pass_addr = $_POST['pass_addr'];
		$pass_uname = $_POST['pass_uname'];
		$pass_email = $_POST['pass_email'];
		$pass_pwd = sha1(md5($_POST['pass_pwd']));

		// Check if email already exists
		$query_check_email = "SELECT * FROM orrs_passenger WHERE pass_email = ?";
		$stmt_check_email = $mysqli->prepare($query_check_email);
		$stmt_check_email->bind_param('s', $pass_email);
		$stmt_check_email->execute();
		$result_check_email = $stmt_check_email->get_result();

		if($result_check_email->num_rows > 0) {
			// Email already exists, show error message or handle it as needed
			$err = "Email address is already registered";
		} else {
			// Email doesn't exist, proceed with registration
			$query = "INSERT INTO orrs_passenger (pass_fname, pass_lname, pass_phone, pass_addr, pass_uname, pass_email, pass_pwd) VALUES (?, ?, ?, ?, ?, ?, ?)";
			$stmt = $mysqli->prepare($query);
			$rc = $stmt->bind_param('sssssss', $pass_fname, $pass_lname, $pass_phone, $pass_addr, $pass_uname, $pass_email, $pass_pwd);

			if ($stmt->execute()) {
				$success = "Account created successfully. Proceed to Log In";
			} else {
				$err = "Please try again or try later";
			}
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
          <div class="splash-container">
            <div class="card card-border-color card-border-color-success">
              <div class="card-header"><img class="logo-img" src="assets/img/logo-xx.png" alt="logo" width="{conf.logoWidth}" height="27"><span class="splash-description">Passenger Registration Form</span></div>
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

              <!--Login Form-->
                <form method ="POST">
                  <div class="login-form">

                    <div class="form-group">
                      <input class="form-control" name="pass_fname" type="text" required="true" placeholder="Enter Your First Name" pattern="[A-Za-z]+" minlength="4" autocomplete="off">
                    </div>
                    <div class="form-group">
                      <input class="form-control" name="pass_lname" type="text" required="true" placeholder="Enter Your Last Name" pattern="[A-Za-z]+" autocomplete="off">
                    </div>
                    <div class="form-group">
                      <input class="form-control" name="pass_phone" type="text" required="true" minlength="10" maxlength="10" pattern="[0-9]+" placeholder="Enter Your Phone Number" autocomplete="off">
                    </div>
                    <div class="form-group">
                      <input class="form-control" name="pass_addr" type="text" required="true" placeholder="Enter Your Address" autocomplete="off">
                    </div>
                    <div class="form-group">
                      <input class="form-control" name="pass_uname" type="text" required="true" placeholder="Enter Your Username" autocomplete="off">
                    </div>
                    <div class="form-group">
                      <input class="form-control" name="pass_email" type="email" required="true" pattern="^[a-zA-Z0-9]+@gmail.com$" placeholder="Enter Your Email Address" autocomplete="off">
                    </div>
                    <div class="form-group">
                      <input class="form-control" name="pass_pwd" type="password" required="true" minlength="8" placeholder="Password">
                    </div>
                    <div class="form-group row login-submit">
                      <div class="col-6"><a class="btn btn-outline-success btn-xl" href="pass-login.php">Login</a></div>
                      <div class="col-6"><input type = "submit" name ="pass_register" class="btn btn-outline-danger btn-xl" value ="Register"></div>
                    </div>

                  </div>
                </form>
                <!--End Login-->
              </div>
            </div>
            <div class="splash-footer">&copy; 2022 - <?php echo date ('Y');?> Online Railway Reservation System | Developed By Darshan PM</div>

          </div>
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
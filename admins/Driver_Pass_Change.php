<?php
include('connection.php');
session_start();

$id = $_SESSION['id'];
if(isset($_POST['Driv_chng_pass_btn']))
{
    $newpass = $_POST['Driv_chng_pass_new'];
    $curr_pass  =$_POST['Driv_chng_pass_curr'];
    $sql = "UPDATE `driver_info` SET `password`='".$newpass."' WHERE `driver_id`='".$id."' AND `password`='".$curr_pass."'";
    // $sql = "UPDATE `hospital_admin` SET `password`= '".$newpass."' WHERE `hospital_id`='".$id."' AND `password`='".$curr_pass."'";
    $result = mysqli_query($conn,$sql);
    if($result)
    {
        echo"<script type='text/javascript'> 
                alert('Password Change successfully...');
            </script>";
        header("location: Driver_Home.php");    
    }
    else
    {
      echo"<script type='text/javascript'> 
                alert('Sorry there is prob in changing  password...');
            </script>";
            
    }
}
?>
<!DOCTYPE html>
<html>

<head>
<script>
function Driv_Admin_change_Pass(){
		
			var no=/^[0-9]+$/;
			var curr_pass = document.getElementById("Driv_chng_pass_curr").value;
			var newp = document.getElementById("Driv_chng_pass_new")
			var con_pass = document.getElementById("Driv_chng_pass_confirm").value;
		
		//if there is password validation then 
		if(curr_pass.length<8 || curr_pass.length > 15)
		{
			alert("Enter valid password");
			return false;
		}
		else if(new_pass.length<8 || new_pass.length > 15)
		{
			alert("enter valid password ");
			return false;
		}
		else if(!new_pass.match(confirm_pass))
		{
			alert("your confirm passs doesn't matches to your password");
			return false;
		}
		return true;
}

function discard()
  {
    
    location.reload();
    return true;
  }

</script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Driver Admin - Change Password </title>
  <!-- Favicon -->
  <link href="../assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="../assets/css/argon.css?v=1.0.0" rel="stylesheet">
</head>

<body class="bg-default">
  <div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
      <div class="container px-4">
	  <a class="navbar-brand" href="Driver_Home.php">
          <img src="logo_white.png"  />
        </a>
        
        
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6">
              <!-- <h1 class="text-white">Welcome!</h1> -->
              <p class="text-lead text-light">Driver Admin - Change Password</p>
            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary shadow border-0">
            
            <div class="card-body px-lg-5 py-lg-5">
              
              <form role="form" action="Driver_Pass_Change.php" method="POST">
                  
                    <div class="form-group mb-3">
                        <label class="form-control-label" for="input-userHAme">Current Password</label>
                           <input id ="Driv_chng_pass_curr" name ="Driv_chng_pass_curr"class="form-control" placeholder="current password" type="password" required>
                      </div>
                    

					 <div class="form-group mb-3">
                        <label class="form-control-label" for="input-userHAme">New  Password</label>
                           <input id ="Driv_chng_pass_new" name ="Driv_chng_pass_new" class="form-control" placeholder="new password" type="password" required>
                      </div>
                    

					<div class="form-group mb-3">
                        <label class="form-control-label" for="input-username">Confirm Password</label>
                           <input id ="Driv_chng_pass_confirm" name ="Driv_chng_pass_confirm" class="form-control" placeholder="confirm password" type="password" required>
                      </div>
                    
                    

                    
					
                <div class="text-center">
                  <button id= "Driv_chng_pass_btn" name ="Driv_chng_pass_btn" type="submit" required="true" class="btn btn-success my-4" onclick="Driv_Admin_change_Pass()">Change Password</button>
                  <button id = "discard" name = "discard" onclick = "discard()" type = "submit" required = "true" class = "btn btn-danger my-4">Discard</button>
                </div>
              </form>
            </div>
          </div>
         <div class="row mt-3">
            <div class="col-6">
        <a href="Driver_Profile.php" class="text-light"><small>Want to Goto Back!</small></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Argon JS -->
  <script src="../assets/js/argon.js?v=1.0.0"></script>
</body>

</html>
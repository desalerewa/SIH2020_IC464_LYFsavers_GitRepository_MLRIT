<?php 
include('connection.php');
session_start();
if(isset($_POST['verify']))
{
  $role =$_POST['role'];
	$email= $_POST['veri_email'];
	$mob= $_POST['veri_Mob'];
	
  $_SESSION['role'] = $role;
	$_SESSION['veri_email']= $email;
	$_SESSION['veri_Mob']=$mob;
	$username=$email;
  $owner_id;
	
	//check flag status here 
	//if 1 then restrc=ict verfication as it is alredy present
	//if 0 then allow 
  if($role == 'driver_info')
  {
      $sql= "SELECT `owner_id` FROM `driver_registration` WHERE email='".$email."' AND mobile='".$mob."'";
      $result=mysqli_query($conn,$sql);
      $rows=mysqli_num_rows($result);
       while($x = mysqli_fetch_array($result))
      {
          $owner_id = $x['owner_id'];
          $_SESSION['owner_id'] = $owner_id;
      }
      if($rows > 0)
      {
          $sqlf="SELECT `flag` FROM `driver_registration` WHERE email='".$email."' AND mobile='".$mob."' AND flag = 0";
          $resf = mysqli_query($conn,$sqlf);
          $rowf = mysqli_num_rows($resf);
          if($rowf > 0)
          {
              header("Location:Driver_Register.php");
          }
          else
          {
              echo"<script type='text/javascript'> 
                alert('you are already verified user..!! please goto login page');
            </script>";
          }
      }
      else
      {
      
        echo"<script type='text/javascript'> 
              alert('wrong email id or mobile no');
          </script>";
        //header('Location: SA_Admin_Verification.html');
        
      }

  }
  else
  {

      $sql= "SELECT `email`,`mobile` FROM `admin_registration` WHERE email='".$email."' AND mobile='".$mob."'";
      $result=mysqli_query($conn,$sql);
      $rows=mysqli_num_rows($result);
      if($rows>0)
      {
          $sqlf="SELECT `flag` FROM `admin_registration` WHERE email='".$email."' AND mobile='".$mob."' AND flag = 0";
          $resf = mysqli_query($conn,$sqlf);
          $rowf = mysqli_num_rows($resf);
          if($rowf>0)
          {
                  
                  if($role == 'hospital_admin')
                  {
                      header("Location:HA_Register.php");
                  }
                  else if($role == 'police_admin')
                  {
                      header("Location:PS_Register.php");
                  }
                  else if($role == 'ambulance_admin')
                  {
                      header("Location:AMA_Register.php");
                  }
                  else if($role == 'ngo_admin')
                  {
                      header("Location:NGO_Register.php");
                  }
                  else if($role == 'nhai_admin')
                  {
                      header("Location:NHAI_Register.php");
                  }
                  
          }
          else
          {
              echo"<script type='text/javascript'> 
                alert('you are already verified user..!! please goto login page');
            </script>";
          }
      }
      else
      {
      
        echo"<script type='text/javascript'> 
              alert('wrong email id or mobile no');
          </script>";
        //header('Location: SA_Admin_Verification.html');
        
      }
  }
}
?>
<!DOCTYPE html>
<html>

<head>
<script>
		window.history.forward();
		function noBack()
		{
			window.history.forward();
		}
		function goForward()
		{
			window.history.forward();
		}
function SA_ADMIN_VERIFICATION()
{


	var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	var Email=document.getElementById("veri_email").value;

	var mobile_no = /^\d{10}$/; 
	//var Email=document.getElementById("SA_veri_email").value;
	var mob = document.getElementById("veri_Mob").value;
	
	
			if((Email==""))
			{
				alert("Plz Enter your Email id ");
				return false;
			}else if(!Email.match(mailformat))
			{
				alert("Plz Enter valid Email id ");
			}else if(mob=="")
			{
				alert("Plz Enter mobile no ");
				return false;
			}else if(!mob.match(mobile_no))
			{
				alert("Plz Enter valid mobile no ");
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
  <title>Verify Super Admin</title>
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
	  
	  <a class="navbar-brand pt-0" >
        <img src="logo_white.png" class="navbar-brand-img" alt="...">
      </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          
        </button>
        
              <div class="col-6 collapse-close">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                  <span></span>
                  <span></span>
                </button>
              </div>
            </div>
          </div>
          <!-- Navbar items -->
          
        </div>
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6">
              <!-- <h1 class="text-white">Welcome!</h1> -->
              <p class="text-lead text-light">Verify Yourself Here..!!</p>
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
              
              <form role="form" action="Admin_Verification.php" method="POST">
                 
                   
                      <div class="form-group mb-3">
                        <label class="form-control-label" >Choose Your Role</label>
                          <select class="form-control form-control-alternative" name="role" required="true">
                              <option>Select Role</option>
                              <option value="super_admin">Super Admin</option>
                              <option value="hospital_admin">Hospital Admin</option>
                              <option value="police_admin">Police Station Admin</option>
                              <option value="ambulance_admin">Ambulance Admin</option>
                              <option value="ngo_admin">NGO Ambulance Admin</option>
                              <option value="nhai_admin">NHAI Ambulance Admin</option>
                              <option value="driver_info">Ambulance Driver</option>
                          </select>
                   
                    </div>

                    
                      <div class="form-group mb-3">
                        <label class="form-control-label" for="input-username">Enter your Email-id</label>
                           <input id ="veri_email" name="veri_email" class="form-control" placeholder="Enter your email" type="text">
                      
                    </div>

  
                      <div class="form-group mb-3">
                        <label class="form-control-label" for="input-username" text-align="center">10 digit Mobile Number</label>
                           <input id ="veri_Mob" name="veri_Mob" class="form-control" placeholder="10 digit Mobile Number" type="text" align="center">
                      
                    </div>
					
                <div class="text-center">
                  <button id= "verify" type="submit" required="true" class="btn btn-success my-4" name="verify" onclick="SA_ADMIN_VERIFICATION()">Verify Admin</button>
                  <button type="submit" required="true" class="btn btn-danger my-4" onclick="discard()">Discard</button>
                </div>
                </center>
              </form>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-6">
              <a href="Login.php" class="text-light"><small>Already have an account, go to Log in!</small></a>
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
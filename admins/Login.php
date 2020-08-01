<?php 

include('connection.php');
session_start();
if(isset($_POST['login']))
{
	$email=$_POST['SA_username'];
	$pass=$_POST['SA_password'];
  $role = $_POST['role'];
	
	$_SESSION['username'] = $email;
	$_SESSION['password'] = $pass;
  $_SESSION['role'] = $role;

  if($role == 'super_admin')
    {
        $sql= "SELECT `super_id`,`name`,`username`,`password` FROM `".$role."` WHERE username='".$email."' AND password='".$pass."'";
        $result=mysqli_query($conn,$sql);
        $rows=mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result))
        {
          $_SESSION['name'] = $row['name'];
          $_SESSION['id'] = $row['super_id'];
        }
        if($rows>0)
        {
             header("Location:SA_Home.php");
        }
        else
        {
          echo"<script type='text/javascript'> 
                alert('Please enter valid login credentials...');
            </script>";
        }
    }
    else if($role == 'hospital_admin')
    {
       $sql= "SELECT `hospital_id`,`hospital_name`,`name`,`username`,`password`,`category` FROM `".$role."` WHERE username='".$email."' AND password='".$pass."'";
        $result=mysqli_query($conn,$sql);
        $rows=mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result))
        {
          $_SESSION['name'] = $row['name'];
          $_SESSION['id'] = $row['hospital_id'];
          $_SESSION['h_nm'] =$row['hospital_name'];
          $_SESSION['category'] = $row['category'];
        }
        if($rows>0)
        {
             header("Location:HA_Home.php");
        }
        else
        {
          echo"<script type='text/javascript'> 
                alert('Please enter valid login credentials...');
            </script>";
        }
    }
    else if($role == 'police_admin')
    {
         $sql= "SELECT `police_id`,`name`,`police_station_name`,`username`,`password` FROM `".$role."` WHERE username='".$email."' AND password='".$pass."'";
        $result=mysqli_query($conn,$sql);
        $rows=mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result))
        {
          $_SESSION['name'] = $row['name'];
          $_SESSION['id'] = $row['police_id'];
          $_SESSION['ps_nm'] = $row['police_station_name'];
        }
        if($rows>0)
        {
             header("Location:PS_Home.php");
        }
        else
        {
          echo"<script type='text/javascript'> 
                alert('Please enter valid login credentials...');
            </script>";
        }
    }
    else if($role == 'ambulance_admin')
    {
         $sql= "SELECT `ambulance_id`,`name`,`username`,`password` FROM `".$role."` WHERE username='".$email."' AND password='".$pass."'";
        $result=mysqli_query($conn,$sql);
        $rows=mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result))
        {
          $_SESSION['name'] = $row['name'];
          $_SESSION['id'] = $row['ambulance_id'];
        }
        if($rows>0)
        {
             header("Location:AMA_Home.php");
        }
        else
        {
          echo"<script type='text/javascript'> 
                alert('Please enter valid login credentials...');
            </script>";
        }
    }
    else if($role == 'ngo_admin')
    {
         $sql= "SELECT `ngo_id`,`name`,`NGO_name`,`username`,`password` FROM `".$role."` WHERE username='".$email."' AND password='".$pass."'";
        $result=mysqli_query($conn,$sql);
        $rows=mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result))
        {
          $_SESSION['name'] = $row['name'];
          $_SESSION['ngo_nm'] = $row['NGO_name'];
          $_SESSION['id'] = $row['ngo_id'];
          $_SESSION['admin_role'] = 'NGO Admin';
        }
        if($rows>0)
        {
             header("Location:NGO_Home.php");
        }
        else
        {
          echo"<script type='text/javascript'> 
                alert('Please enter valid login credentials...');
            </script>";
        }
    }
    else if($role == 'nhai_admin')
    {
         $sql= "SELECT `nhai_id`,`name`, `work_location`, `username`,`password` FROM `".$role."` WHERE username='".$email."' AND password='".$pass."'";
        $result=mysqli_query($conn,$sql);
        $rows=mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result))
        {
          $_SESSION['name'] = $row['name'];
          $_SESSION['work_location'] = $row['work_location'];
          $_SESSION['id'] = $row['nhai_id'];
          $_SESSION['admin_role'] = 'NHAI Admin';
        }
        if($rows>0)
        {
             header("Location:NHAI_Home.php");
        }
        else
        {
          echo"<script type='text/javascript'> 
                alert('Please enter valid login credentials...');
            </script>";
        }
    }
    else if($role == 'driver_info')
    {
         $sql= "SELECT `driver_id`,`owner_id`,`van_id`,`mobile`,`name`,`username`,`password` FROM `".$role."` WHERE username='".$email."' AND password='".$pass."'";
        $result=mysqli_query($conn,$sql);
        $rows=mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result))
        {
          $_SESSION['driver_name'] = $row['name'];
          $_SESSION['owner_id'] = $row['owner_id'];
          $_SESSION['driver_id'] = $row['driver_id'];
          $_SESSION['van_id'] = $row['van_id'];
          $_SESSION['driver_mob'] = $row['mobile'];
        }
        if($rows>0)
        {
             header("Location:Driver_Home.php");
        }
        else
        {
          echo"<script type='text/javascript'> 
                alert('Please enter valid login credentials...');
            </script>";
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
function SA_LOGIN()
{
	var mailformat= /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	var email=document.getElementById("SA_username").value;
	var pass = document.getElementById("SA_password").value;
	
	
			if((email==""))
			{
				 
				alert("Plz Enter your Email id ");
				return false;
			}else if(!(email.match(mailformat)))
			{
				alert("Plz Enter valid Email id ");
				return false;
			}			
			else if(pass.length<8 || pass.length > 15)
			{
				alert("enter valid password ");
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
  <title>LYFsavers - LOGIN</title>
  <!-- Favicon -->
  <link href="../assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
 <!--  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"> -->
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
        <a class="navbar-brand pt-0">
        <img src="logo_white.png" class="navbar-brand-img" alt="...">
      </a>
				
       
        <div class="collapse navbar-collapse" id="navbar-collapse-main">
          <!-- Collapse header -->
          <div class="navbar-collapse-header d-md-none">
            <div class="row">
              
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
              <p class="text-lead text-light">Login Yourself Here..!!</p>
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
              
              <form method="post" action="Login.php"> 
		<!--display validation errors here-->
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
                  <label class="form-control-label" for="input-username">Username</label>
                        <input type="email" id="SA_username" name="SA_username" class="form-control form-control-alternative" placeholder="Username">

                </div>
				
				<div class="form-group mb-3">
                  <label class="form-control-label" for="password">Password</label>
                        <input type="password" id="SA_password" name="SA_password" class="form-control form-control-alternative" placeholder="Password">

                </div>
                
                
                <div class="text-center">
                  <button type="submit" id="login" name="login" required="true" class="btn btn-success my-4" onclick="SA_LOGIN()">Log in</button>
                  <button type="submit" required="true" class="btn btn-danger my-4" onclick="discard()">Discard</button>
                </div>
              </form>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-6">
              <a href="Admin_Forgetpass.php" class="text-light"><small>Forgot password?</small></a>
			  </div>
			  <div class="col-6 text-right">
			  <a href="Admin_Verification.php" class="text-light"><small>create new account</small></a>
            </div>
          </div>
        </div>
      </div>
    </div>
 
  <!-- Footer -->
  <footer class="py-5">
    <div class="container">
      <div class="row align-items-center justify-content-xl-between">
        
        
      </div>
    </div>
  </footer>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Argon JS -->
  <script src="../assets/js/argon.js?v=1.0.0"></script>
</body>
</html>
<?php 
include('connection.php');
session_start();
if(isset($_POST['SA_FP_sendotp']))
{
	$superid;
	$date = date('Y-m-d');
	
	$time = $_COOKIE['time'];
	$_SESSION['time'] = $time;
	
	$email= $_POST['SA_FP_email'];
	$mob= $_POST['SA_FP_mob'];
	
	$_SESSION['email']= $email;
	$_SESSION['mob']=$mob;
	
	$str_result='0123456789';
	$otp=substr(str_shuffle($str_result),0,4);
	
	$sql= "SELECT `super_id`,`email`,`mobile` FROM `super_admin` WHERE email='".$email."' AND mobile='".$mob."'";
	$result=mysqli_query($conn,$sql);
	
	while($row = $result->fetch_assoc())
	{
		$superid= $row['super_id'];
		
	}
	$_SESSION['id'] = $superid;
	$rows=mysqli_num_rows($result);
	if($rows>0)
	{
		
		$otp=substr(str_shuffle($str_result),0,4);
		/* send otp on email*/
		/*write code to store this otp*/
		$sql = "INSERT INTO `otp` (`admin_id`,`email`,`mobile` ,`otp`, `date`,`time`) VALUES ('$superid','$email','$mob','$otp','$date','$time')";
		$resotp = mysqli_query($conn,$sql);
		if($resotp)
		{
			echo"<script type='text/javascript'> 
					alert('Otp is send to your registered email address..!!');
			</script>";
			header("Location: SA_Admin_verify_OTP.php");
		}
		else
		{
			echo"<script type='text/javascript'> 
					alert('there is problem in sending otp');
			</script>";
		}	
	}
	else
	{
	
		echo"<script type='text/javascript'> 
					alert('User not Found. Please regiseter yourself...!!');
			</script>";
		//header('Location: SA_Admin_Verification.html');
		
	}
	$conn->close();

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
function SA_ADMIN_FORGETNESS_ADMIN()
{


	var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	var Email=document.getElementById("SA_FP_email").value;
	var mobile_no = /^\d{10}$/; 
	
	//var Email=document.getElementById("SA_veri_email").value;
	var mob = document.getElementById("SA_FP_mob").value;
	var today = new Date();
	var time = today.getHours()+ ":"+ today.getMinutes()+":"+today.getSeconds();
	
	document.cookie = "time=" + time;
	
	
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
  <title>LYFsaver Admin - Forget Password</title>
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
       
        
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6">
              <!-- <h1 class="text-white">Welcome!</h1> -->
              <p class="text-lead text-light">Here You Can Recover Your Password</p>
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
              
              <form role="form" action="Admin_Forgetpass.php" method="post">
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <select class="form-control form-control-alternative">
                            <option>Select Role</option>
                            <option value="SA">Super Admin</option>
                            <option value="HA">Hospital Admin</option>
                            <option value="PA">Police Station Admin</option>
                            <option value="AMA">Ambulance Admin</option>
                            <option value="NGO">NGO Admin</option>
                            <option value="PTA">Political Party Ambulance Admin</option>
                            <option value="PVA">Private Ambulance Admin</option>
                            <option value="CHA">Charity AmbulanceAdmin</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
				    
                    <input id="SA_FP_email" name="SA_FP_email" class="form-control"  required="true" placeholder="Email-id" type="email" required>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
                    </div>
                    <input id="SA_FP_mob" name="SA_FP_mob" class="form-control" pattern="[0-9]{10}" placeholder="10 Digit Mobile Number" type="text" required>
                  </div>
                </div>
                
                <div class="text-center">
                  <button id="SA_FP_sendotp" name ="SA_FP_sendotp" type="submit" required="true" class="btn btn-primary my-4"onclick=" SA_ADMIN_FORGETNESS_ADMIN()" >Send OTP</button>
                  <button type="submit" required="true" class="btn btn-danger my-4" onclick="discard()">Discard</button>
                </div>
              </form>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-6">
              <a href="Login.php" class="text-light"><small>Get Back To Login</small></a>
            </div>
            <div class="col-6 text-right">
              <a href="Admin_Verification.php" class="text-light"><small>Create new account</small></a>
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
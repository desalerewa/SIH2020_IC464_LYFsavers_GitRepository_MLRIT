<?php
include('connection.php');
session_start();
if(isset($_POST['SA_veri_optbtn']))
{
	$fetchotp;		//db otp
	$fetchdate;		//db date
	$fetchtime;		//db time
	//taken from form
	$otp = intval($_POST['SA_veri_otp']);
	$email= $_SESSION['email'];
	$mob= $_SESSION['mob'];
	
	$curtime= $_COOKIE['time'];
	$curdate = date('Y-m-d');
	$reqTime=$_SESSION['time'];
	
	
	$sql = "SELECT `otp` FROM `otp` WHERE email='".$email."' AND mobile='".$mob."' And time = '".$reqTime."'";
	$result = mysqli_query($conn,$sql);
	if($result)
	{
		while($row = $result->fetch_assoc())
		{
			
			$fetchotp= $row['otp'];
			$fetchdate =$row['date'];
			$fetchtime = $row['time'];
		}
		//find dif between time
		$diff = $curtime - $fetchtime;
		//check date and time and otp
		if($curdate === $fetchdate)
		{
			if(($diff/60) <= 5)
			{
				if($fetchotp === $otp)
				{
					header("Location:SA_Forget_Pass_Change.php");
				}
				else
				{
					echo"<script type='text/javascript'> 
						alert('Please enter valid OTP..!!');
						</script>";
				}
			}
			else
			{
				echo"<script type='text/javascript'> 
						alert('Opps...!! REquest time out of OTP..!!');
						</script>";
			}
		}
		else
		{
			echo"<script type='text/javascript'> 
					alert('Opps..!! please enter valid otp');
				</script>";
		}

		
	}
	else
	{
		echo"<script type='text/javascript'> 
					alert('Opps..!! Something went wrong..!!');
			</script>";
	}	
}
else 
{
	if(isset($_POST['SA_OTP_resend']))
	{
		$email= $_SESSION['email'];
		$mob= $_SESSION['mob'];
		
		$time = $_COOKIE['time'];
		$SESSION['time'] = $time;
		$date = date('Y-m-d');
		
		//generate otp
		$str_result='0123456789';
		
		
		//check its email and mob for validation
		$sql= "SELECT `super_id`,`email`,`mobile` FROM `super_admin` WHERE email='".$email."' AND mobile='".$mob."'";
		$result=mysqli_query($conn,$sql);
		$rows=mysqli_num_rows($result);
		if($rows>0)
		{
			
			$otp=substr(str_shuffle($str_result),0,4);
			/* send otp on email*/
			/*write code to store this otp*/
			$sql = "UPDATE `otp` set otp='".$otp."', date='".$date."', time= '".$time."' WHERE email='".$email."' AND mobile='".$mob."' ";
			$resotp = mysqli_query($conn,$sql);
			if($resotp)
			{
				echo"<script type='text/javascript'> 
						alert('Otp is send to your registered email address..!!');
				</script>";
			}
			else
			{
				echo"<script type='text/javascript'> 
						alert('There is problem in sending otp');
				</script>";
			}	
		}
		else
		{
		
			echo"<script type='text/javascript'> 
					alert('Opps..!! Something went wrong..!!');
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
function SA_ADMIN_VERIFY_OTP()
{
	var no=/^[0-9]+$/;
	var OTP=document.getElementById("SA_veri_otp").value;
	
	var today = new Date();
	var time = today.getHours()+ ":"+ today.getMinutes()+":"+today.getSeconds();
	
	document.cookie = "time=" + time;
	
			if((OTP==""))
			{
				alert("Plz Enter your otp ");
				return false;
			}else if(!OTP.match(no))
			{
				alert("Plz Enter valid otp");
				return false;
			}else if(OTP.length != 4)
			{
				alert("Plz Enter valid length otp");
				return false;
			}
			
}
function SA_RESEND_OTP()
{
	var OTP=document.getElementById("SA_veri_otp").value;
	var today = new Date();
	var time = today.getHours()+ ":"+ today.getMinutes()+":"+today.getSeconds();
	
	document.cookie = "time=" + time;
	
		if(!(OTP==""))
		{
				alert("Plz discard alredy fill infromation...!! ");
				return false;
		}
		
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
  <title>Super Admin - Verify OTP</title>
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
      	 <a class="navbar-brand">
          <img src="logo_white.png"  />
        </a>
       
        <div class="collapse navbar-collapse" id="navbar-collapse-main">
          <!-- Collapse header -->
          <div class="navbar-collapse-header d-md-none">
            <div class="row">
              <div class="col-6 collapse-brand">
                <a href="../index.html">
                  <img src="../assets/img/brand/blue.png">
                </a>
              </div>
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
              <p class="text-lead text-light">OTP Verification</p>
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
              
              <form role="form" action="SA_Admin_verify_OTP.php" method="post">
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
				    
                    <input id="SA_veri_otp" name="SA_veri_otp" class="form-control" pattern="[0-9]{4}"  placeholder="enter OTP" type="text">
                  </div>
                </div>

                
                
                <div class="text-center">
                  <button id="SA_veri_optbtn" name="SA_veri_optbtn" type="submit" required="true" class="btn btn-primary my-4" onclick="SA_ADMIN_VERIFY_OTP()">Verify OTP</button>
				   <button id="SA_OTP_resend" name ="SA_OTP_resend" type="submit" required="true" class="btn btn-success my-4" onclick="SA_RESEND_OTP()">Resend OTP</button>
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
              <a href="Admin_verification.php" class="text-light"><small>Create new account</small></a>
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
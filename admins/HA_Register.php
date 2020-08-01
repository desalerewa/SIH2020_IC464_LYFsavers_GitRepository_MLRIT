<?php
    include('connection.php');
	session_start();
  
	$email=$_SESSION['veri_email'];
	$mob=$_SESSION['veri_Mob'];
  
  if(isset($_POST['create_account'])) 
  {
	$name= $_POST['HA_reg_name'];
	$aadhar_no= $_POST['HA_reg_aadhar'];
	$admin_address= $_POST['HA_reg_admin_addr'];
	$hname= $_POST['HA_name'];	
	$category= $_POST['category'];
	$psname= $_POST['HA_ps_name'];
	$street=$_POST['HA_reg_street'];
	$village=$_POST['HA_reg_village'];
	$tal=$_POST['HA_reg_tal'];
	$dist=$_POST['HA_reg_dist'];
	$state=$_POST['HA_reg_state'];
	$lat = $_POST['latitude'];
	$lon = $_POST['longitude'];
	
	$username=$email;
	$str_result='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$password=substr(str_shuffle($str_result),0,8);		
	
	
	$sql = "INSERT INTO `hospital_admin`( id, hospital_id, name, username, password, email,	mobile, aadhar_no, admin_address, profile_photo, hospital_name, category, police_station_name_under_hospital_comes, street, village, taluka, district, state, latitude, longitude) VALUES ('', '', '$name','$email', '$password', '$email', '$mob', '$aadhar_no','$admin_address', '', '$hname', '$category','$psname','$street', '$village', '$tal', '$dist', '$state', '$lat', '$lon')";
    $result = mysqli_query($conn,$sql);
	
    	
	if($result)
	{
			
			
			$sql = "UPDATE `hospital_admin` set `hospital_id` = concat(`prefix`,`id`)";
			$res = mysqli_query($conn,$sql);
			if($res)
			{
				$sql = "UPDATE `admin_registration` SET `flag` = 1 WHERE email='".$email."' AND mobile='".$mob."'";
				$resf = mysqli_query($conn, $sql);
				if($resf)
				{
					/*
						sending mail of username and password;
					*/
					echo "<script type='text/javascript'> 
					alert('record inserted...!!');
					</script>";
					header("Location:Login.php");
				}					
			}	

				
	
	
	else
	{
		echo $conn->error;
		echo"<script type='text/javascript'> 
			alert('record not inserted...!!');
			</script>";
	}
	}	

  
  }
  
	?>



<!DOCTYPE html>
<html>

<head>

<script>
	function HA_registration()
	{
		//var mailformat= /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
		var name_with_space= /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/;
		var name_widout_space= /^[a-zA-Z-]+$/;
		var no=/^[0-9]+$/;
		var aadhar_no = /^\d{12}$/;
		var mobile_no = /^\d{10}$/; 
		
		
		
		var name=document.getElementById("HA_reg_name").value;
		var aadhar=document.getElementById("HA_reg_aadhar").value;
		var admin_addr=document.getElementById("HA_reg_admin_addr").value;
		var hname=document.getElementById("HA_name").value;
		var psname=document.getElementById("HA_ps_name").value;
		var street=document.getElementById("HA_reg_street").value;
		var village=document.getElementById("HA_reg_village").value;
		var tal=document.getElementById("HA_reg_tal").value;
		var dist=document.getElementById("HA_reg_dist").value;
		var state=document.getElementById("HA_reg_state").value;
	
			if(!name.match(name_with_space))
			{
				 
				alert("Plz Enter valid name  ");
				return false;
			}
			
			else if(!(aadhar.match(no)) || (aadhar.length!=12))
			{
				alert("Plz Enter valid Aadhar no ");
				return false;
			}
			
			else if(!admin_addr.match(name_with_space))
			{
				 
				alert("Plz Enter valid address  ");
				return false;
			}
			
			else if(!hname.match(name_with_space))
			{
				 
				alert("Plz Enter valid hospital name  ");
				return false;
			}
			else if(!psname.match(name_with_space))
			{
				 
				alert("Plz Enter valid police station name  ");
				return false;
			}
			
			else if(!street.match(name_with_space))
			{
				 
				alert("Plz Enter valid street  ");
				return false;
			}
			
			else if(!village.match(name_widout_space))
			{
				 
				alert("Plz Enter valid village  ");
				return false;
			}
			else if(!tal.match(name_widout_space))
			{
				 
				alert("Plz Enter valid Taluka name ");
				return false;
			}
			else if(!dist.match(name_widout_space))
			{
				 
				alert("Plz Enter valid District name ");
				return false;
			}
			else if(!state.match(name_with_space))
			{
				        
				alert("Plz Enter valid State name ");
				return false;
			}
			else
			{
				window.location.replace("HA_Home.php");
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
  <title>Hospital Admin Registration</title>
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
                  <img src="../assets/img/brand/imail.png">
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
              <p class="text-lead text-light">Create New Account</p>
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
        <div class="col-lg-8 col-md-7">
          <div class="card bg-secondary shadow border-0">

            <div class="card-body px-lg-5 py-lg-5">

              <form role="form" action="HA_Register.php" method="POST">

				<div class="form-control-label" style="font-size:18px"><center>Hospital Admin Details</div>

                   <div class="row">                   
                    <div class="col-lg-6">
                      <div class="form-group">
							<label class="form-control-label" for="input-username"> Enter Admin Name:</label>
                            <input id="HA_reg_name" name="HA_reg_name" class="form-control" placeholder="Admin name" type="text" required>
                      </div>
                    </div>
					
					 <div class="col-lg-6">
                      <div class="form-group">
							<label class="form-control-label" for="input-username"> Enter Aadhar No.:</label>
                            <input id="HA_reg_aadhar" name="HA_reg_aadhar" class="form-control" placeholder="Aadhar no." type="text" required>
                      </div>
                    </div>
				  </div>
				  				  
				  <div class="row">   
                    <div class="col-lg-6">
                      <div class="form-group">
							<label class="form-control-label" for="input-username"> Enter Admin Address:</label>
                            <input id="HA_reg_admin_addr" name="HA_reg_admin_addr" class="form-control" placeholder="Admin address" type="text" required>
                      </div>
                    </div>
					  </div>
					
					<hr class="my-2" />
				
				<div class="form-control-label" style="font-size:18px"><center>Hospital Details </div>
  
				<div class="row">
				<div class="col-lg-6">
                      <label class="form-control-label" >Choose Hospital Category</label>
                      <select class="form-control form-control-alternative" name="category" id="category">
                        <option>Select Category</option>
                        <option value="Government Hospital">Government Hospital</option>
                        <option value="Private Hospital">Private Hospital</option>
                      </select>
                    </div>
				</div>
					
					<p class = style= line-height:3.8;></p>
					
				   <div class="row">
					<div class="col-lg-12">
                      <div class="form-group">
							<label class="form-control-label" for="input-username"> Enter Hospital Name:</label>
                            <input id="HA_name" name="HA_name" class="form-control" placeholder="Hospital name" type="text" required>
                      </div>
                    </div>
					<div class="col-lg-12">
                      <div class="form-group">
							<label class="form-control-label" for="input-username">Police Station name under your hospital comes :</label>
                            <input id="HA_ps_name" name="HA_ps_name" class="form-control" placeholder="Police Station name" type="text" required>
                      </div>
                    </div>
                    
                  </div>
					
					
                	
					<div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username"> Street:</label>
                           <input id="HA_reg_street" name="HA_reg_street" class="form-control" placeholder="Street" type="text" required>

                      </div>
                    </div>
					
					 <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username"> Village:</label>
                           <input id="HA_reg_village" name="HA_reg_village" class="form-control" placeholder="Village" type="text" required>

                      </div>
                    </div>
					</div>
					
					<div class="row">
					 <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username"> Taluka:</label>
                           <input id="HA_reg_tal" name="HA_reg_tal" class="form-control" placeholder="Taluka" type="text" required>

                      </div>
                    </div>
					
					 <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username"> District:</label>
                           <input id="HA_reg_dist" name="HA_reg_dist" class="form-control" placeholder="District" type="text" required>

                      </div>
                    </div>
					</div>
					
					<div class="row">
					<div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username"> State:</label>
                           <input id="HA_reg_state" name="HA_reg_state" class="form-control" placeholder="State" type="text" required>

                      </div>
                    </div>
					</div>
					
                <div class="form-control-label" style="font-size:16px">Click on the link given below to find your current location co-ordinates :</div>
  
				<p><a href="https://www.google.com/maps/" target="_blank" style="color: #000FFF"><b><u>https://www.google.com/maps/</u></b></a></p>
				
				<div class="row">
					 <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username"> Latitude:</label>
                           <input id="latitude" name="latitude" class="form-control" placeholder="Enter Latitude" type="text" required>

                      </div>
                    </div>
					
					 <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username"> Longitude:</label>
                           <input id="longitude" name="longitude" class="form-control" placeholder="Enter Longitude" type="text" required>

                      </div>
                    </div>
					</div>
				
				
                <div class="text-center">
                  <button onclick = "HA_Registration()" id="create_account" name="create_account" type="submit" required="true" class="btn btn-success my-4" >Create Account</button>
                  <button onclick = "discard()" id= "discard" name= "discard" type="submit" required="true" class="btn btn-danger my-4" >Discard</button>
                </div>
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
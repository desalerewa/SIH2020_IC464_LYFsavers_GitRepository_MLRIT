<?php
include('connection.php');
session_start();
	
	$email=$_SESSION['veri_email'];
	$mob=$_SESSION['veri_Mob'];
	$owner_id=$_SESSION['owner_id'];

	if(isset($_POST['register']))
	{
		$name= $_POST['Driv_reg_name'];	
		$aadhar= $_POST['Driv_reg_aadhar'];
		$pan_no= $_POST['Driv_reg_pan_no'];
		$licence_no= $_POST['Driv_reg_licence_no'];
		
		$street=$_POST['Driv_reg_street'];
		$village=$_POST['Driv_reg_village'];
		$tal=$_POST['Driv_reg_tal'];
		$dist=$_POST['Driv_reg_dist'];
		$state=$_POST['Driv_reg_state'];

		$amb_no_plate = $_POST['amb_no_plate'];
	
		$username=$email;
		$str_result='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$password=substr(str_shuffle($str_result),0,8);
		
			//get van id
			$get_van_id = mysqli_query($conn,"SELECT `van_id` from `van_info` WHERE `no_plate_no` = '".$amb_no_plate."' ");
			$van_id;
			while ($row = mysqli_fetch_array($get_van_id))
			{
				$van_id = $row['van_id'];
			}

			$sql1 = "INSERT INTO driver_info (`owner_id`, `name`, `username`, `password`, `email`, `mobile`, `aadhar_no`, `pan_no`, `licence_no`, `street`, `village`, `taluka`, `district`, `state`,`van_id`) VALUES ('$owner_id', '$name', '$username', '$password', '$email', '$mob', '$aadhar', '$pan_no', '$licence_no', '$street', '$village', '$tal', '$dist', '$state','$van_id')";
	
			$result1 = mysqli_query($conn,$sql1);
		
			if($result1)
			{
			
				$sql2 = "UPDATE `driver_info` set `driver_id` = concat(`prefix`,`id`)";
				$result2 = mysqli_query($conn,$sql2);
				if($result2)
				{	
					$d_id = "SELECT driver_id FROM driver_info WHERE van_id = '$van_id'";
					$sql4 = "UPDATE van_info SET driver_id = '$d_id"; 
					$sql4 = mysqli_query($conn, $sql4);
					
					$sql5 = "UPDATE `driver_registration` SET `flag` = 1 WHERE email='".$email."' AND mobile='".$mob."'";
					$result5 = mysqli_query($conn, $sql5);

					if($result5)
					{ 
					/*
						sending mail of username and password;
					*/
					
						echo"<script type='text/javascript'> 
							alert('record inserted...!!');
							</script>";
						
						header("Location:Login.php");
					
					}	
				}		
			}
	//	}	
		else
		{
			echo $conn->error;
			echo"<script type='text/javascript'> 
				alert('record not inserted...!!');
				</script>";
		}
		
	
	$conn->close();
}

?>

<!DOCTYPE html>
<html>

<head>
<script>
	function Driver_Registration()
	{
		var mailformat= /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
		var name_with_space= /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/;
		var name_widout_space= /^[a-zA-Z-]+$/;
		var no=/^[0-9]+$/;
		var aadhar_no = /^\d{12}$/;
		var mobile_no = /^\d{10}$/; 
		
		
		
		var name=document.getElementById("Driv_reg_name").value;
		var email=document.getElementById("Driv_reg_email").value;
		var mobile_no=document.getElementById("Driv_reg_mobile_no").value;
		var aadhar=document.getElementById("Driv_reg_aadhar").value;
		var pan_no=document.getElementById("Driv_reg_pan_no").value;
		var licence_no=document.getElementById("Driv_reg_licence_no").value;
		//var amb_no_plate=document.getElementById("Driv_reg_amb_no_plate").value;
		var street=document.getElementById("Driv_reg_street").value;
		var village=document.getElementById("Driv_reg_village").value;
		var tal=document.getElementById("Driv_reg_tal").value;
		var dist=document.getElementById("Driv_reg_dist").value;
		var state=document.getElementById("Driv_reg_name").value;
			
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
			else if(!(pan_no.match(no)))
			{
				alert("Plz Enter valid Pancard no ");
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
			else if(!state.match(name_widout_space))
			{
				 
				alert("Plz Enter valid State name ");
				return false;
			}
			else
			{
				window.location.replace("Driver_Home.php");
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
  <title>Ambulance Driver Registration</title>
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

<body style="background-color:powderblue;" class="bg-default">
  <div class="main-content">
    <!-- navbar -->
    <nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
      <div class="container px-4">
        <a class="navbar-brand pt-0" >
        <img src="logo_white.png" class="navbar-brand-img" alt="...">
      </a>
        
       
          <!-- navbar items -->
          
        </div>
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8">
      <div class="container" >
        <div class="header-body text-center mb-6">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6" >
              <!-- <h1 class="text-white">Welcome!</h1> -->
              <p class="text-lead text-light">Create New Ambulance Driver Account </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <p class = style= line-height:3.8;></p>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-8 col-md-7">
          <div class="card bg-secondary shadow border-0">

            <div class="card-body px-lg-5 py-lg-5">

              <form role="form" action="Driver_Register.php" method="POST">

                   <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
							<label class="form-control-label" for="input-username"> Enter your name:</label>
                            <input id="Driv_reg_name" name="Driv_reg_name"class="form-control" placeholder="name" type="text" required>
                      </div>
                    </div>
                   
					
				   
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username"> Aadhar No:</label>
                        <input id="Driv_reg_aadhar" name="Driv_reg_aadhar"class="form-control" placeholder="Aadhar card Number" type="text" required>
                      </div>
                    </div>
                    </div>

                    <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username"> Pancard No:</label>
                        <input id="Driv_reg_pan_no" name="Driv_reg_pan_no"class="form-control" placeholder="Pancard Number" type="text" required>
                      </div>
                    </div>
                    

                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username"> Driving Licence No:</label>
                        <input id="Driv_reg_licence_no" name="Driv_reg_licence_no"class="form-control" placeholder="Licence Number" type="text" required>
                      </div>
                    </div>
                    </div>


				   <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username"> Street:</label>
                           <input id="Driv_reg_street" name="Driv_reg_street"class="form-control" placeholder="Street" type="text" required>
                      </div>
                    </div>
					
					 <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username"> Village:</label>
                           <input id="Driv_reg_village" name="Driv_reg_village"class="form-control" placeholder="Village" type="text" required>

                      </div>
                    </div>
                   </div>
					
				   <div class="row">	
					 <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username"> Taluka:</label>
                           <input id="Driv_reg_tal"name="Driv_reg_tal"class="form-control" placeholder="Taluka" type="text" required>
                      </div>
                    </div>
					
					 <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username"> District:</label>
                           <input id="Driv_reg_dist" name="Driv_reg_dist"class="form-control" placeholder="District" type="text" required>
                      </div>
                    </div>
                   </div> 
					
				   <div class="row">	
					<div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username"> State:</label>
                           <input id="Driv_reg_dist" name="Driv_reg_state"class="form-control" placeholder="State" type="text"required>
                      </div>
                    </div>


                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Ambulance No plate No. </label>
                        <input id="amb_no_plate" name="amb_no_plate" class="form-control" placeholder="Ambulance Number Plate No." type="text" required>
                      </div>
                    </div>
                    </div>

					<!-- </div> -->
					
                <div class="text-center" >
                  <button id="register" type="submit" name="register" required="true" class="btn btn-success my-4" onclick = "Driver_Registration()" >Register</button>
                  <button id="discard" type="submit"  name="discard" required="true" class="btn btn-danger my-4" onclick = "discard()" >Discard</button>
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
  </body>

</html>
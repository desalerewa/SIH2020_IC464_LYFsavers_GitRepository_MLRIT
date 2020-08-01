<?php
     include('connection.php');
    session_start();

  $role = $_SESSION['role'];
  $name = $_SESSION['name'];
  $id = $_SESSION['driver_id'];
  $email = $_SESSION['username'];
  $pass = $_SESSION['password'];

  
  if (isset($_POST['save_changes'])) 
  {
    
    //$s = "SELECT van_id FROM van_info WHERE no_plate_no = $_POST[Driv_profile_no_plate] ";
    //$r = mysqli_query($conn,$s);
    //if($r)
    //{ 
      
    $sql= "UPDATE driver_info SET name = '$_POST[Driv_profile_name]', mobile = '$_POST[Driv_profile_mob]', aadhar_no = '$_POST[Driv_profile_aadhar]', pan_no = '$_POST[Driv_profile_pan_no]' ,  licence_no = '$_POST[Driv_profile_licence_no]',street = '$_POST[Driv_profile_street]', village = '$_POST[Driv_profile_village]', taluka = '$_POST[Driv_profile_tal]', district = '$_POST[Driv_profile_dist]', state = '$_POST[Driv_profile_state]', profile_photo = '$_POST[Driv_profile_photo]' WHERE driver_id ='$_SESSION[id]' ";
      $result = mysqli_query($conn,$sql);
      if($result)
      {
        echo "<script type='text/javascript'> 
              alert('record updated successfully...!!');
            </script>";
      
      }
  }

 

   $sql= "SELECT * FROM `driver_info` WHERE username='".$email."' AND password='".$pass."'";
   $result = mysqli_query($conn,$sql);
  while($row = mysqli_fetch_array($result))
  {
    $nm = $row['name'];
    $em = $row['email'];
    $mob = $row['mobile'];
    $aadhar_no = $row['aadhar_no'];
    $pan_no = $row['pan_no'];
    $licence_no = $row['licence_no'];
    //$no_plate = $row['no_plate_no'];
    $street = $row['street'];
    $village = $row['village'];
    $taluka = $row['taluka']; 
    $dist = $row['district'];
    $state = $row['state'];
    $profile_photo = $row['profile_photo'];
    $address = $row['street']." ".$row['village']." ".$row['taluka']." ".$row['district']." ".$row['state'];
  
  }
?>
<!DOCTYPE html>
<html>

<head>
<script>

  function enable()
  {
    document.getElementById("Driv_profile_name").disabled = false;
    document.getElementById("Driv_profile_mob").disabled = false;
    document.getElementById("Driv_profile_aadhar").disabled = false;
    document.getElementById("Driv_profile_pan_no").disabled = false;
    document.getElementById("Driv_profile_licence_no").disabled = false;
    document.getElementById("Driv_profile_street").disabled = false;
    document.getElementById("Driv_profile_village").disabled = false;
    document.getElementById("Driv_profile_tal").disabled = false;
    document.getElementById("Driv_profile_dist").disabled = false;
    document.getElementById("Driv_profile_state").disabled = false;
    document.getElementById("Driv_profile_photo").disabled = false;
      
  }
  
  
  
  function disable()
  {
    document.getElementById("Driv_profile_name").disabled = true;
    document.getElementById("Driv_profile_mob").disabled = true;
    document.getElementById("Driv_profile_aadhar").disabled = true;
    document.getElementById("Driv_profile_pan_no").disabled = true;
    document.getElementById("Driv_profile_licence_no").disabled = true;
    document.getElementById("Driv_profile_street").disabled = true;
    document.getElementById("Driv_profile_village").disabled = true;
    document.getElementById("Driv_profile_tal").disabled = true;
    document.getElementById("Driv_profile_dist").disabled = true;
    document.getElementById("Driv_profile_state").disabled = true;
    document.getElementById("Driv_profile_photo").disabled = true;
      
  }
  
  
  function Driver_Profile()
  {
    var mailformat= /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    var name_with_space= /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/;
    var name_widout_space= /^[a-zA-Z-]+$/;
    var no=/^[0-9]+$/;
    var aadhar_no = /^\d{12}$/;
    var mobile_no = /^\d{10}$/; 
    
    
    
    var name=document.getElementById("Driv_profile_name").value;
    var email=document.getElementById("Driv_profile_email").value;
    var mob=document.getElementById("Driv_profile_mob").value;
    var aadhar=document.getElementById("Driv_profile_aadhar").value;
    var pan_no=document.getElementById("Driv_profile_pan_no").value;
    var licence_no=document.getElementById("Driv_profile_licence_no").value;
    var street=document.getElementById("Driv_profile_street").value;
    var village=document.getElementById("Driv_profile_village").value;
    var tal=document.getElementById("Driv_profile_tal").value;
    var dist=document.getElementById("Driv_profile_dist").value;
    var state=document.getElementById("Driv_profile_state").value;
  
      if(!name.match(name_with_space))
      {
         
        alert("Plz Enter valid name  ");
        return false;
      }
      else if((email==""))
      {
         
        alert("Plz Enter your Email id ");
        return false;
      }
      else if(email.match(mailformat))
      {
        alert("Plzz enter your valid Email id")
      }
      else if(!mob.match(name_widout_space))
      {
         
        alert("Plz Enter valid mobile number  ");
        return false;
      }
      else if(!(aadhar.match(no)) || (aadhar.length!=12))
      {
        alert("Plz Enter valid Aadhar no ");
        return false;
      }
      else if(!(pan_no.length!=10))
      {
        alert("Plz Enter valid Pan card no ");
        return false;
      }
      else if(!(licence_no.length!=15))
      {
        alert("Plz Enter valid driving licence no ");
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
  

</script>
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Ambulance Driver - User Profile</title>
  <!-- Favicon -->
  <link href="../assets/img/brand/favicon.png" rel="icon" type="image/png">
  
  
  <!-- Icons -->
  <link href="../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="../assets/css/argon.css?v=1.0.0" rel="stylesheet">
</head>

<body onload="disable()">
  <!-- Sidenav -->
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
      <img src="logo_black.png" class="navbar-brand-img" alt="...">
      <!-- User -->
      <ul class="nav align-items-center d-md-none">
        <li class="nav-item dropdown">
         
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right" aria-labelledby="navbar-default_dropdown_1">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
        
      </ul>
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a >
                <img src="logo_black.png">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <!-- Navigation -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="Driver_Home.php">
              <i class="ni ni-tv-2 text-primary"></i> Dashboard
            </a>
          </li>
       <!--Logs-->
      <li class="nav-item">
            <a class="nav-link" href="Driver_logs.php">
              <i class="ni ni-collection text-green"></i>Logs
            </a>
          </li>
      
         
          <li class="nav-item">
            <a class="nav-link" href="Driver_Profile.php">
              <i class="ni ni-single-02 text-yellow"></i> User profile
            </a>
          </li>
       </ul>
        <!-- Divider -->
        <hr class="my-3">
        <!-- Heading -->
        <h6 class="navbar-heading text-muted ni ni-settings"> Account Settings</h6>
        <!-- Navigation -->
        <ul class="navbar-nav mb-md-3">
          <li class="nav-item">
            <a class="nav-link" href="Driver_Profile.php">
              <i class="ni ni-circle-08"></i> Edit Profile
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Driver_Pass_Change.php">
              <i class="ni ni-lock-circle-open"></i> Change Password
            </a>
          </li>
        </ul>
        <hr class="my-3">
        <ul class="navbar-nav mb-md-3">
          <li class="nav-item">
            <a class="nav-link" href="Login.php">
              <i class="ni ni-button-power"></i> Logout
            </a>
          </li>
        </ul>

      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="Driver_Profile.php">View & Change User profile</a>
       
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold">Ambulance Driver - <label ><?php echo $nm ?></label></span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <!-- <div class=" dropdown-header noti-title">
                <h6 class="text-overflow m-0">Welcome!</h6>
              </div> -->
       
              <a href="Login.php" class="dropdown-item">
                <i class="ni ni-button-power"></i>
                <span>Logout</span>
              </a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <!-- Header -->
    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" >
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-8"></span>
      <!-- Header container -->
      
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            
            <div class="card-body pt-0 pt-md-4">
              <div class="row">
                <div class="col">
                  <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                    <div>
                      <!-- <span class="heading">22</span>
                      <span class="description">Friends</span> -->
                    </div>
                    <div>
                      <!-- <span class="heading">10</span>
                      <span class="description">Photos</span> -->
                    </div>
                    <div>
                      <!-- <span class="heading">89</span>
                      <span class="description">Comments</span> -->
                    </div>
                  </div>
                </div>
              </div>
              <div class="text-center">
                <h3><?php echo $nm ?><span class="font-weight-light"></span>
                </h3>
                <div class="h5 font-weight-300">
                  <i class="ni location_pin mr-2"></i><?php echo $dist." - ".$state ?>
                </div>
                <div class="h4 mt-4">
                  <i class="ni business_briefcase-24 mr-2"></i><?php echo "Ambulance Driver - LYFsavers"  ?>
                </div>
                <hr class="my-4" />
                <div class="h5 font-weight-500">
                <label><b>Email-id : </b><?php echo $em ?></label><br>
                <label><b>Contact No : </b><?php echo $mob ?></label><br>
                <label><b>Aadhar No : </b><?php echo $aadhar_no ?></label><br>
                <label><b>PAN Card No : </b><?php echo $pan_no ?></label><br>
                <label><b>Driving Licence No : </b><?php echo $licence_no ?></label><br>
                <label><b>Address : </b><?php echo $address ?></label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">My account profile</h3>
                </div>
                
              </div>
              </div>
               <div class="card-body">
                <form action="Driver_Profile.php" method="POST">
                <h6 class="heading-small text-muted mb-4">User information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-10">
                      <div class="form-group">
                        <label class="form-control-label">Name</label>
                        <input type="text" id="Driv_profile_name" name="Driv_profile_name" class="form-control form-control-alternative" placeholder="Name"  value= "<?php echo $nm; ?>" required>
                      </div>
                    </div>
                    </div>
                 
                    <div class="row">
                    <div class="col-lg-5">
                      <div class="form-group">
                        <label class="form-control-label">Mobile</label>
                        <input type="text" id="Driv_profile_mob" name="Driv_profile_mob" class="form-control form-control-alternative" placeholder="10 digit Mobile Number" value = "<?php echo $mob; ?>" required >
                      </div>
                    </div>
       
          <div class="col-lg-5">
                      <div class="form-group">
                        <label class="form-control-label">Aadhar No</label>
                        <input type="text" id="Driv_profile_aadhar" name="Driv_profile_aadhar" class="form-control form-control-alternative" placeholder="Aadhar No." value = "<?php echo $aadhar_no; ?>" required >
                      </div>
                    </div>
                    </div>

                    <div class="row">
                    <div class="col-lg-5">
                      <div class="form-group">
                        <label class="form-control-label">PAN Card No</label>
                        <input type="text" id="Driv_profile_pan_no" name="Driv_profile_pan_no" class="form-control form-control-alternative" placeholder="PAN Card No." value = "<?php echo $pan_no; ?>" required >
                      </div>
                    </div>
                    
                    <div class="col-lg-5">
                      <div class="form-group">
                        <label class="form-control-label">Driving Licence No</label>
                        <input type="text" id="Driv_profile_licence_no" name="Driv_profile_licence_no" class="form-control form-control-alternative" placeholder="Licence No." value = "<?php echo $licence_no; ?>" required >
                      </div>
                    </div>
                    </div>
         
         <div class="row">          
          <div class="col-lg-5">
                      <div class="form-group">
                        <label class="form-control-label" >Street</label>
                        <input type="text" id="Driv_profile_street" name="Driv_profile_street" class="form-control form-control-alternative" placeholder="Street" value= "<?php echo $street; ?>" required >
                      </div>
                    </div>
        
          <div class="col-lg-5">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Village</label>
                        <input type="text" id="Driv_profile_village" name="Driv_profile_village" class="form-control form-control-alternative" placeholder="Village" value = "<?php echo $village; ?>" required >
                      </div>
                    </div>
                    </div>
            
             <div class="row">    
            <div class="col-lg-5">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Taluka</label>
                        <input type="text" id="Driv_profile_tal" name="Driv_profile_tal" class="form-control form-control-alternative" placeholder="Taluka"  value= "<?php echo $taluka; ?>" required >
                      </div>
                    </div>
      
          <div class="col-lg-5">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">District</label>
                        <input type="text" id="Driv_profile_dist" name="Driv_profile_dist" class="form-control form-control-alternative" placeholder="District" value= "<?php echo $dist; ?>" required >
                      </div>
                    </div>
                  </div>
                 
           <div class="row">          
          <div class="col-lg-5">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">State</label>
                        <input type="text" id="Driv_profile_state" name="Driv_profile_state" class="form-control form-control-alternative" placeholder="State"  required  >
                      </div>
                    </div>
        </div>
         
           </div>    
                <hr class="my-4" />
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Profile Picture</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-address">Select Image File</label>
                        <input id="Driv_profile_photo" name="Driv_profile_photo" class="form-control form-control-alternative" placeholder="Home Address" type="file" >
                      </div>
                    </div>
                  </div>
                </div>
        
                <center>
                 <div class="text-center">
                          <button onclick="enable()" type="submit" class="btn btn-warning my-3" required  name="edit" id="edit">Edit</button>
                 
              <button onclick="Driver_Profile()" type="submit" class="btn btn-primary my-3" required  name="save_changes" id="save_changes">Save Changes</button>             
         </div>
               </center>
        </form>
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



<?php 
  include('connection.php');
  session_start();

  $role = $_SESSION['role'];
  $name = $_SESSION['name'];
  if((isset($_POST['SA_AMA_verify'])))
  {
    $AMA_email = $_POST['SA_AMA_veri_email'];
    $AMA_mob = $_POST['SA_AMA_veri_Mob'];
    $add_role= $_POST['role'];

    $sql = "INSERT INTO `admin_registration`( email, mobile, admin_type, flag) VALUES ('$AMA_email','$AMA_mob','$add_role',0)";
    $result = mysqli_query($conn,$sql);
    if($result)
    {
       echo "<script>
                alert('Admin added Sucessfully..!!');
       </script>";
    }
    else
    {
       echo "<script>
                alert('Something went Wrong!!');
       </script>";
    }
  }

    $AMA= mysqli_fetch_array(mysqli_query($conn,"SELECT count(*) as AMA from `ambulance_admin`"));
    $HA= mysqli_fetch_array(mysqli_query($conn,"SELECT count(*) as HA from `hospital_admin`"));
    $PA= mysqli_fetch_array(mysqli_query($conn,"SELECT count(*) as PA from `police_admin`"));

?>
<!DOCTYPE html>
<html>

<head>
<script>

function SA_AMBULANCE_ADMIN()
{


	var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	var email=document.getElementById("SA_AMA_veri_email").value;

	var mobile_no = /^\d{10}$/; 
	//var Email=document.getElementById("SA_veri_email").value;
	var mob = document.getElementById("SA_AMA_veri_Mob").value;
	
	
			if((email==""))
			{
				alert("Plz Enter your Email id ");
				return false;
			}else if(!email.match(mailformat))
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
  <title>Super Admin - Add Aadmin</title>
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

<body>
  
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
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                
              </span>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">Welcome!</h6>
            </div>
            <a href="SA_Profile.php" class="dropdown-item">
              <i class="ni ni-single-02"></i>
              <span>My profile</span>
            </a>
            
            <div class="dropdown-divider"></div>
            <a href="Login.php" class="dropdown-item">
              <i class="ni ni-user-run"></i>
              <span>Logout</span>
            </a>
          </div>
        </li>
      </ul>
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a>
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
            <a class="nav-link" href="SA_Home.php">
              <i class="ni ni-tv-2 text-primary"></i> Dashboard
            </a>
          </li>
		  <!--add AMbulance info-->
		  <li class="nav-item">
            <a class="nav-link" href="SA_Add_Admin.php">
              <i class="ni ni-ambulance text-primary"></i>Add Ambulance Admin
            </a>
          </li>
		  <!--register ambulance driver-->
		  <li class="nav-item">
            <a class="nav-link" href="SA_Add_Admin.php">
              <i class="ni ni-single-02 text-red"></i>Add Hospital Admin
            </a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="SA_Add_Admin.php">
              <i class="ni ni-single-02 text-red"></i>Add Police station Admin
            </a>
          </li>
		  
		   <!--Logs-->
		  <li class="nav-item">
            <a class="nav-link" href="SA_Admin_Logs.php">
              <i class="ni ni-collection text-green"></i>Logs
            </a>
          </li>
		  
         
          <li class="nav-item">
            <a class="nav-link" href="SA_Profile.php">
              <i class="ni ni-single-02 text-yellow"></i> User profile
            </a>
          </li>
       
       
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="SA_Add_Admin.php">Add Admin</a>
        
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
        
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold">Super Admin - <label ><?php echo $name ?></label></span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <div class=" dropdown-header noti-title">
                <h6 class="text-overflow m-0">Welcome!</h6>
              </div>
              <a href="SA_Profile.php" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span>My profile</span>
              </a>
            <div class="dropdown-divider"></div>
              <a href="Login.php" class="dropdown-item">
                <i class="ni ni-user-run"></i>
                <span>Logout</span>
              </a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
      <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total Ambulance Admins</h5>
                      <span id= "NA_total_ambulance"class="h2 font-weight-bold mb-0"></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                        <i class="fas fa-ambulance"></i>
                      </div>
                    </div>
                  </div>
                   <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-nowrap text-warning"><b><font size="5px"><?php echo $AMA['AMA'] ?></font></b></span>
                  </p>
                </div>
              </div>
            </div>
            
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total Hospital Admins</h5>
                      <span id="NA_total_ambulance_driver"class="h2 font-weight-bold mb-0"></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                        <i class="fas fa-users"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-nowrap text-warning"><b><font size="5px"><?php echo $HA['HA'] ?></font></b></span>
                  </p>
                </div>
              </div>
            </div>
			      <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total Police Station Admins</h5>
                      <span id="NA_total_ambulance_driver"class="h2 font-weight-bold mb-0"></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                        <i class="fas fa-users"></i>
                      </div>
                    </div>
                  </div>
                   <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-nowrap text-warning"><b><font size="5px"><?php echo $PA['PA'] ?></font></b></span>
                  </p>
                </div>
              </div>
            </div>
          
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-4">
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-7">
          <div class="card bg-secondary shadow border-0">
            
            <div class="card-body px-lg-5 py-lg-5">
              
              <form role="form" action="SA_Add_Admin.php" method="POST">
                  
                    <div class="col-lg-12">
					
                      <div class="form-group" >
                        <label class="form-control-label" for="input-username">Enter your Email-id</label>
                           <input id ="SA_AMA_veri_email" name="SA_AMA_veri_email" class="form-control" placeholder="Enter your email" type="text" required>
                      </div>
                    </div>

                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username" text-align="center" >10 digit Mobile Number</label>
                           <input id ="SA_AMA_veri_Mob" name="SA_AMA_veri_Mob" class="form-control" placeholder="10 digit Mobile Number" type="text" required align="center">
                      </div>
                    </div>

                    <div class="col-lg-12">
                      <label class="form-control-label" >Choose Your Role</label>
                      <select class="form-control form-control-alternative" name="role">
                        <option>Select Role</option>
                        <option value="hospital_admin">Hospital Admin</option>
                        <option value="police_admin">Police Station Admin</option>
                        <option value="ambulance_admin">Ambulance Admin</option>
                      </select>
                    </div>
					
                <div class="text-center">
                  <button id= "SA_AMA_verify" name="SA_AMA_verify" type="submit" required="true" class="btn btn-success my-4" onclick="SA_Ambulance_Admin()">Add Admin</button>
                  <button id= "discard" type="submit" required="true" class="btn btn-danger my-4" onclick="discard()">Discard</button>
                </div>
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
  <!-- Optional JS -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBd3PjUqq81lIOfBPYXrQGWwK5T4ystZjA"></script>
  <!-- Argon JS -->
  <script src="../assets/js/argon.js?v=1.0.0"></script>
</body>

</html>
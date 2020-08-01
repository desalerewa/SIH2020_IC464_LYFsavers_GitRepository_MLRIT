<?php 
include('connection.php');
session_start();

$id = $_SESSION['id'];
$h_nm = $_SESSION['h_nm'];
$nm=$_SESSION['name'];
$category = $_SESSION['category'];
//echo $category;

$Cases = mysqli_fetch_array(mysqli_query($conn, "SELECT count(*) as cases FROM `logs` WHERE `hospital_id`='".$id."'"));
$Ambulance = mysqli_fetch_array(mysqli_query($conn,"SELECT count(*) as amb from `van_info` WHERE `owner_id` = '".$_SESSION['id']."'"));
$Driver = mysqli_fetch_array(mysqli_query($conn,"SELECT count(*) as driver from `driver_info` Where `owner_id` = '".$_SESSION['id']."'"));

if(isset($_POST['HA_amb_submit']))
{
    $no_plate = $_POST['HA_reg_no'];
    $type = $_POST['HA_type_ambulance'];

    $sql="INSERT INTO `van_info`(`owner_id`,`owner_name`,`no_plate_no`,`vehicle_type`,`category`) VALUES ('$id','$h_nm','$no_plate','$type','$category')";
    $res_sql= mysqli_query($conn,$sql);
    if($res_sql)
    {
        $sql = "UPDATE `van_info` set `van_id` = concat(`prefix`,`id`)";
        $res = mysqli_query($conn,$sql);

        if($res)
          {
            echo"<script type='text/javascript'> 
                alert('Ambulance record inserted...!!');
              </script>";
            header("Location:HA_Add_Ambulance_info.php");
          }
    }
    else
    {
        echo"<script type='text/javascript'> 
                alert('Problem occured while inserting record...!!');
              </script>";

           header("Location:HA_Add_Ambulance_info.php");
    }
}


?>
<!DOCTYPE html>
<html>

<head>
<script>
	function ambulance_info()
	{
		
		var name_with_space= /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/;
		var name_widout_space= /^[a-zA-Z-]+$/;
		var no=/^[0-9]+$/;
		
		
		
		var name=document.getElementById("GA_reg_name").value;
		var plat_no=document.getElementById("GA_reg_no").value;
		var street=document.getElementById("GA_reg_street").value;
		var village=document.getElementById("GA_reg_village").value;
		var tal=document.getElementById("GA_reg_tal").value;
		var dist=document.getElementById("GA_reg_dist").value;
		var state=document.getElementById("GA_reg_name").value;
		var plat_no=document.getElementById("GA_reg_no").value;
	
			if(!name.match(name_with_space))
			{
				 
				alert("Plz Enter valid name  ");
				return false;
			}
			else if(!(plat.match(no)) || (plat.length!=12))
			{
				alert("Plz Enter valid plat  no ");
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
				window.location.replace("HA_home.php");
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
  <title>Hospital Admin - Ambulance Information</title>
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
 <a class="navbar-brand pt-0">
        <img src="logo_black.png" class="navbar-brand-img" alt="...">
      </a>
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
            <a href="HA_Profile.php" class="dropdown-item">
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
        <!-- Form -->
        
       <!-- Navigation -->
         <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="HA_Home.php">
              <i class="ni ni-tv-2 text-primary"></i> Dashboard
            </a>
          </li>
      
      <!--INBOX-->
      <li class="nav-item">
            <a class="nav-link" href="HA_Inbox.php">
              <i class="ni ni-single-02 text-red"></i>Inbox
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="HA_Add_Ambulance_info.php">
              <i class="ni ni-ambulance text-primary"></i>Add Ambulance Information
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="HA_Add_Ambulance_driver.php">
              <i class="ni ni-single-02 text-black"></i> Register Ambulance Driver
            </a>
          </li>
      
        <li class="nav-item">
            <a class="nav-link" href="HA_logs.php">
              <i class="ni ni-bullet-list-67 text-black"></i>LOGS
            </a>
          </li>
         
          <li class="nav-item">
            <a class="nav-link" href="HA_Profile.php">
              <i class="ni ni-single-02 text-yellow"></i> User profile
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
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="HA_Add_Ambulance_info.php">Add Ambulance Information</a>
        
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold">
                     <font color="red">Hospital Admin - </font>
                    <label><?php echo $h_nm ?></label><br>
                    <label style="margin-left: 120px;"><?php echo $nm ?></label>
                  </span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <div class=" dropdown-header noti-title">
                <h6 class="text-overflow m-0">Welcome!</h6>
              </div>
              <a href="HA_Profile.php" class="dropdown-item">
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
                      <h5 class="card-title text-uppercase text-muted mb-0">Total Cases</h5>
                      <span id= "SA_total_ambulance_admins"class="h2 font-weight-bold mb-0"></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                        <i class="fas fa-ambulance"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-nowrap text-warning"><b><font size="5px"><?php echo $Cases['cases'] ?></font></b></span>
                  </p>
                </div>
              </div>
            </div>
            

          <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total Ambulance</h5>
                      <span id= "GA_total_ambulance"class="h2 font-weight-bold mb-0"></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                        <i class="fas fa-ambulance"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-nowrap text-warning"><b><font size="5px"><?php echo $Ambulance['amb'] ?></font></b></span>
                  </p>
                </div>
              </div>
            </div>

              <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total Ambulance Driver</h5>
                      <span id="GA_total_ambulance_driver"class="h2 font-weight-bold mb-0"></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                        <i class="fas fa-users"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-nowrap text-warning"><b><font size="5px"><?php echo $Driver['driver'] ?></font></b></span>
                  </p>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
   <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-8 col-md-7">
          <div class="card bg-secondary shadow border-0">

            <div class="card-body px-lg-5 py-lg-5">

            <form role="form" action="HA_Add_Ambulance_info.php" method="POST">

              <div class="row">
  
                    <div class="col-lg-6">
                      <div class="form-group">
							<label class="form-control-label" for="input-username"> Enter Ambulance Owner Name:</label>
                            <input id="GA_reg_name" name="GA_reg_name"class="form-control" placeholder="Name of owner" type="text" value="<?php echo $h_nm ?>" required disabled>
                      </div>
                    </div>
					
					<div class="col-lg-6">
                      <div class="form-group">
							         <label class="form-control-label" for="input-username"> Ambulance Number Plate No:</label>
                        <input id="HA_reg_no" name="HA_reg_no"class="form-control" placeholder="Ambulance Number Plate No:" type="text" required>
                      </div>
                    </div>
					
					       <div class="col-lg-6">
                  <div class="form-group">
							       <label class="form-control-label" for="input-username"> Type of Ambulance:</label>
                      <select id="GA_type_ambulance"class="form-control" name="HA_type_ambulance">
                          <option>Select appropriate option</option> 
                          <option value="Van">Van</option>
                          <option value="Traveller">Traveller</option>  
                     </select>
                  </div>
                </div>
              </div>
                <div class="col-lg-6">
                  <div class="form-group">
                     <label class="form-control-label" for="input-username">RC Book Photo:</label>
                     <input type="file" name="RC_book" >
                  </div>
                </div>
			
                <div class="text-center">
                  <button id="HA_amb_submit" name="HA_amb_submit" type="submit" required="true" class="btn btn-success my-4" onclick="ambulance_info()">Add Ambulance</button>
                  <button type="submit" required="true" class="btn btn-danger my-4" onclick="discard()">Discard</button>
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




<?php 
    include('connection.php');
    session_start();

    $id = $_SESSION['driver_id'];
    $Cases = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) AS cases From `logs` WHERE `amb_driver_id` = '".$id."'"));


    if(isset($_POST['submit']))
    {
        $accident_location =$_POST['accident_location'];
        $_SESSION['accident_location'] = $accident_location;

        header("Location:Driver_list_hos.php"); 
    }


?> 

<!DOCTYPE html>
<html>

<head>

<script>

document.getElementById("myForm").style.display = "block";
function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
  var lat = position.coords.latitude;
  var lon = position.coords.longitude;
  x.innerHTML = "Latitude: " + position.coords.latitude + 
  "<br>Longitude: " + position.coords.longitude;
  document.cookie = "lat="+lat;
  document.cookie = "lon="+lon;
</script>




<style>
.button {
  background-color: #ff0040;
  border: none;
  color: white;
  padding: 24px;
  text-align: center;
  text-decoration: bold;
  display: inline-block;
  font-size: 24px;
  margin: 10px 8px;
  cursor: pointer;
  border-radius: 7px;
  
}




</style>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Driver- Dashboard</title>
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
    <div class="container-fluid" >
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
     <a class="navbar-brand pt-0" >
        <img src="logo_black.png" class="navbar-brand-img" alt="...">
      </a>
      <!-- User -->
      <ul class="nav align-items-center d-md-none">
        
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
            <a href="Driver_Profile.php" class="dropdown-item">
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
            <a class="nav-link" href="Driver_Home.php">
              <i class="ni ni-tv-2 text-primary"></i> Dashboard
            </a>
          </li>
          
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
        
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="Driver_Home.php">Dashboard</a>
        
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <div class="media-body ml-2 d-none d-lg-block">
                 <span class="mb-0 text-sm  font-weight-bold">
                    <font color="red">Ambulance Driver - </font>
                    <label><?php echo $_SESSION['driver_name'] ?></label><br>
                  </span>
          
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <div class=" dropdown-header noti-title">
                <h6 class="text-overflow m-0">Welcome!</h6>
              </div>
              <a href="Driver_Profile.php" class="dropdown-item">
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
                      <span id= "NA_total_ambulance"class="h2 font-weight-bold mb-0"></span>
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
                      <h5 class="card-title text-uppercase text-muted mb-0">NOTE: </h5>
                      <span id="NA_total_ambulance_driver"class="h2 font-weight-bold mb-0"></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                        <i class="ni ni-bell-55"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    Click below Activate button once you reached to accident location.
                  </p>
                </div>
              </div>
            </div>

               <div class="col-xl-5 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">NOTE: </h5>
                      <span id="NA_total_ambulance_driver"class="h2 font-weight-bold mb-0"></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                        <i class="ni ni-bell-55"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    Click to Marker/pin shown in map and get your location.Then fill the location in text box and click on button below it to get nearest hospital list.
                  </p>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
   <!-- Page content -->
   <form method="POST" style="background-color: #172b4d;">
    <div class="container mt--8 pb-6" style="background-color: #172b4d;">
      <div class="row justify-content-center">
        <div class="col-lg-12 col-md-8" style="background-color: #172b4d;">
          <div class="card bg-secondary shadow border-0" style="background-color: #172b4d;">
            
            <div class="card-body px-lg-10 py-lg-8" style="background-color: #172b4d;">
              <div class="text-center">
                 <button  class="button"  id="activate" type="submit"  name= "activate" required="true"><b>Activate Location</b></button>
              </div>
              <?php
                  include('connection.php');
                  if (isset($_POST["activate"]))
                  {
                    $latitude = $_COOKIE['lat'];
                    $longitude = $_COOKIE['lon']; 

                    $_SESSION['latitude'] = $latitude;
                    $_SESSION['longitude']  =$longitude;
              ?>

              <p class = style= line-height:3.8;></p>
        

     <div class="container" style="background-color: #172b4d;">
      <div class="row" >
        <div class="col-md-8 col-sm-1">
          <iframe  width="100%" height="600" style="border:1px solid lightblue;" src="https://www.google.com/maps?q=<?php echo $latitude; ?>,<?php echo $longitude; ?>&output=embed"></iframe>
        </div>
      <div class="col-md-4 col-sm-8">
       <div class="row justify-content-center">
        <div class="col-lg-80">
          <div class="card bg-secondary shadow border-0" style="background-color: #172b4d;">

            <div class="card-body px-lg-4 py-lg-4">

              <form role="form" action="Driver_list_hos.php" method="POST">

                 <div class="row">                   
                    <div class="col-lg-12">
                      <div class="form-group">
                            <label class="form-control-label" for="input-username"> Enter accident location from map:</label>
                            <input id="accident_location" name="accident_location" class="form-control" placeholder="Accident Location" type="text" required>
                      </div>
                    </div>
                  </div>
                    <div>
                    <button  id="submit" name="submit" type="submit" required="true" class="btn btn-success my-2" >View list of nearest hospitals</button>   
                    </div>
                </form>
              </div>
            </div>
          </div>
         </div>
        </div>
        <?php

        }

        ?>
           
          </form>        
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
            
           
          
         
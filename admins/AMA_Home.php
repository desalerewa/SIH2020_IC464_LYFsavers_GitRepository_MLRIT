<?php
include('connection.php');
session_start();

  $role = $_SESSION['role'];
  $name = $_SESSION['name'];

  $NGO= mysqli_fetch_array(mysqli_query($conn,"SELECT count(*) as NGO from `ngo_admin`"));
  $NHAI= mysqli_fetch_array(mysqli_query($conn,"SELECT count(*) as NHAI from `nhai_admin`"));

  $govt=mysqli_query($conn,"SELECT `email`,`mobile`,`flag` FROM `admin_registration` WHERE `admin_type` = 'ngo_admin'");
  $res_gov = mysqli_num_rows($govt);
  $priv= mysqli_query($conn,"SELECT `email`,`mobile`,`flag` FROM `admin_registration` WHERE `admin_type` = 'nhai_admin'");
   $res_priv = mysqli_num_rows($priv);

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Ambulance Admin - Dashboard</title>
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
            <a href="AMA_Profile.php" class="dropdown-item">
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
        <!-- Form -->
        
        <!-- Navigation -->
        <ul class="navbar-nav" top-margin="10%">
          <li class="nav-item">
            <a class="nav-link" href="AMA_Home.php">
              <i class="ni ni-tv-2 text-primary"></i> Dashboard
            </a>
          </li>
    
      <!--add AMbulance info-->
      <li class="nav-item">
            <a class="nav-link" href="AMA_Add_Admin.php">
              <i class="ni ni-ambulance text-primary"></i>Add NGO Ambulance Admin
            </a>
          </li>
      
      <!--register ambulance driver-->
      <li class="nav-item">
            <a class="nav-link" href="AMA_Add_Admin.php">
              <i class="ni ni-single-02 text-red"></i>Add NHAI Ambulance Admin
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="AMA_Profile.php">
              <i class="ni ni-single-02 text-yellow"></i> User profile
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
  <div class="main-content" >
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="AMA_Home.php">Dashboard</a>
        
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold">
                    <label style='color:red'> Ambulance Admin - </label>
                    <label ><?php  echo $name ?></label>
                </span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <div class=" dropdown-header noti-title">
                <h6 class="text-overflow m-0">Welcome!</h6>
              </div>
              <a href="AMA_Profile.php" class="dropdown-item">
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
    <div class="header bg-gradient-primary pb-8 pt-10 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total NGO Ambulance Admin</h5>
                      <span id= "NA_total_ambulance"class="h2 font-weight-bold mb-0"></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                        <i class="fas fa-users"></i>
                      </div>
                    </div>
                  </div>
                   <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-nowrap text-warning"><b><font size="5px"><?php echo $NGO['NGO'] ?></font></b></span>
                  </p>
                </div>
              </div>
            </div>
            
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total NHAI Ambulance Admin</h5>
                      <span id="NA_total_ambulance_driver"class="h2 font-weight-bold mb-0"></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                        <i class="fas fa-users"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-nowrap text-warning"><b><font size="5px"><?php echo $NHAI['NHAI'] ?></font></b></span>
                  </p>
                </div>
              </div>
            </div>
          
          </div>
        </div>
      </div>
    </div>
    <!-- Government Admin list-->
    <div class="container mt--8 pb-5" style="max-width: 1300px;">
      <div class="row">
        <div class="col-lg-6 col-md-7">
          
            <div class="card-body px-lg-5 py-lg-5"> 
                <h3 style="text-align: center;margin-top: auto 0; color: white;">NGO Ambulance Admins</h3>   
                <div class="table-responsive">
                   <table width="900px"  border="1">
                   <table class="table align-items-center table-dark table-flush" name="new_request_table">
                      <thead class="thead-dark">
                        <tr>
                    
                        <th scope="col">Serial No.</th>
                        <th scope="col">Email</th>
                        <th scope="col">Mobile No</th>
                        <th scope="col">Register Status</th>
                    
                        </tr>
                      </thead>
                        <tbody>
                  
                      <?php 
                      if($res_gov > 0)
                      {
                          $i=1;
                            while($row = mysqli_fetch_array($govt))
                           {
                             echo '
                              <tr>
                              <td>'.$i.'</td>
                              <td>'.$row["email"].'</td>
                              <td>'.$row["mobile"].'</td>';
                              if($row["flag"] == '0')
                                    {
                                      echo "<td style='color:red;'>Not Verified</td>";
                                    }
                                    else
                                      {
                                          echo '<td>Registered</td>';
                                      }
                             echo'</tr>';
                              $i=$i+1;
                            }
                      }
                      else
                      {
                        echo "
                            <td rowspan = 8 style='color:red;'>No Admin Register yet </td>
                        ";
                      }
                           
                      ?>
                </tbody>
                   </table>
                 </table>
                </div>    
            </div>

        </div>

      <!-- Private Admin list-->
      <div class="col-lg-6 col-md-7">
          
              <div class="card-body px-lg-5 py-lg-5">
              <h3 style="text-align: center;margin-top:auto 0; color: white;">NHAI Ambulance Admins</h3>   
                <div class="table-responsive">
                   <table width="900px"  border="1">
                   <table class="table align-items-center table-dark table-flush" name="new_request_table">
                      <thead class="thead-dark">
                        <tr>
                    
                        <th scope="col">Serial No.</th>
                        <th scope="col">Email</th>
                        <th scope="col">Mobile No</th>
                        <th scope="col">Register Status</th>
                    
                        </tr>
                      </thead>
                       <tbody>
                  
                      <?php 
                      if($res_priv > 0)
                      {
                          $i=1;
                            while($row = mysqli_fetch_array($priv))
                           {
                             echo '
                              <tr>
                              <td>'.$i.'</td>
                              <td>'.$row["email"].'</td>
                              <td>'.$row["mobile"].'</td>';
                              if($row["flag"] == '0')
                                    {
                                      echo "<td style='color:red;'>Not Verified</td>";
                                    }
                                    else
                                      {
                                          echo '<td>Registered</td>';
                                      }
                             echo'</tr>';
                              $i=$i+1;
                            }
                      }
                      else
                      {
                        echo "
                            <td rowspan = 8 style='color:red;'>No Admin Register yet </td>
                        ";
                      }
                           
                      ?>
                </tbody>
                   </table>
                 </table>
             
            </div>
          </div>
      </div>
    </div>
  </body>
</html>
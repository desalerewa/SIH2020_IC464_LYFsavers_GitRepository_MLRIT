<?php
include('connection.php');
session_start();  

$driver_id = $_SESSION['driver_id'];
$driver_name = $_SESSION['driver_name'];
$driver_mob= $_SESSION['driver_mob'];
$van_id = $_SESSION['van_id'];


$today_date = date('Y-m-d');

$Cases = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) AS cases From `logs` WHERE `amb_driver_id` = '".$driver_id."'"));

//calculating Distance
function distance($lat1,$long1,$lat2,$long2,$unit)
{
    if(($lat1 == $lat2) and ($long1 == $long2))
    {
       echo "Same position";
    }
    else
    {
        $theta = abs($long1 - $long2);
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtolower($unit);

        if ($unit = 'k') 
        {
            return ($miles * 1.609344);
        }
    }
}


$lat_sql= mysqli_query($conn,"SELECT `hospital_id`,`latitude` from `hospital_admin`");
$long_sql = mysqli_query($conn,"SELECT `longitude` from `hospital_admin`");

// $lat1=21.110817;
// $long1 = 74.798254;
// $lat1=20.975454;
// $long1 = 74.786508;
$lat1 = $_SESSION['latitude'];
$long1 = $_SESSION['longitude'];
$unit = 'k';

$lat=array();
$long=array();
$hospital_id =array();

//store latitude into array
while ($row = mysqli_fetch_array($lat_sql)) 
{
  array_push($lat, $row['latitude']);
  array_push($hospital_id, $row['hospital_id']);
}

//store Longitude into array
while ($row = mysqli_fetch_array($long_sql)) 
{
  array_push($long, $row['longitude']);
}

//distance arrays
$dist = array();
for ($i=0; $i < sizeof($lat) ; $i++) 
{ 
    $x = round(distance($lat1,$long1,$lat[$i],$long[$i],$unit),1);
    array_push($dist, $x);
}

$n = sizeof($dist); 
// Traverse through all array elements 
for($i = 0; $i < $n; $i++)  
{ 
    // Last i elements are already in place 
    for ($j = 0; $j < $n - $i - 1; $j++)  
    { 
        // traverse the array from 0 to n-i-1 
        // Swap if the element found is greater 
        // than the next element 
        if ($dist[$j] > $dist[$j+1]) 
        { 
            //sorting distance array
            $t = $dist[$j]; 
            $dist[$j] = $dist[$j+1]; 
            $dist[$j+1] = $t; 

            //sorting id array
            $x = $hospital_id[$j]; 
            $hospital_id[$j] = $hospital_id[$j+1]; 
            $hospital_id[$j+1] = $x; 


        } 
    } 
} 

if(isset($_POST['requested']))
{
    $ppl = $_POST['people'];
    $req_id = $_POST['requested'];
    $time = date('H:i:s');
    $date = date('Y-m-d');

    //hospital info
    $sql = "SELECT * From `hospital_admin` Where `hospital_id` = '".$req_id."' ";
    $res = mysqli_query($conn,$sql);

    $police_station;
    $hid;
    $hospital_name;
    $mobile;
    if($res)
    {
          while ($row = mysqli_fetch_array($res)) 
          {
             $hid = $row['hospital_id'];
             $hospital_name = $row['hospital_name'];
             $mobile =  $row['mobile'];
             $police_station = $row['police_station_name_under_hospital_comes'];
          }
    }

     //police station
    $psql= mysqli_query($conn,"SELECT `police_id` from `police_admin` where `police_station_name`= '".$police_station."' ");
    //$sql = "SELECT * FROM `police_admin` WHERE `police_station_name` LIKE '"%$police_station%"'";
    $psid;
    while ($row = mysqli_fetch_array($psql)) 
    {
        $psid= $row['police_id'];
    }

    //amb info
    $amb_sql = mysqli_query($conn,"SELECT `van_id`,`no_plate_no`,`vehicle_type` From `van_info` WHERE `van_id` = '".$van_id."'");
    $no_plate;
    $vehicle_type;

    while ($row = mysqli_fetch_array($amb_sql)) 
    {
        $no_plate = $row['no_plate_no'];
        $vehicle_type = $row['vehicle_type'];
    }

    $sql = "INSERT INTO `logs`(`amb_driver_id`,`amb_driver_name`,`amb_driver_mobile`,`amb_id`,`amb_no_plate`,`category`,`req_send_date`,`req_send_time`,`no_of_patient`,`hospital_id`,`hospital_name`,`hospital_mob`,`ps_id`,`ps_name`)VALUES('$driver_id', '$driver_name', '$driver_mob', '$van_id', '$no_plate', '$vehicle_type','$date', '$time' ,'$ppl','$hid','$hospital_name','$mobile','$psid','$police_station')";

    // $sql = "INSERT INTO `logs`(`amb_driver_id`,`amb_driver_name`,`amb_driver_mobile`,`amb_id`,`amb_no_plate`,`category`,`req_send_date`,`req_send_time`,`no_of_patient`,`hospital_id`,`hospital_name`,`hospital_mob`,`ps_id`,`ps_name`)VALUES(\'',\'Vasant Patil\',\'1254801450\',\'INMHAMB2\',\'MH40X5000\',\'Van\',\'2020-07-24\',\'14:15:39\',\'2\',\'INMH023\',\'Suyog hospital, Dhule\',\'2015036042\',\'INMH031\',\'Deopur Police Station, Dhule\')";
    $result = mysqli_query($conn,$sql);

     // echo $did."<br>".$name."<br>".$dmob."<br>".$vanid."<br>".$no_plate."<br>".$vehicle_type."<br>".$hid."<br>".$hospital_name."<br>".$mobile."<br>".$psid."<br>".$police_station;

    if($result)
    {
        $sql = "UPDATE `logs` SET `case_id`= concat(`prefix`,`log_id`)";
        $res = mysqli_query($conn,$sql);
        if($result)
        {
             header('location:Driver_logs.php');
        }
    }
    else
    {
       
        echo"<script>alert('Error in sending request. Try Again!!');</script>";
    }

}
?>
<!DOCTYPE html>
<html>

<head>
<style>
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
     <a class="navbar-brand pt-0" href="Driver_Home.php">
        <img src="logo_black.png" class="navbar-brand-img" alt="...">
      </a>
      <!-- User -->
      <ul class="nav align-items-center d-md-none">
        <li class="nav-item dropdown">
          
          
        
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
                    <label><?php echo $driver_name?></label><br>
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
                  <p class="mt-3 mb-0  text-sm">
                    Click on <u><b>Send Request</b></u> Button to send notification to nearest hospital.
                  </p>
                </div>
              </div>
            </div>
          
          </div>
        </div>
      </div>
    </div>
   <!-- Page content -->
   <div class="container mt--9 pb-5" style="max-width: 1600px; table-layout: fixed;">
    <div class="row justify-content-center">
      <div class="col-lg-12 col-md-8" style="width: 570px;">
        
        <div class="col">
          <div class="card bg-default shadow">
            <div class="card-header bg-transparent border-0">
              <div class="row">
              <h3 class="text-white mb-0" style="margin-left: 30px;">List of Nearest Hospitals</h3>
              <h3 class="text-white mb-0" style="margin-left: 750px;">DATE - <?php echo $today_date; ?> </h3>
              </div>
            </div>
            <div class="table-responsive">
              <!--<form method="post" action="HA_Home.php">-->
             

              <table class="table align-items-center table-dark table-flush" name="new_request_table">
                <thead class="thead-dark">
                  <tr style="word-wrap: ">
                    
                    <th scope="col">Serial<br>No.</th>
                    <th scope="col">Hosptal Name<br></th>
                    <th scope="col" style="max-width:100px;">Address of Hospitals</th>
                    <th scope="col">Distance in km<br> <label><i>(Approx.)</i></label></th>
                    <th scope="col">Accidental<br>Persons</th>
                    <th scope="col">Send Request</th>
                    
                  </tr>
                </thead>
                <tbody>  
                <?php 
                  $x = sizeof($hospital_id);
                   $p=1;
                for ($i=0; $i <$x ; $i++) 
                { 
                      $id = $hospital_id[$i];
                      $sql  =mysqli_query($conn,"SELECT * From `hospital_admin` WHERE `hospital_id` = '".$id."'");
                      
                    while($row = mysqli_fetch_array($sql))
                   {


                       echo '
                        <tr>
                        <td>'.$p.'</td>
                        <td>'.$row["hospital_name"].'</td>';

                        if(($row['village'] == $row['taluka']) and ($row['taluka'] == $row['district']))
                        {
                            echo'<td>'.$row["street"].''.$row["district"].','.$row["state"].'</td>';
                        }
                        else if(($row['village'] != $row['taluka']) and ($row['taluka'] == $row['district']))
                        {
                              echo'<td>'.$row["street"].','.$row['village'].','.$row["district"].','.$row["state"].'</td>';
                        }
                        else
                        {
                             echo'<td>'.$row["street"].','.$row['village'].','.$row['taluka'].','.$row["district"].','.$row["state"].'</td>';
                        }
                        echo'<td>'.$dist[$i].'</td>
                        <td>'.'<form name="myform" method="POST" action = "Driver_list_hos.php">
                                <input type="text" name="people" required>'.'</td>
                        <td>'.'
                            <button class="btn btn-success my-3" onclick="Admitted()" type="submit" name="requested" required value='.$hospital_id[$i].'>Send Request
                            </button></form>'.'</td> 
                            </tr>';
                    }
                    $p=$p+1;
                }
                      ?>
                </tbody>
              </table>
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



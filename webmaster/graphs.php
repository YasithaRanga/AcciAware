<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["webmaster"]) || $_SESSION["webmaster"] !== true){
    header("location: index.php");
    exit;
}

require '../core/database.php';

$typeQuery = "SELECT type, count(*) AS typecount FROM cases GROUP BY type"; 
$typeResult = $conn->query($typeQuery);

$causeQuery = "SELECT cause, count(*) AS causecount FROM cases GROUP BY cause"; 
$causeResult = $conn->query($causeQuery);

$vehicleQuery = "SELECT vehicle, count(*) AS vehiclecount FROM cases GROUP BY vehicle"; 
$vehicleResult = $conn->query($vehicleQuery);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
        <script type="text/javascript">  
           google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChart);  
           function drawChart()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['Type', 'TypeCount'],  
                          <?php  
                          while($row = $typeResult->fetch_assoc())  
                          {  
                               echo "['".$row["type"]."', ".$row["typecount"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      title: 'Percentage of Types of Accidents',  
                      is3D:true,  
                      pieHole: 0.4  
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechartbytype'));  
                chart.draw(data, options);  
           }  
    </script>  
    <script type="text/javascript">  
           google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChart);  
           function drawChart()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['Cause', 'CauseCount'],  
                          <?php  
                          while($row = $causeResult->fetch_assoc())  
                          {  
                               echo "['".$row["cause"]."', ".$row["causecount"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      title: 'Percentage of Causes of Accidents',  
                      is3D:true,  
                      pieHole: 0.4  
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechartbycause'));  
                chart.draw(data, options);  
           }  
    </script> 
    <script type="text/javascript">  
           google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChart);  
           function drawChart()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['Vehicle', 'VehicleCount'],  
                          <?php  
                          while($row = $vehicleResult->fetch_assoc())  
                          {  
                               echo "['".$row["vehicle"]."', ".$row["vehiclecount"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      title: 'Percentage of Vehicles of Accidents',  
                      is3D:true,  
                      pieHole: 0.4  
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechartbyvehicle'));  
                chart.draw(data, options);  
           }  
    </script>  
    <title>Graphs | Web Master Portal | AcciAware</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="welcome.php">AcciAware</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <p class="my-2 mx-2 text-right text-light">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b></p>
                    </li>
                    <li class="nav-item">
                        <a href="graphs.php" class="btn btn-success ml-3 mx-2">Graphs</a>
                    </li>
                    <li class="nav-item">
                        <a href="admins/" class="btn btn-success ml-3 mx-2">Admins</a>
                    </li>
                    <li class="nav-item">
                        <a href="users/" class="btn btn-success ml-3 mx-2">Users</a>
                    </li>
                    <li class="nav-item">
                        <a href="logout.php" class="btn btn-danger ml-3">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    
    <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-12">
                <div class="card text-black" style="border-radius: 25px;">
                <div class="card-body p-md-5">
                    <div class="row justify-content-center">
                    <div class="col-md-12 col-lg-12 col-xl-12 order-2 order-lg-1">
                        <p class="text-left justify-content-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Accidents Ratio By Types</p>
                        <div class="col-8">    
                                <div id="piechartbytype" style="width: 900px; height: 500px;"></div>  
                        </div>  

                        <p class="text-left justify-content-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Accidents Ratio By Causes</p>
                        <div class="col-8">    
                                <div id="piechartbycause" style="width: 900px; height: 500px;"></div>  
                        </div>  

                        <p class="text-left justify-content-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Accidents Ratio By Vehicles</p>
                        <div class="col-8">    
                                <div id="piechartbyvehicle" style="width: 900px; height: 500px;"></div>  
                        </div>  
                    </div> 
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </section>
</body>

</html>
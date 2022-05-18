<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["webmaster"]) || $_SESSION["webmaster"] !== true){
    header("location: index.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Web Master Panel | AcciAware</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="">AcciAware</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <p class="my-2 text-right text-light">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>.</p>
                    </li>
                    <li class="nav-item">
                        <a href="graphs.php" class="btn btn-success ml-3 mx-2">Graphs</a>
                    </li>
                    <li class="nav-item">
                        <a href="admins" type="button" class="btn btn-success mx-2">Admins</a>
                    </li>
                    <li class="nav-item">
                        <a href="users" type="button" class="btn btn-success mx-2">Users</a>
                    </li>
                    <li class="nav-item">
                    <a href="logout.php" class="btn btn-danger ml-3">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php
                            
        if(isset($_SESSION['status'])){
            ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $_SESSION['status'];?>
                </div>
            <?php
            unset($_SESSION['status']);
        }
        if(isset($_SESSION['fail'])){
            ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $_SESSION['fail'];?>
                </div>
            <?php
            unset($_SESSION['fail']);
        }

    ?>

    <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-12">
                <div class="card text-black" style="border-radius: 25px;">
                <div class="card-body p-md-5">
                    <div class="row justify-content-center">
                    <div class="col-md-12 col-lg-12 col-xl-12 order-2 order-lg-1">
                        <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Cases List</p>
                        <table class="table text-center table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Incident ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Vehicle Registration Number</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Vehicle</th>
                                    <th scope="col">Cause</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Info</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    require '../core/database.php';
        
                                    $sql = "SELECT vehicle_reg_number, incident_id, name, date, type, vehicle, cause, info, status, image1, image2, image3, image4 FROM cases";
                                    
                                    $result = $conn->query($sql);


                                    //Pagination

                                    
                                    $num_of_results = mysqli_num_rows($result);

                                    $num_of_total_pages = ceil($num_of_results/$num_of_results_per_page);

                                    if(!isset($_GET['page'])){
                                        $page = 1;
                                    }else{
                                        $page = $_GET['page'];
                                    }
        

                                    $this_page_first_result = ($page-1)*$num_of_results_per_page;

                                    $sql = "SELECT vehicle_reg_number, incident_id, name, date, type, vehicle, cause, info, status, image1, image2, image3, image4 FROM cases LIMIT " . $this_page_first_result . ',' . $num_of_results_per_page;
                                    
                                    $result = $conn->query($sql);


                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $row['incident_id'];?></td>
                                                    <td><?php echo $row['name'];?></td>
                                                    <td><?php echo $row['date'];?></td>
                                                    <td><?php echo $row['vehicle_reg_number'];?></td>
                                                    <td><?php echo $row['type'];?></td>
                                                    <td><?php echo $row['vehicle'];?></td>
                                                    <td><?php echo $row['cause'];?></td>
                                                    <td><?php echo $row['status'];?></td>
                                                    <td>
                                                        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseInfo<?php echo $row['incident_id'];?>" aria-expanded="false" aria-controls="collapseInfo<?php echo $row['incident_id'];?>">
                                                                More Info
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <div class="collapse" id="collapseInfo<?php echo $row['incident_id'];?>">
                                                        <p class="text-left h3 fw-bold mb-5 mx-1 mx-md-4 mt-4">Incident ID: <?php echo $row['incident_id'];?></p>
                                                        <div class="card card-body">
                                                            <div class="row">
                                                                <div class="alert alert-primary" role="alert">
                                                                    <?php echo $row['info'];?>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <img class="col-12 rounded" src="../users/uploads/<?php echo $row['image1'];?>"/>
                                                                </div>
                                                                <div class="col-6">
                                                                    <img class="col-12 rounded" src="../users/uploads/<?php echo $row['image2'];?>"/>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <img class="col-12 rounded" src="../users/uploads/<?php echo $row['image3'];?>"/>
                                                                </div>
                                                                <div class="col-6">
                                                                    <img class="col-12 rounded" src="../users/uploads/<?php echo $row['image4'];?>"/>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </tr>

                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="alert alert-danger" role="alert">
                                            <?php echo "No Results Found";?>
                                        </div>
                                        <?php
                                    }

                                
                                ?>
                            </tbody>
                        </table>
                        <nav class="d-flex justify-content-center" aria-label="...">
                            <ul class="pagination">                                
                        <?php
                        for($page=1; $page<=$num_of_total_pages; $page++){

                            echo '<li class="page-item"><a class="page-link" href="welcome.php?page=' . $page . '">' . $page . '</a></li>'; 
                            
                        }
                        ?>
                            </ul>
                        </nav>
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
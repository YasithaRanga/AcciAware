<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["admin"]) || $_SESSION["admin"] !== true){
    header("location: ../index.php");
    exit;
}
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
    <title>Users | AcciAware</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="../welcome.php">AcciAware</a>
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
                        <a href="../logout.php" class="btn btn-danger ml-3">Log Out</a>
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
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                <div class="card-body p-md-5">
                    <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-10 col-xl-10 order-2 order-lg-1">
                        <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Users List</p>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                <th scope="col">Vehicle Registration Number</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Insurance Company</th>
                                <th scope="col">Policy Number</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    require '../../core/database.php';
        
                                    $sql = "SELECT vehicle_reg_number, name, email, ins_company, policy_number FROM users";
                                    
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $row['vehicle_reg_number'];?></td>
                                                <td><?php echo $row['name'];?></td>
                                                <td><?php echo $row['email'];?></td>
                                                <td><?php echo $row['ins_company'];?></td>
                                                <td><?php echo $row['policy_number'];?></td>
                                                <td>
                                                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCase<?php echo $row['vehicle_reg_number'];?>" aria-expanded="false" aria-controls="collapseCases<?php echo $row['vehicle_reg_number'];?>">
                                                        View Cases
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="alert alert-success" role="alert">
                                            <?php echo "No Results Found";?>
                                        </div>
                                        <?php
                                    }

                                
                                ?>
                            </tbody>
                        </table>
                        <?php
                            $sql = "SELECT vehicle_reg_number, name, email, ins_company, policy_number FROM users";
                                    
                            $result = $conn->query($sql);
                                    
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    ?>
                                        <div class="collapse" id="collapseCase<?php echo $row['vehicle_reg_number'];?>">
                                            <p class="text-left h3 fw-bold mb-5 mx-1 mx-md-4 mt-4">Cases Reported By <?php echo $row['vehicle_reg_number'];?></p>
                                            <div class="card card-body">
                                                <table class="table table-success">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Incident ID</th>
                                                            <th scope="col">Name</th>
                                                            <th scope="col">Type</th>
                                                            <th scope="col">Vehicle</th>
                                                            <th scope="col">Cause</th>
                                                            <th scope="col">Status</th>
                                                            <th scope="col">Action</th>
                                                            <th scope="col">Info</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            $cases = "SELECT incident_id, name, type, vehicle, cause, info, status FROM cases WHERE vehicle_reg_number = '".$row['vehicle_reg_number']."'";

                                                            $caseResult = $conn->query($cases);
                                                                    
                                                            if ($caseResult->num_rows > 0) {
                                                                while($caseRow = $caseResult->fetch_assoc()) {
                                                                    ?>
                                                                        <tr>
                                                                            <td><?php echo $caseRow['incident_id'];?></td>
                                                                            <td><?php echo $caseRow['name'];?></td>
                                                                            <td><?php echo $caseRow['type'];?></td>
                                                                            <td><?php echo $caseRow['vehicle'];?></td>
                                                                            <td><?php echo $caseRow['cause'];?></td>
                                                                            <td><?php echo $caseRow['status'];?></td>
                                                                            <td>
                                                                                <form method="POST" action="../../core/operations/UpdateCase.php">
                                                                                    <input type="hidden" name="incident_id" value="<?php echo $caseRow['incident_id'];?>">
                                                                                    <select class="btn btn-success" name="status">
                                                                                        <option value="Approved">Approve</option>
                                                                                        <option value="Refused">Refuse</option>
                                                                                    </select>  
                                                                                    <button class="btn btn-primary" type="submit" name="submit">
                                                                                        Submit
                                                                                    </button>
                                                                                </form>
                                                                            </td>
                                                                            <td>
                                                                                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseInfo<?php echo $caseRow['incident_id'];?>" aria-expanded="false" aria-controls="collapseInfo<?php echo $caseRow['incident_id'];?>">
                                                                                        More Info
                                                                                </button>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <div class="collapse" id="collapseInfo<?php echo $caseRow['incident_id'];?>">
                                                                                <p class="text-left h3 fw-bold mb-5 mx-1 mx-md-4 mt-4">Incident ID: <?php echo $caseRow['incident_id'];?></p>
                                                                                <div class="card card-body">
                                                                                    <div class="row">
                                                                                        <div class="col-4">Image</div>
                                                                                        <div class="col-4">Image</div>
                                                                                    </div>
                                                                                    
                                                                                </div>
                                                                            </div>
                                                                        </tr>
                                                                    <?php
                                                                }
                                                            }else{
                                                                ?>
                                                                    <div class="alert alert-danger" role="alert">
                                                                        <?php echo "No Cases Found";?>
                                                                    </div>
                                                                <?php
                                                            }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    <?php
                                }
                            }
                        ?>
                </div>
                </div>
            </div>
            </div>
        </div>
    </section>
</body>

</html>
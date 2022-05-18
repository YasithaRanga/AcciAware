<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["user"]) || $_SESSION["user"] !== true){
    header("location: signin.php");
    exit;
}
?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Portal | AcciAware</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
                <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <p class="my-2 mr-2 text-right text-light">Hi, <b><?php echo htmlspecialchars($_SESSION["registrationnumber"]); ?></b></p>
                    </li>
                    <li class="nav-item">
                        <a href="report.php" type="button" class="btn btn-success mx-lg-2">Report a Case</a>
                    </li>
                    <li class="nav-item">
                    <a href="logout.php" class="btn btn-danger ml-3">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php
                        session_start();
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
</body>
</html>
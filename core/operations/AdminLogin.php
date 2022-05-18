<?php

class AdminLogin{
    function logUser(){
        
        session_start();
        
        if(isset($_SESSION["admin"]) && $_SESSION["admin"] === true){
            header("location: ../../admin/welcome.php");
            exit;
        }
        require '../database.php';

        if(isset($_POST['submit'])){
            $username = $_POST['username'];
            $password = $_POST['password'];
        }   
        
        $sql = "SELECT username, password FROM admins WHERE username = '".$username."' AND password = md5('".$password."')";
        
        $result = $conn->query($sql);
        
        $num_rows = mysqli_num_rows($result);
        
        if($num_rows == 1){

            session_start();
                            
            $_SESSION["admin"] = true;
            $_SESSION["username"] = $username;

            $_SESSION['status'] = "Logged In Successfully.";
            header('Location: ../../admin/welcome.php');

        }
        else {
            $_SESSION['fail'] = "Login Unsuccessful. Incorrect Login Details.";
            header('Location: ../../admin/index.php');
        }

        $conn->close(); 

    }
}

$newAdminLogin = new AdminLogin();
$newAdminLogin -> logUser();

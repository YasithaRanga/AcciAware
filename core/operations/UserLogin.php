<?php

class UserLogin{
    function logUser(){
        
        session_start();
        
        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
            header("location: welcome.php");
            exit;
        }
        require '../database.php';

        if(isset($_POST['submit'])){
            $vehicle_reg_number = $_POST['registrationnumber'];
            $password = $_POST['password'];
        }   
        
        $sql = "SELECT vehicle_reg_number, password FROM users WHERE vehicle_reg_number = '".$vehicle_reg_number."' AND password = md5('".$password."')";
        
        $result = $conn->query($sql);
        
        $num_rows = mysqli_num_rows($result);
        
        if($num_rows == 1){

            session_start();
                            
            $_SESSION["loggedin"] = true;
            $_SESSION["registrationnumber"] = $vehicle_reg_number;

            $_SESSION['status'] = "Logged In Successfully.";
            header('Location: ../../users/welcome.php');

        }
        else {
            $_SESSION['fail'] = "Login Unsuccessful. Incorrect Login Details.";
            header('Location: ../../users/signin.php');
        }

        $conn->close(); 

    }
}

$newUserLogin = new UserLogin();
$newUserLogin -> logUser();

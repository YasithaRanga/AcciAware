<?php

class WebMasterLogin{
    function logUser(){
        
        session_start();
        
        if(isset($_SESSION["webmaster"]) && $_SESSION["webmaster"] === true){
            header("location: ../../webmaster/welcome.php");
            exit;
        }
        require '../database.php';

        if(isset($_POST['submit'])){
            $username = $_POST['username'];
            $password = $_POST['password'];
        }   
        
        $sql = "SELECT username, password FROM webmaster WHERE username = '".$username."' AND password = md5('".$password."')";
        
        $result = $conn->query($sql);
        
        $num_rows = mysqli_num_rows($result);
        
        if($num_rows == 1){

            session_start();
                            
            $_SESSION["webmaster"] = true;
            $_SESSION["username"] = $username;
            $_SESSION['status'] = "Logged In Successfully.";
            header('Location: ../../webmaster/welcome.php');

        }
        else {
            $_SESSION['fail'] = "Login Unsuccessful. Incorrect Login Details.";
            header('Location: ../../webmaster/index.php');
        }

        $conn->close(); 

    }
}

$newWebMasterLogin = new WebMasterLogin();
$newWebMasterLogin -> logUser();

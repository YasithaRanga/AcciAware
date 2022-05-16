<?php

class DeleteUser{
    function delUser(){
        
        session_start();
        require '../database.php';

        if(isset($_POST['submit'])){
            $vehicle_reg_number = $_POST['registrationnumber'];
        }   
        
        $sql = "DELETE FROM users WHERE vehicle_reg_number = '".$vehicle_reg_number."'";
        
        if($conn->query($sql) === TRUE){

            session_start();
                            
            $_SESSION["webmaster"] = true;
            $_SESSION['status'] = "User Deleted Successfully.";
            header('Location: ../../webmaster/users/');
        }
        else {
            $_SESSION['fail'] = "User Deletion Unsuccessful.";
            header('Location: ../../webmaster/users/');
        }

        $conn->close(); 

    }
}

$newUserLogin = new DeleteUser();
$newUserLogin -> delUser();

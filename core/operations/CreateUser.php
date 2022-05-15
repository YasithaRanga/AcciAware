<?php

class CreateUser{
    function addUser($vehicle_reg_number, $name, $email, $password, $ins_company, $policy_number){

        require '../database.php';

        if(isset($_POST['submit'])){
            $vehicle_reg_number = $_POST['registrationnumber'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $ins_company = $_POST['insurancecompany'];
            $policy_number = $_POST['policynumber'];       
        }   

        $sql = "INSERT INTO users(vehicle_reg_number, name, email, password, ins_company, policy_number) 
        VALUES('$vehicle_reg_number','$name','$email', md5('$password'), '$ins_company', '$policy_number')";
        
        if ($conn->query($sql) === TRUE) {
            header('Location: ../../users/registration/success.php');
        } else {
            header('Location: ../../users/registration/error.php');
        }
        
        $conn->close();

    }
}

$newUser = new CreateUser();
$newUser -> addUser($vehicle_reg_number, $name, $email, $password, $ins_company, $policy_number);
<?php

class CreateUser{
    function addUser($vehicle_reg_number, $name, $email, $password, $ins_company, $policy_number){
        
        session_start();
        
        require '../database.php';

        if(isset($_POST['submit'])){
            $vehicle_reg_number = $_POST['registrationnumber'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $ins_company = $_POST['insurancecompany'];
            $policy_number = $_POST['policynumber'];       
        }   
        
        try {
            $sql = "INSERT INTO users(vehicle_reg_number, name, email, password, ins_company, policy_number) VALUES('$vehicle_reg_number','$name','$email', md5('$password'), '$ins_company', '$policy_number')";
            $conn->query($sql);
            $_SESSION['status'] = "Account Created Successfully";
            header('Location: ../../users/signup.php');
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() == 1062) {
                $_SESSION['fail'] = "Account Already Exists with Vehicle Registration Number";
                header('Location: ../../users/signup.php');
            } else {
                throw $e;
                $_SESSION['fail'] = "Account Creation Unsuccessful";
                header('Location: ../../users/signup.php');
            }
        }

        $conn->close(); 

    }
}

$newUser = new CreateUser();
$newUser -> addUser($vehicle_reg_number, $name, $email, $password, $ins_company, $policy_number);

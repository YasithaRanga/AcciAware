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


        // $check = "SELECT * FROM users WHERE vehicle_reg_number = '$vehicle_reg_number'";
        
        $sql = "INSERT INTO users(vehicle_reg_number, name, email, password, ins_company, policy_number) VALUES('$vehicle_reg_number','$name','$email', md5('$password'), '$ins_company', '$policy_number')";
 
        if (mysqli_query($conn, $sql)) {
            $_SESSION['status'] = "Account Created Successfully";
            header('Location: ../../users/signup.php');
        }
        // else{
        //     $_SESSION['fail'] = "Account Creation Unsuccessful";
        //     header('Location: ../../users/signup.php');
        // }
        
        // $result = mysqli_query($conn, $check);
        // $num_rows = mysqli_num_rows($result);
        // if ($num_rows == 1){
        //     $_SESSION['fail'] = "Account Already Exists with Vehicle Registration Number";
        //     header('Location: ../../users/signup.php');
        // }
        // else{
            
        // }

        mysqli_close($conn); 

    }
}

$newUser = new CreateUser();
$newUser -> addUser($vehicle_reg_number, $name, $email, $password, $ins_company, $policy_number);

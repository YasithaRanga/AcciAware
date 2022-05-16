<?php

class CreateAdmin{
    function addUser($vehicle_reg_number, $name, $email, $password, $ins_company, $policy_number){
        
        session_start();
        
        require '../database.php';

        if(isset($_POST['submit'])){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $authority = $_POST['authority'];
        }   
        
        try {
            $sql = "INSERT INTO admins(username, password, email, authority) VALUES('$username',md5('$password'),'$email', '$authority')";
            $conn->query($sql);
            $_SESSION['status'] = "Admin Account Created Successfully";
            header('Location: ../../webmaster/admins/');
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() == 1062) {
                $_SESSION['fail'] = "Account Already Exists with Username";
                header('Location: ../../webmaster/admins/');
            } else {
                throw $e;
                $_SESSION['fail'] = "Admin Account Creation Unsuccessful";
                header('Location: ../../webmaster/admins/');
            }
        }

        $conn->close(); 

    }
}

$newUser = new CreateAdmin();
$newUser -> addUser($vehicle_reg_number, $name, $email, $password, $ins_company, $policy_number);

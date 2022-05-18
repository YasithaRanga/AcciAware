<?php

class DeleteAdmin{
    function delUser(){
        
        session_start();
        require '../database.php';

        if(isset($_POST['submit'])){
            $username = $_POST['username'];
        }   
        
        $sql = "DELETE FROM admins WHERE username = '".$username."'";
        
        if($conn->query($sql) === TRUE){

            session_start();
                            
            $_SESSION['status'] = "Admin Deleted Successfully.";
            header('Location: ../../webmaster/admins/');
        }
        else {
            $_SESSION['fail'] = "Admin Deletion Unsuccessful.";
            header('Location: ../../webmaster/admins/');
        }

        $conn->close(); 

    }
}

$deleteAdmin = new DeleteAdmin();
$deleteAdmin -> delUser();

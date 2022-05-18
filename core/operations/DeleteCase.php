<?php

class DeleteCase{
    function delCase(){
        
        session_start();
        require '../database.php';

        if(isset($_POST['submit'])){
            $incident_id = $_POST['incident_id'];
        }   
        
        $sql = "DELETE FROM cases WHERE incident_id = '".$incident_id."'";
        
        if($conn->query($sql) === TRUE){

            session_start();
                            
            $_SESSION['status'] = "Case Deleted Successfully.";
            header('Location: ../../users/welcome.php');
        }
        else {
            $_SESSION['fail'] = "Case Deletion Unsuccessful.";
            header('Location: ../../users/welcome.php');
        }

        $conn->close(); 

    }
}

$deleteCase = new DeleteCase();
$deleteCase -> delCase();

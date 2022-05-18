<?php

class ReviewUserCase{
    function updateCase(){
        
        session_start();
        require '../database.php';

        if(isset($_POST['submit'])){
            $incident_id = $_POST['incident_id'];
            $status = $_POST['status'];
        }   
        
        $sql = "UPDATE cases SET status='$status' WHERE incident_id = '".$incident_id."'";
        
        if($conn->query($sql) === TRUE){

            session_start();
                            
            $_SESSION['status'] = "Case Updated Successfully.";
            header('Location: ../../admin/users/');
        }
        else {
            $_SESSION['fail'] = "Case Updation Unsuccessful.";
            header('Location: ../../admin/users/');
        }

        $conn->close(); 

    }
}

$newReviewCase = new ReviewUserCase();
$newReviewCase -> updateCase();

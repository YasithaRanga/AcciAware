<?php

class UpdateCase{
    function updateCase(){
        
        session_start();
        require '../database.php';

        if(isset($_POST['submit'])){
            $incident_id = $_POST['incident_id'];
            $vehicle_reg_number = $_POST['registrationnumber'];
            $name = $_POST['name'];
            $date = $_POST['date'];
            $type = $_POST['type'];
            $vehicle = $_POST['vehicle'];
            $cause = $_POST['cause'];
            $info = $_POST['info'];
            
            $image1 = $_FILES['image1'];
            $image2 = $_FILES['image2'];
            $image3 = $_FILES['image3'];
            $image4 = $_FILES['image4'];

            $img1_name = $_FILES['image1']['name'];
            $img1_tmp_name = $_FILES['image1']['tmp_name'];
            $img1_ext = pathinfo($img1_name, PATHINFO_EXTENSION);
            $img1_ext_lc = strtolower($img1_ext);
            $new_img1_name = uniqid("IMG-".$vehicle_reg_number."-img1-", true).'.'.$img1_ext_lc;
            $img1_upload_path = "../../users/uploads/".$new_img1_name;
            move_uploaded_file($img1_tmp_name, $img1_upload_path);
        
            $img2_name = $_FILES['image2']['name'];
            $img2_tmp_name = $_FILES['image2']['tmp_name'];
            $img2_ext = pathinfo($img2_name, PATHINFO_EXTENSION);
            $img2_ext_lc = strtolower($img2_ext);
            $new_img2_name = uniqid("IMG-".$vehicle_reg_number."-img2", true).'.'.$img2_ext_lc;
            $img2_upload_path = "../../users/uploads/".$new_img2_name;
            move_uploaded_file($img2_tmp_name, $img2_upload_path);

            $img3_name = $_FILES['image3']['name'];
            $img3_tmp_name = $_FILES['image3']['tmp_name'];
            $img3_ext = pathinfo($img3_name, PATHINFO_EXTENSION);
            $img3_ext_lc = strtolower($img3_ext);
            $new_img3_name = uniqid("IMG-".$vehicle_reg_number."-img3-", true).'.'.$img3_ext_lc;
            $img3_upload_path = "../../users/uploads/".$new_img3_name;
            move_uploaded_file($img3_tmp_name, $img3_upload_path);
        
            $img4_name = $_FILES['image4']['name'];
            $img4_tmp_name = $_FILES['image4']['tmp_name'];
            $img4_ext = pathinfo($img4_name, PATHINFO_EXTENSION);
            $img4_ext_lc = strtolower($img4_ext);
            $new_img4_name = uniqid("IMG-".$vehicle_reg_number."-img4", true).'.'.$img4_ext_lc;
            $img4_upload_path = "../../users/uploads/".$new_img4_name;
            move_uploaded_file($img4_tmp_name, $img4_upload_path);
            
        }    
        
        $sql = "UPDATE cases SET name='$name', date='$date', type='$type', vehicle='$vehicle', cause='$cause', info='$info', image1='$new_img1_name', image2='$new_img2_name', image3='$new_img3_name', image4='$new_img4_name' WHERE incident_id = '".$incident_id."'";
        
        if($conn->query($sql) === TRUE){

            session_start();
            $_SESSION['status'] = "Case Updated Successfully.";
            header('Location: ../../users/welcome.php');
        }
        else {
            $_SESSION['fail'] = "Case Updation Unsuccessful.";
            header('Location: ../../users/welcome.php');
        }

        $conn->close(); 

    }
}

$newUpdateCase = new UpdateCase();
$newUpdateCase -> updateCase();

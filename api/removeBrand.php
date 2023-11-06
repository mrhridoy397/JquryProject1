<?php 
// session_start();
require_once("./core.php");

$valid['success'] = array('success' => false, 'messages' => array());
$brandId = $_POST['id'];

if($brandId){
   

    $sql = "UPDATE brands SET  brand_status = 0 WHERE brand_id = {$brandId}";
    // chak insert
    if($con->query($sql) == true){
        $valid['success'] = true;
        $valid['messages'] = "SuccessFully Remove";
    }
    else{
        $valid['success'] = false;
        $valid['messages'] = "Oops! Error While Adding The  members";
    }
    // connection close 
    $con->close();
    // convart json formate
    echo json_encode($valid);
}


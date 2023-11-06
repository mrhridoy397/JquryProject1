<?php 
// session_start();
require_once("./core.php");

$valid['success'] = array('success' => false, 'messages' => array());
$categoryId = $_POST['id'];

if($categoryId){
   

    $sql = "UPDATE categories SET  categories_status = 0 WHERE categories_id = {$categoryId}";
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


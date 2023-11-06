<?php 
session_start();
require_once("./core.php");

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST){
    $brandname = $_REQUEST['brandname'];
    $isActive = $_REQUEST['isActive'];
    $status = $_REQUEST['status'];
    $id = $_REQUEST['brand_id'];

    $sql = "UPDATE brands SET brand_name='$brandname', brand_active ='$isActive', brand_status ='$status' WHERE brand_id = '$id'";
    // chak insert
    if($con->query($sql) == true){
        $valid['success'] = true;
        $valid['messages'] = "SuccessFully Updated";
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


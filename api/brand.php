<?php 
session_start();
require_once("./core.php");

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST){
    $brandname = $_REQUEST['brandname'];
    $isActive = $_REQUEST['isActive'];
    $status = $_REQUEST['status'];
    $sql = "INSERT INTO `brands`( `brand_name`, `brand_active`, `brand_status`) VALUES ('$brandname','$isActive','$status')";
    // chak insert
    if($con->query($sql) == true){
        $valid['success'] = true;
        $valid['messages'] = "Brand Added SuccessFully";
    }
    else{
        $valid['success'] = false;
        $valid['messages'] = "Oops! Error While Adding The  Brand";
    }
    // connection close 
    $con->close();
    // convart json formate
    echo json_encode($valid);
}
// echo json_encode($valid);

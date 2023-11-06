<?php 
session_start();
require_once("./core.php");

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST){
    $categoryname = $_REQUEST['categoryname'];
    $isActive = $_REQUEST['isActive'];
    $status = $_REQUEST['status'];
    $sql = "INSERT INTO `categories`( `categories_name`, `categories_active`, `categories_status`) VALUES ('$categoryname','$isActive','$status')";
    // chak insert
    if($con->query($sql) == true){
        $valid['success'] = true;
        $valid['messages'] = "Category Added SuccessFully";
    }
    else{
        $valid['success'] = false;
        $valid['messages'] = "Oops! Error While Adding The  Category";
    }
    // connection close 
    $con->close();
    // convart json formate
    echo json_encode($valid);
}
// echo json_encode($valid);

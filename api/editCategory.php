<?php 
session_start();
require_once("./core.php");

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST){
    $categoriesname = $_REQUEST['categoriesname'];
    $isActive = $_REQUEST['isActive'];
    $status = $_REQUEST['status'];
    $id = $_REQUEST['categories_id'];

    $sql = "UPDATE categories SET categories_name='$categoriesname', categories_active ='$isActive', categories_status ='$status' WHERE categories_id = '$id'";
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

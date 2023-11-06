<?php
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());
if($_POST) {
    $product_name = $_POST['product_name'];
    $attribute =  $_POST['attribute'];
    $brand_id = $_POST['brand_id']; 
    $categories_id = $_POST['categories_id'];
    $quantity = $_POST['quantity'];
    $squantity = $_POST['squantity'];
    $rate = $_POST['rate'];
    $mrp = $_POST['mrp'];
    $status = $_POST['status'];

    $type =  explode('.', $_FILES['productImage']['name']); 
    // echo json_encode($type);
    $type = $type[count($type)-1];
    $url = '../assets/img/stock/'.uniqid(rand()).'.'.$type;
    if(is_uploaded_file($_FILES['productImage']['tmp_name'])){
        if(move_uploaded_file($_FILES['productImage']['tmp_name'], $url)) {
            $sql = "INSERT INTO `product`(`product_name`, `attribute`, `product_image`, `brand_id`, `categories_id`, `quantity`, `squantity`, `rate`, `mrp`, `active`, `status`) 
            VALUES ('$product_name',  '$attribute', '$url', '$brand_id', '$categories_id', '$quantity','$squantity',  '$rate','$mrp', 1, '$status')";
            if($con->query($sql) === TRUE) {
                $valid['success'] = true;
                $valid['messages'] = "Successfully Added";	
            } else {
                $valid['success'] = false;
                $valid['messages'] = "Error while adding the members";
            }
        }
        else{
            return false;
        }
    }
    $con->close();

	echo json_encode($valid);
}
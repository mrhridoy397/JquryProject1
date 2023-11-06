<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$productId = $_POST['productId'];

$sql = "SELECT `product_image` FROM `product` WHERE `product_id` = $productId";
$result = $con->query($sql);
if($result->num_rows > 0){
    $row = $result->fetch_array();
    if(unlink($row[0])){

    }
}

if($productId) { 

 $sql = "UPDATE product SET active = 0, status = 0 WHERE product_id = $productId";

 if($con->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Removed";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the brand";
 }
 
 $con->close();

 echo json_encode($valid);
 
} // /if $_POST
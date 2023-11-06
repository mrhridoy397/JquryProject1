<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$orderId = $_POST['orderId'];

if($orderId) { 

 $sql = "UPDATE orders SET order_status = 0 WHERE order_id = {$orderId}";

 $orderItem = "UPDATE order_item SET order_item_status = 0 WHERE  order_id = {$orderId}";

 if($con->query($sql) === TRUE && $con->query($orderItem) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Removed";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the brand";
 }
 
 $con->close();

 echo json_encode($valid);
 
} // /if $_POST
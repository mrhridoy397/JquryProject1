<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
	$productId 			= $_POST['productId'];
	// $ProductMain 		= $_POST['editProductMainName']; 
	$productName 		= $_POST['editProductName']; 
	$attribute 		= $_POST['editattribute']; 
  	$quantity 			= $_POST['editQuantity'];
  	$mrp 				= $_POST['editmrp'];
  	$rate 				= $_POST['editRate'];
  	$brandName 			= $_POST['editBrandName'];
  	$categoryName 		= $_POST['editCategoryName'];
  	$productStatus 		= $_POST['editProductStatus'];

				
	$sql = "UPDATE product SET product_name = '$productName', `attribute` = '$attribute', brand_id = '$brandName', categories_id = '$categoryName', quantity = '$quantity',`mrp` = '$mrp', rate = '$rate', active = '$productStatus', status = 1 WHERE product_id = '$productId'";

	if($con->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Update";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while updating product info";
	}

} // /$_POST
	 
$con->close();

echo json_encode($valid);
 

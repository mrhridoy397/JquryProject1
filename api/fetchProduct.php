<?php
require_once 'core.php';
$sql = "SELECT product.product_id, product.product_name, product.product_image, product.brand_id,
product.categories_id, product.quantity,`product`.`mrp`, product.rate, product.active,
product.status, 
brands.brand_name, categories.categories_name FROM product 
INNER JOIN brands ON product.brand_id = brands.brand_id 
INNER JOIN categories ON product.categories_id = categories.categories_id
WHERE product.status = 1";

$result = $con->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $active = ""; 

 while($row = $result->fetch_array()) {
 	$productId = $row[0];
 	// active 
 	if($row[8] == 1) {
 		// activate member
 		$active = "<label class='label label-success'>Available</label>";
 	} else {
 		// deactivate member
 		$active = "<label class='label label-danger'>Not Available</label>";
 	} // /else

 	$button = '<!-- Single button -->
	<div class="btn-group">
	    <button type="button" class="btn btn-info" data-toggle="modal" id="editProductModalBtn" data-target="#editProductModal" onclick="editProduct('.$productId.')">Edit</button>
	    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#removeProductModal" id="removeProductModalBtn" onclick="removeProduct('.$productId.')"> Remove</button>     
	</div>';

	// $brandId = $row[3];
	// $brandSql = "SELECT * FROM brands WHERE brand_id = $brandId";
	// $brandData = $connect->query($sql);
	// $brand = "";
	// while($row = $brandData->fetch_assoc()) {
	// 	$brand = $row['brand_name'];
	// }

	// $brand = $row[12];
	// $category = $row[13];
	// $product = $row[11];
	//$active = $row[11];
	$imageUrl = substr($row[2], 3);
	$productImage = "<img class='img-round' src='".$imageUrl."' style='height:30px; width:50px;'  />";

 	$output['data'][] = array( 	
        $productId,	
 		// image
 		$productImage,
 		// product name
 		$row[1], 
 		// mrp
 		$row[6], 
        // rate
 		$row[7],
        // quantity 		 	
 		$row[5], 	
        //brand
 		$row[10], 	
        //categoris	 	
 		$row[11], 		 	
 		// brand
 		// active
 		$active,
 		// button
 		$button 		
 		); 	
 } // /while 

}// if num_rows

$con->close();

echo json_encode($output);
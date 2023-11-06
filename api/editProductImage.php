<?php 	

require_once("./core.php");

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {		

$id = $_POST['productId'];
$oldImage = $_POST['oldPath'];
unlink($oldImage);

$type = explode('.', $_FILES['editProductImage']['name']);
	$type = $type[count($type)-1];		
	$url = '../assets/img/stock/'.uniqid(rand()).'.'.$type;
	if(in_array($type, array('gif', 'jpg', 'jpeg', 'png', 'JPG', 'GIF', 'JPEG', 'PNG'))) {
		if(is_uploaded_file($_FILES['editProductImage']['tmp_name'])) {			
			if(move_uploaded_file($_FILES['editProductImage']['tmp_name'], $url)) {
				

				$sql = "UPDATE product SET product_image = '$url' WHERE product_id = $id";				

				if($con->query($sql) === TRUE) {									
					$valid['success'] = true;
					$valid['messages'] = "Successfully Updated";	
				} else {
					$valid['success'] = false;
					$valid['messages'] = "Error while updating product image";
				}
			}	else {
				return false;
			}	// /else	
		} // if
	} // if in_array 		
	 
	$con->close();

	echo json_encode($valid);
 
} // /if $_POST
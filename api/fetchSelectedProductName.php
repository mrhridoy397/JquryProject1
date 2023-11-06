<?php 	

require_once 'core.php';

$productmainId = $_POST['productMainId'];

$sql = "SELECT `product_id`,`attribute` FROM `product` WHERE `product_id` = $productmainId";
$result = $con->query($sql);

$data = $result->fetch_all();

$con->close();

echo json_encode($data);
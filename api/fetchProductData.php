<?php 	

require_once 'core.php';

$sql = "SELECT `product_id`, `product_name`
FROM `product` WHERE `active`= 1 AND `status` = 1";
$result = $con->query($sql);

$data = $result->fetch_all();

$con->close();

echo json_encode($data);
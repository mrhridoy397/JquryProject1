<?php

require_once("./core.php");

$id = $_REQUEST['id'];
$sql = "SELECT `product_id`,`product_name`,`attribute`,`product_image`,`brand_id`,`categories_id`,`quantity`,`mrp`,`rate`,`active`,`status` FROM `product` WHERE `product_id` = $id";
$result = $con->query($sql);
if($result->num_rows > 0){
    $row = $result->fetch_array();
}
$con->close();
echo json_encode($row);

<?php
require_once("./core.php");

$id = $_REQUEST['id'];
$sql = "SELECT brand_id, brand_name, brand_active, brand_status FROM brands WHERE brand_id = $id";
$result = $con->query($sql);
if($result->num_rows > 0){
    $row = $result->fetch_array();
}
$con->close();
echo json_encode($row);

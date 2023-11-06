<?php
require_once("./core.php");

$id = $_REQUEST['id'];
$sql = "SELECT categories_id, categories_name, categories_active, categories_status FROM categories WHERE categories_id = $id";
$result = $con->query($sql);
if($result->num_rows > 0){
    $row = $result->fetch_array();
}
$con->close();
echo json_encode($row);

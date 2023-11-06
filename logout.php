<?php 
session_start();
require_once("./api/core.php");
session_unset();
session_destroy();
header("location:http://localhost/inventory/index.php");

?>
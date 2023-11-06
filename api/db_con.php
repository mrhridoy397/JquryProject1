<?php 
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "stores";

// chak connection
$con = new mysqli($hostname,$username,$password,$dbname);
// chak erro

if($con->connect_error){
    echo "Oops! Datebase Connection Fail".$con->connect_error;
}


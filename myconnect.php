<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "testpayment";
$conn = mysqli_connect($host,$user,$password,$database);
if(!$conn){
    die("have errors");
    header("location: eror.php");
}

?>
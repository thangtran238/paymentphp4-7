<?php
$host = "localhost";
$user = "root";
$password = "123123";
$database = "data_user";
$conn = mysqli_connect($host,$user,$password,$database);
if(!$conn){
    die("have errors");
    header("location: eror.php");
}

?>
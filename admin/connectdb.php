<?php

$host="localhost"; //server
$dbname="db_port";
$username="root";
$password="12345678";

try {
 //Connect Database

 $conn=new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$username,$password);

//ตั้งค่า error mode
$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 

//echo "Connect database successfully";

} catch (PDOException $e){

 echo "Error to connect database ".$e->getMessage();
}


?>
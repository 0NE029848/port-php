<?php

$host="localhost"; //server
// $host="sql111.infinityfree.com";

$dbname="db_port";
$username="root";
$password="";

// $dbname="if0_43294109_gorecruit";
// $username="if0_43294109";
// $password="G0reCru1t";

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
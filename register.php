

<?php
session_start();

include "connectdb.php";

//เขียนคำสั่งให้ Insert ข้อมูลโดยให้ เช็ค การ POST

if ($_SERVER['REQUEST_METHOD']=='POST'){
   $username=$_POST['username'];
    $password=$_POST['password'];
    $fullname=$_POST['fullname'];

   $sql="insert into users(username,password,fullname) 
        values(:username,:password,:fullname)";
   
   $stmt=$conn->prepare($sql);//1.Prepare
   $stmt->bindParam(':username',$username); // add variable
   $stmt->bindParam(':password',$password); // add variable
      $stmt->bindParam(':fullname',$fullname); // add variable
   $stmt->execute(); //execute query
}
?>
<html>
<head>
<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <?php include "css.php" ?>

</head>
<body>
    <form action="" method="POST">
    <label>Username : </label>
    <input type="text" name="username">
    <br>
    <label>Password : </label>
    <input type="password" name="password">
    <br>
    <label>Full Name : </label>
    <input type="text" name="fullname">
    <br>
    <button style="margin-left:280px;">Submit</button>
</form>
</body>

</html>

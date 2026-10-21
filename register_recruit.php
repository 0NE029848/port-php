

<?php
session_start();

include "connectdb.php";

//เขียนคำสั่งให้ Insert ข้อมูลโดยให้ เช็ค การ POST

if ($_SERVER['REQUEST_METHOD']=='POST'){
   $username=$_POST['username'];
    $password=$_POST['password'];
    $company_name=$_POST['company_name'];


   $sql="insert into recruiter(username,password,company_name) 
        values(:username,:password,:company_name)";
   
   $stmt=$conn->prepare($sql);//1.Prepare
   $stmt->bindParam(':username',$username); // add variable
   $stmt->bindParam(':password',$password); // add variable
      $stmt->bindParam(':company_name',$company_name); // add variable

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
    <label>Company Name : </label>
    <input type="text" name="company_name">
    <br>
    <button style="margin-left:280px;">Submit</button>
</form>
</body>

</html>

<?php
session_start();

include "connectdb.php";


?>
<html>
<head>
<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <?php include "css.php" ?>
</head>
<body>
<?php

if ($_SERVER['REQUEST_METHOD']=='POST'){
   $username=$_POST['username'];
   $password=$_POST['password'];

   try {

   $sql="Select * from  users where username=:username";
   
   $stmt=$conn->prepare($sql);//1.Prepare
   $stmt->bindParam(':username',$username); // add variable
   $stmt->execute(); //execute query

   $user=$stmt->fetch(PDO::FETCH_ASSOC);

   if ($user && $password==$user['password']){
    $_SESSION['user_id']=$user['user_id'];
       $_SESSION['username']=$username;
       header("Location:user/index.php");
       exit();
  
   }else{
    echo "Incorrect username or password";
   }


   }catch(PDOException $e){
    echo "error".$ef->getMessage();
   }



}


?>


<form action="" method="POST">
  <label>Username : </label>
  <input type="text" name="username">
  <br>
    <label>Password : </label>
  <input type="password" name="password">
  <br>
  <br>
  <button type="submit" class="btn-profile" style="margin-left : 100px;" >Login</button>
    <br>
    <a href="register.php" class="link" style="margin-left : 120px;">Register<a>

  <form>
</body>
</html>
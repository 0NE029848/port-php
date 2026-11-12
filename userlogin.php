<?php
session_start();

include "connectdb.php";


?>
<html>
<head>
<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <?php include "css.php" ?>
  <style>

 body{

    align-item: center;justify-content: center;"
 }   

 .form{
    border: 5px solid ;
    border-radius: 15px;
    border-color: rgb(200, 100, 0);
    background-color: rgb(230, 160, 60);
    height: auto;
    width: 25%;
    display: flex;
    margin:0 auto;
    align-items: center;
 }

 .form-input{
  display:block;
  margin:0 auto;
  width: auto;
  text-align: center;
  justify-content: center;

 }

 .input{
  width: 100%;height: 50px;font-size: 1rem

 }

 h1{
  font-size:2.5rem;
 }
@media (max-width:1024px) {
  .form{
    width: 50%;
  }
}
 @media (max-width:768px) {
 h1 {
  font-size:1.5rem;
 }
  .form{
    width: 100%;
  }
}
 

@media (max-width:468px) {

 .form-input{
  width:300px;
  margin-right:5px;
 }
  .input{
    width: 125%;
  }
  .form{
    width: 100%;
  }
}

  </style>

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
  <form action="" method="POST" class="form">
    <div class="form-input">
  <h1>🔐Talent Login🔐</h1>
  <p><input placeholder="Enter you username" type="text" name="username" class="input"></p>
  <p><input type="password" name="password" placeholder="Enter your password" class="input"> </p>
  <button type="submit" class="btn-profile"  style="font-size:1rem;">Login</button>
  <br>
    <a href="register.php" class="link" style="color: blue;">Register<a>
</div>
  <form>
</body>
</html>
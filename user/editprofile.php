<?php
session_start();
include "checklogin.php";

// รับ session
$user_id=0;

//ประกาศตัวแปร
$profile_image="";
$email="";
$github="";
$ig="";
$category_id=0;

  $user_id=$_SESSION['user_id'];

// Check post and Update Table
if ($_SERVER['REQUEST_METHOD']=='POST'){
  
    $profile_image=$_POST['profile_image'];
    $email=$_POST['email'];
    $github=$_POST['github'];
    $ig=$_POST['ig'];
    $category_id=$_POST['category_id'];

        $sql="UPDATE users 
              SET profile_image=:profile_image,
                 email=:email,
                 github=:github,
                 ig=:ig,
                 category_id=:category_id
              Where user_id=:user_id
        ";
        $stmt=$conn->prepare($sql);//1.Prepare
        $stmt->bindParam(':user_id',$user_id); // add variable

        $stmt->bindParam(':profile_image',$profile_image); // add variable
        $stmt->bindParam(':email',$email); // add variable
        $stmt->bindParam(':github',$github); // add variable
        $stmt->bindParam(':ig',$ig); // add variable
        $stmt->bindParam(':category_id',$category_id); // add variable
        $stmt->execute(); //execute query

    
    }

//sql ดึงตาราง users

  
    //echo $user_id;
            $sql="Select * from users where user_id=:user_id";
            $stmt=$conn->prepare($sql);
            $stmt->bindParam(':user_id',$user_id);
            $stmt->execute();
            $row=$stmt->fetch(PDO::FETCH_ASSOC);
            if (!empty($row)){
                //เก็บค่า เป็น userdata
                $profile_image=$row['profile_image'];
                $email=$row['email'];
                $github=$row['github'];
                $ig=$row['ig'];
                $category_id=$row['category_id'];
            }





    $sql="Select * from   profile_category ";
    
    $stmt=$conn->prepare($sql);//1.Prepare
    $stmt->execute(); //execute query
    
    $categorys=$stmt->fetchAll(PDO::FETCH_ASSOC);






?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <?php include "css.php" ?>
  </head>
  <body>

    <?php include "menu.php" ?>
    <div style="margin-left:100px;">
    <h2>Edit Profile</h2>
    <form method="post" enctype="multipart/form-data">
    <label>Profile Image : </label>    
    <input type="text" name="profile_image" value="<?php echo($profile_image);?>">
    <br>
    <label>Profile Category : </label>    
    <select name="category_id">
        <option value="0">--Please Select--</option>

        <?php foreach ($categorys as $cate): ?>
            <option value="<?php echo($cate['id']);?>"  <?php  
                if ($category_id==$cate['id']) {
                 echo "selected";
                 } ?>    
            ><?php echo($cate['category_name_th']);?></option>

        <?php endforeach;?>
</select>

    <label>Email : </label>    

    <input type="text" name="email" value="<?php echo($email);?>">
    <br>
        <label>Github : </label>   
    <input type="text" name="github" value="<?php echo($github);?>">
    <br>
        <label>Instargram : </label>    

    <input type="text" name="ig" value="<?php echo($ig);?>">
    <br>
    <button style="margin-left:280px;">Submit</button>
</div>

</form>
    <?php include "menufooter.php" ?>

</body>
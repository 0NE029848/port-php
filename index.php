<?php
session_start();
include "connectdb.php";

$recruiter_id=0;
$category_id=0;
$skill_name='';

if(isset($_SESSION['recruiter_id'])){
 $recruiter_id=$_SESSION['recruiter_id'];

}


if (!empty($_GET['select_catagory'])){
  $category_id=$_GET['select_catagory'];
}
if (!empty($_GET['select_skill'])){
  $skill_name=$_GET['select_skill'];
}
// echo $category_id;

//select * from users
 $sql="Select users.*,profile_category.category_name_th,profile_category.category_name_eng 
 from users left join profile_category on users.category_id=profile_category.id 
     left join skills on users.user_id=skills.user_id where users.user_id>0

 ";

 if ($category_id > 0) {

 $sql.=" AND users.category_id=".$category_id;
 }

 if (strlen($skill_name)>1){
  $sql.=" AND skills.skill_name like '%$skill_name%'";
 }
// echo $sql;

  $sql .=" order by users.user_id desc limit 0,25;";


  //echo  $sql;


    $stmt=$conn->prepare($sql);//1.Prepare
    $stmt->execute(); //execute query

    $users=$stmt->fetchAll(PDO::FETCH_ASSOC);
    

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
    <title>Smart Portfolio</title>
  <?php include "css.php" ?>
  </head>
  <body>

    <?php include "menu.php" ?>
    <form>
    <div style="text-align:center;">
       <label> Category : </label>
       <select name="select_catagory">
        <option value="0">All</option>

        <?php foreach ($categorys as $cate): ?>
            <option value="<?php echo($cate['id']);?>"
              <?php if ($category_id==$cate['id']) {
                 echo "selected";
                 } ?>>
            <?php echo($cate['category_name_th']);?></option>

        <?php endforeach;?>
</select>
          <label> Skill : </label>
          <input type="text" name="select_skill" value="<?php echo $skill_name;?>" >
<button> Submit </button>
    </div>
</form>
   
    <?php if (!empty($users)) { ?>
        <?php foreach ($users as $index => $user): ?>
    
        <section id="home" style="border-radius: 0 ;border-top: 0; margin-bottom: 0; margin-top: 0;">
          
          <div class="bg">
              <video autoplay loop muted playsinline class="bgvideo">
                  <source src="https://cdn.imgchest.com/files/25d63f61c5bc.mp4" type="video/mp4">
              </video>
              <div class="overlay"></div>
          </div>
          

          <div class="pro-inner">
            <img src="<?php echo $user['profile_image']?>" alt="Profile" class="pro-img">
            <div class="pro-tag"><?php echo $user['category_name_th'];?> ( <?php echo $user['category_name_eng'];?> )</div>
            <h1 class="pro-name"><?php echo $user['username']?> </h1>

            <?php if ($recruiter_id>0){ ?>
            <a href="#" >View</a>

            <?php } ?>

          </div>
          
        </section>
        <?php endforeach;?>
    <?php } else {
      echo "ไม่พบข้อมูล";

    }
      ?>
            
   

    <a href="index.php" class="btn-profile">Back to Home</a>
    
    <?php include "menufooter.php" ?>
  </body>
</html>
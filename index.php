<?php
include "connectdb.php";

//select * from users
 $sql="Select * from users order by user_id desc limit 0,25 ";
    
    $stmt=$conn->prepare($sql);//1.Prepare
    $stmt->execute(); //execute query

    $users=$stmt->fetchAll(PDO::FETCH_ASSOC);
    
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?php echo $name?></title>
  <?php include "css.php" ?>
  </head>
  <body>

    <?php include "menu.php" ?>

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
        <div class="pro-tag">SPSM | CE 68 </div>
        <h1 class="pro-name"><?php echo $user['username']?></h1>

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
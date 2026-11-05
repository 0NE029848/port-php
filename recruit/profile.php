<?php
session_start();
include "checklogin.php";
$profile_image="";
$email="";
$github="";
$ig="";
$category_id=0;
$category_name_th="";
$category_name_eng="";
$user_id=$_GET['id'];
$recruiter_id=$_SESSION['recruiter_id'];

$fullname="";

$start_year =0;
$end_year = 0;
$position="";
$detail ="";
$company_name = "";

$skill_name="";

$recruit_id =0;
$appoint_date = 0;
$appoint_time="";
$appoint_location = "";
//get usesr
$sql="Select * from users where user_id=:user_id ";
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
                $fullname=$row['fullname'];
            }
//get category
$sql="Select * from   profile_category where id=:category_id";
    
    $stmt=$conn->prepare($sql);//1.Prepare
    $stmt->bindParam(':category_id',$category_id);
    $stmt->execute(); //execute query
    
    $categorys=$stmt->fetch(PDO::FETCH_ASSOC);
    if (!empty($categorys)){
                //เก็บค่า เป็น userdata
                $category_name_th=$categorys['category_name_th'];
                $category_name_eng=$categorys['category_name_eng'];
            }
//get experiences
$sql="Select * from experiences where user_id=:user_id";
   $stmt=$conn->prepare($sql);//1.Prepare
   $stmt->bindParam(':user_id',$user_id);
    $stmt->execute();
    $experiences=$stmt->fetchAll(PDO::FETCH_ASSOC);

//get skills
$sql="Select * from skills where user_id=:user_id";
   $stmt=$conn->prepare($sql);//1.Prepare
   $stmt->bindParam(':user_id',$user_id);
    $stmt->execute();
    $skills=$stmt->fetchAll(PDO::FETCH_ASSOC);
                

    $sql="Select * from appointment where recruit_id=:recruit_id and user_id=:user_id";
                $stmt=$conn->prepare($sql);
                $stmt->bindParam(':recruit_id',$recruiter_id);
                $stmt->bindParam(':user_id',$user_id);
                $stmt->execute();
                $appointment=$stmt->fetchAll(PDO::FETCH_ASSOC);
              
                        
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?php echo ($fullname)?></title>
  <?php include "css.php" ?>
  </head>
  <body>

    <?php include "menu.php" ?>


    <section id="home" style="border-radius: 0 ;border-top: 0; margin-bottom: 0; margin-top: 0;">
      
      <div class="bg">
          <video autoplay loop muted playsinline class="bgvideo">
              <source src="https://cdn.imgchest.com/files/25d63f61c5bc.mp4" type="video/mp4">
          </video>
          <div class="overlay"></div>
      </div>

      <div class="pro-inner">
        <img src="<?php echo ($profile_image); ?>" alt="Profile" class="pro-img">
        <div class="pro-tag"><?php echo($category_name_th); echo($category_name_eng);   ?>  </div>
        <h1 class="pro-name"><?php  echo($fullname) ?></h1>

      </div>
      
    </section>

    <section id="experience">
      <div class="container">
        <div class="section-header">
          <p class="section-label">Showcase</p>
          <h2 class="section-title">Experience </h2>
        </div>
        <?php if (!empty($experiences)) { ?>

      <?php foreach ($experiences as $index => $experience): ?>

        <div class="exp-list">
          
          <div class="exp-item">
            <div>
              
                
                       <?php echo htmlspecialchars($experience['start_year']);?> 
                       -
                        <?php echo htmlspecialchars($experience['end_year']);?>
                      
                        <?php echo htmlspecialchars($experience['position']);?>
                        <br>
                        <?php echo htmlspecialchars($experience['company_name']);?>
                        <br>
                        <?php echo htmlspecialchars($experience['detail']);?>


                      </p>
                    </div>
                  </div>
                  
                  
                  
                  
                  
                  
                  
                  <?php endforeach;?>
  
                 <?php }?>
        </div>
        <!--End Experience List-->
      </div>
    </section>

    <section id="skills">
      <div class="container">
        <div class="section-header">
          <p class="section-label">Expertise</p>
          <h2 class="section-title">Skills</h2>
        </div>
        <?php if (!empty($skills)) { ?>

      <?php foreach ($skills as $index => $skill): ?>

        <div class="skills-grid">
          <div class="skill-card" style="border-radius: 10px;">
            <p class="skill-title"><?php echo htmlspecialchars($skill['skill_name']);?> </p>
            <div class="tag-list">


            </span>
              

                
            </div>
          </div>
          
          

          
          <?php endforeach;?>
   
                  <?php }?>
        </div>
      </div>
    </section>

    <section id="contact">
      <div class="container">
        <div class="section-header">
          <p class="section-label">Get in touch</p>
          <h2 class="section-title">Contact</h2>
        </div>

        <div class="contact-list">
          <div class="contact-row" style="border-radius: 10px;">
            <span class="contact-type">Email</span>
            <span class="contact-value"><?php echo($email);?></span>
          </div>
          <div class="contact-row" style="border-radius: 10px;">
            <span class="contact-type">Git Hub</span>
            <span class="contact-value"><?php echo($github)?></span>
          </div>
          <div class="contact-row" style="border-radius: 10px;">
            <span class="contact-type">Instagram</span>
            <span class="contact-value"><?php echo($ig)?></span>
          </div>
          
        </div>
      </div>
    </section>
<section id="appointment">
      <div class="container">
        <div class="section-header">
          <p class="section-label">Appointment</p>
          <h2 class="section-title">Making Request</a></h2>
        </div>
        <a href="requesting.php?id=<?php echo $user_id;?>" >Confirm</a>
        <br>
        <h2>Scheduled Items</h2>
          
          <?php if (!empty($appointment)) { ?>
          <div class="contact-list">
          <?php foreach ($appointment as $index => $app): ?>
            <div class="contact-row" style="border-radius: 10px;width:auto;">
            
                    
                        <span class="contact-value">Date : <?php echo htmlspecialchars($app['appoint_date']);?> | Time : <?php echo htmlspecialchars($app['appoint_time']);?> | Location : <?php echo htmlspecialchars($app['appoint_location']);?></span>                
                  

                  </div>

                <?php endforeach;?>
          </div>
               <?php } ?>
              
            
       
    </section>
    <a href="index.php" class="btn-profile">Back to Home</a>
    
     <?php include "menufooter.php"?>

  </body>
</html>
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
$user_id=$_SESSION['user_id'];
$fullname="";

$start_year =0;
$end_year = 0;
$position="";
$detail ="";
$company_name = "";


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

$sql="Select * from experiences where user_id=:user_id";
   $stmt=$conn->prepare($sql);//1.Prepare
   $stmt->bindParam(':user_id',$user_id);
    $stmt->execute();
    $experiences=$stmt->fetchAll(PDO::FETCH_ASSOC);
                
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
        <div class="pro-tag"><?php echo($category_name_th); echo($category_name_eng);   ?><a href="editprofile.php">(Edit)</a>  </div>
        <h1 class="pro-name"><?php  echo($fullname) ?></h1>

      </div>
      
    </section>

    <section id="experience">
      <div class="container">
        <div class="section-header">
          <p class="section-label">Showcase</p>
          <h2 class="section-title">Experience <a href="experience.php">(Add)</a></h2>
        </div>
        <?php if (!empty($experiences)) { ?>

      <?php foreach ($experiences as $index => $experience): ?>

        <div class="exp-list">
          
          <div class="exp-item">
            <div>
              
                
                       <?php echo htmlspecialchars($experience['start_year']);?> 
                       -
                        <?php echo htmlspecialchars($experience['end_year']);?>
                        <br>
                        <?php echo htmlspecialchars($experience['position']);?>
                        <br>
                        <?php echo htmlspecialchars($experience['detail']);?>
                        <br>
                       <?php echo htmlspecialchars($experience['company_name']);?>


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

        <div class="skills-grid">
          <div class="skill-card" style="border-radius: 10px;">
            <p class="skill-title">Coding <a href=""> (Add) </a></p>
            <div class="tag-list">

            <span class="tag"><a href=""> (Edit) </a>
            <a href=""> (Delete) </a>
            </span>
              

                
            </div>
          </div>

          <div class="skill-card" style="border-radius: 10px;">
            <p class="skill-title">Embedded System <a href=""> (Add) </a></p>
            <div class="tag-list">
                 
              <span class="tag"><a href=""> (Edit) </a>
            <a href=""> (Delete) </a>
            </span>

              
            </div>
          </div>

          <div class="skill-card" style="border-radius: 10px;">
            <p class="skill-title">-Title-</p>
            <div class="tag-list">
              <span class="tag">-Tag-</span>
              <span class="tag">-Tag-</span>
            </div>
          </div>

          
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

    <a href="index.php" class="btn-profile">Back to Home</a>
    
     <?php include "menufooter.php"?>

  </body>
</html>
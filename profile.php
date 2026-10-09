<?php
include "data.php";

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

    <section id="home" style="border-radius: 0 ;border-top: 0; margin-bottom: 0; margin-top: 0;">
      
      <div class="bg">
          <video autoplay loop muted playsinline class="bgvideo">
              <source src="https://cdn.imgchest.com/files/25d63f61c5bc.mp4" type="video/mp4">
          </video>
          <div class="overlay"></div>
      </div>

      <div class="pro-inner">
        <img src="{{image}}" alt="Profile" class="pro-img">
        <div class="pro-tag">SPSM | CE 68 <a href="../../../profile/edit/{{link_id}}">(Edit)</a>  </div>
        <h1 class="pro-name"><?php echo $name?></h1>

      </div>
      
    </section>

    

    <a href="index.php" class="btn-profile">Back to Home</a>
    
    <script>
      const menuBtn = document.querySelector('.menu-btn');
      const nav = document.querySelector('nav');
      const lineOne = document.querySelector('.line--1');
      const lineTwo = document.querySelector('.line--2');
      const lineThree = document.querySelector('.line--3');
      const linkContainer = document.querySelector('.nav-links');
      const links = document.querySelectorAll('.link');

      menuBtn.addEventListener('click', () => {
          nav.classList.toggle('nav-open');
          lineOne.classList.toggle('line-cross');
          lineTwo.classList.toggle('line-fade-out');
          lineThree.classList.toggle('line-cross');
          linkContainer.classList.toggle('fade-in');
      });

      // Close menu when a link is clicked
      links.forEach(link => {
          link.addEventListener('click', () => {
              nav.classList.remove('nav-open');
              lineOne.classList.remove('line-cross');
              lineTwo.classList.remove('line-fade-out');
              lineThree.classList.remove('line-cross');
              linkContainer.classList.remove('fade-in');
          });
      });
    </script>

  </body>
</html>
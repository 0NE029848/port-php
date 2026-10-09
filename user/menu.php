<nav>
      <div class="menu-btn">
        <div class="line line--1"></div>
        <div class="line line--2"></div>
        <div class="line line--3"></div>
      </div>

      <ul class="nav-links">
       <li><a href="index.php" class="link"><?php echo($_SESSION['username']);?></a></li> 
      <li><a href="index.php" class="link">Home</a></li>
        <li><a href="profilecategory.php" class="link">Category</a></li>
                <li><a href="users.php" class="link">Users</a></li>
          <li><a href="../userlogin.php" class="link">Sign Out</a></li>


      </ul>
    </nav>
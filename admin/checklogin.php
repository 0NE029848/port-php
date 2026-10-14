<?php

include "../connectdb.php";
if (!isset($_SESSION['admin_username'])){

    header("Location:../adminlogin.php");
    exit();

}
?>
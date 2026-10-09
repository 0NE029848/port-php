<?php

include "../connectdb.php";
if (!isset($_SESSION['username'])){

    header("Location:../adminlogin.php");
    exit();

}
?>
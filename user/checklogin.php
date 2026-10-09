<?php

include "../connectdb.php";
if (!isset($_SESSION['user_id'])){

    header("Location:../userlogin.php");
    exit();

}
?>
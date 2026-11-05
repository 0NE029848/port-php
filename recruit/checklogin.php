<?php

include "../connectdb.php";
if (!isset($_SESSION['recruiter_id'])){

    header("Location:../login_recruit.php");
    exit();

}
?>
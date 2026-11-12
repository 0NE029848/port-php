

<?php
session_start();
include "checklogin.php";

$id=0;
$user_id=$_GET['id'];
$recruit_id =0;
$appoint_date = 0;
$appoint_time="";
$appoint_location = "";
// $action="add";
//เขียนคำสั่งให้ Insert ข้อมูลโดยให้ เช็ค การ POST
$recruiter_id=$_SESSION['recruiter_id'];

  if ($_SERVER['REQUEST_METHOD']=='POST'){
      
        $user_id=$_POST['user_id'];
      $recruit_id=$_SESSION['recruiter_id'];
      $appoint_date=$_POST['appoint_date'];
      $appoint_time=$_POST['appoint_time'];
      $appoint_location=$_POST['appoint_location'];
      
      if ($id==0){
          $sql="insert into appointment(recruit_id,appoint_date,appoint_time,appoint_location,user_id,status) 
        values(:recruit_id,:appoint_date,:appoint_time,:appoint_location,:user_id,'Pending')";
   
   $stmt=$conn->prepare($sql);//1.Prepare
    $stmt->bindParam(':recruit_id',$recruit_id); // add variable
        $stmt->bindParam(':appoint_date',$appoint_date); // add variable
        $stmt->bindParam(':appoint_time',$appoint_time); // add variable
        $stmt->bindParam(':appoint_location',$appoint_location); // add variable
        $stmt->bindParam(':user_id',$user_id); // add variable

   $stmt->execute(); //execute query
          
        
        
//         }else{
// $sql="UPDATE experiences 
//               SET start_year=:start_year,
//                  end_year=:end_year,
//                  position=:position,
//                  detail=:detail,
//                  company_name=:company_name
//               Where id=:id
//         ";
//         $stmt=$conn->prepare($sql);//1.Prepare
//         $stmt->bindParam(':id',$id); // add variable
        
//         $stmt->bindParam(':start_year',$start_year); // add variable
//         $stmt->bindParam(':end_year',$end_year); // add variable
//         $stmt->bindParam(':position',$position); // add variable
//         $stmt->bindParam(':detail',$detail); // add variable
//         $stmt->bindParam(':company_name',$company_name); // add variable
        
//         $stmt->execute(); //execute query


        }
        }
        // try {
        //     //get data
        //     if(isset($_GET['action'])){
        //         $action="edit";
        //         $id=$_GET['id'];
        //         //echo $id;
        //         $sql="Select * from experiences where id=:id";
        //         $stmt=$conn->prepare($sql);
        //         $stmt->bindParam(':id',$id);
        //         $stmt->execute();
        //         $row=$stmt->fetch(PDO::FETCH_ASSOC);
                
        //         if (!empty($row)){
        //             $start_year=$row['start_year'];
        //             $end_year=$row['end_year'];
        //             $position=$row['position'];
        //             $detail=$row['detail'];
        //             $company_name=$row['company_name'];
        //             }
                    
                    
                    
        //             }
                    
                    
                    
        //             $sql="Select * from experiences ";
                    
        //             $stmt=$conn->prepare($sql);//1.Prepare
        //             $stmt->execute(); //execute query
                    
        //             $experiences=$stmt->fetchAll(PDO::FETCH_ASSOC);                    
                    
                    
        //             }catch(PDOException $e){
        //                 echo "error".$e->getMessage();
        //                 }
                        
                        
                        
                        
                        ?>

<html>
    <head>
        <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <?php include "css.php" ?>

</head>
<body>
    <?php include "menu.php" ?>
<!-- สร้างฟอร์ม สำหรับ เพิ่มข้อมุลประเภท ของโปรไฟล์-->
    <div style="margin-left:100px;">
<form action="" method="POST">
    <input type="hidden" name="user_id" value="<?php echo($user_id);?>"/>
    <label>Appoint Date : </label>
    <input type="date" name="appoint_date">
    <br>
    <label>Appoint Time : </label>
    <input type="text" name="appoint_time">
    <br>
    <label>Appoint Location : </label>
    <input type="text" name="appoint_location">

    <br>
    <button style="margin-left:280px;">Submit</button>
</form>

 

                </div>
    <?php include "menufooter.php"?>


    
</body>

</html>

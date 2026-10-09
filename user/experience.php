

<?php
session_start();
include "checklogin.php";

$id=0;
$user_id=0;
$start_year =0;
$end_year = 0;
$position="";
$detail ="";
$company_name = "";
$action="add";
//เขียนคำสั่งให้ Insert ข้อมูลโดยให้ เช็ค การ POST
  $user_id=$_SESSION['user_id'];
  
  if ($_SERVER['REQUEST_METHOD']=='POST'){
      
        $id=$_POST['id'];
      $start_year=$_POST['start_year'];
      $end_year=$_POST['end_year'];
      $position=$_POST['position'];
      $detail=$_POST['detail'];
      $company_name=$_POST['company_name'];
      
      if ($id==0){
          $sql="insert into experiences(start_year,end_year,position,detail,company_name,user_id) 
        values(:start_year,:end_year,:position,:detail,:company_name,:user_id)";
   
   $stmt=$conn->prepare($sql);//1.Prepare
    $stmt->bindParam(':start_year',$start_year); // add variable
        $stmt->bindParam(':end_year',$end_year); // add variable
        $stmt->bindParam(':position',$position); // add variable
        $stmt->bindParam(':detail',$detail); // add variable
        $stmt->bindParam(':company_name',$company_name); // add variable
        $stmt->bindParam(':user_id',$user_id); // add variable

   $stmt->execute(); //execute query
          
        
        
        }else{
$sql="UPDATE experiences 
              SET start_year=:start_year,
                 end_year=:end_year,
                 position=:position,
                 detail=:detail,
                 company_name=:company_name
              Where id=:id
        ";
        $stmt=$conn->prepare($sql);//1.Prepare
        $stmt->bindParam(':id',$id); // add variable
        
        $stmt->bindParam(':start_year',$start_year); // add variable
        $stmt->bindParam(':end_year',$end_year); // add variable
        $stmt->bindParam(':position',$position); // add variable
        $stmt->bindParam(':detail',$detail); // add variable
        $stmt->bindParam(':company_name',$company_name); // add variable
        
        $stmt->execute(); //execute query


        }
        }
        try {
            //get data
            if(isset($_GET['action'])){
                $action="edit";
                $id=$_GET['id'];
                //echo $id;
                $sql="Select * from experiences where id=:id";
                $stmt=$conn->prepare($sql);
                $stmt->bindParam(':id',$id);
                $stmt->execute();
                $row=$stmt->fetch(PDO::FETCH_ASSOC);
                
                if (!empty($row)){
                    $start_year=$row['start_year'];
                    $end_year=$row['end_year'];
                    $position=$row['position'];
                    $detail=$row['detail'];
                    $company_name=$row['company_name'];
                    }
                    
                    
                    
                    }
                    
                    
                    
                    $sql="Select * from experiences ";
                    
                    $stmt=$conn->prepare($sql);//1.Prepare
                    $stmt->execute(); //execute query
                    
                    $experiences=$stmt->fetchAll(PDO::FETCH_ASSOC);                    
                    
                    
                    }catch(PDOException $e){
                        echo "error".$e->getMessage();
                        }
                        
                        
                        
                        
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
    <input type="hidden" name="id" value="<?php echo($id);?>"/>
    <label>Start Year : </label>
    <input type="number" name="start_year" value="<?php echo($start_year);?>">
    <br>
    <label>End Year : </label>
    <input type="number" name="end_year" value="<?php echo($end_year);?>">
    <br>
    <label>Position : </label>
    <input type="text" name="position" value="<?php echo($position);?>">
    <br>
    <label>Detail : </label>
    <input type="text" name="detail" value="<?php echo($detail);?>">
    <br>
    <label>Company : </label>
    <input type="text" name="company_name" value="<?php echo($company_name);?>">
    <br>
    <button style="margin-left:280px;">Submit</button>
</form>

 <table style="border: 1px solid gray;">
            <tr>
               <th>ID</th>     
                <th>Start Year</th>
                <th>End Year</th>
                <th>Position</th>
                <th>Detail</th>
                <th>Company</th>
                <th>Action</th>
             
            </tr>

            <?php if (!empty($experiences)) { ?>

                <?php foreach ($experiences as $index => $experience): ?>
                       
                    <tr>
                        <td><?php echo htmlspecialchars($experience['id']);?> </td>
                        <td><?php echo htmlspecialchars($experience['start_year']);?> </td>
                        <td><?php echo htmlspecialchars($experience['end_year']);?> </td>
                        <td><?php echo htmlspecialchars($experience['position']);?> </td>
                        <td><?php echo htmlspecialchars($experience['detail']);?> </td>
                        <td><?php echo htmlspecialchars($experience['company_name']);?> </td>

                        <td>
                            <a href="experience.php?action=edit&id=<?php echo htmlspecialchars($experience['id']);?>">Edit</a>
                        
                        </td>
                    
                    </tr>


                <?php endforeach;?>

               <?php } else {?>
               <?php echo "ไม่พบข้อมูล";?>
               
              <?php }?>
            
        </table>

                </div>
    <?php include "menufooter.php"?>


    
</body>

</html>

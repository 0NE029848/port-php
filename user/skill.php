

<?php
session_start();
include "checklogin.php";

$id=0;
$user_id=0;
$skill_name="";
$action="add";
//เขียนคำสั่งให้ Insert ข้อมูลโดยให้ เช็ค การ POST
  $user_id=$_SESSION['user_id'];
  
  if ($_SERVER['REQUEST_METHOD']=='POST'){
      
        $id=$_POST['id'];
      $skill_name=$_POST['skill_name'];

      
      if ($id==0){
          $sql="insert into skills(skill_name,user_id) 
        values(:skill_name,:user_id)";
   
   $stmt=$conn->prepare($sql);//1.Prepare
    $stmt->bindParam(':skill_name',$skill_name); // add variable

        $stmt->bindParam(':user_id',$user_id); // add variable

   $stmt->execute(); //execute query
          
        
        
        }else{
$sql="UPDATE skills 
              SET skill_name=:skill_name
              Where id=:id
        ";
        $stmt=$conn->prepare($sql);//1.Prepare
        $stmt->bindParam(':id',$id); // add variable
        $stmt->bindParam(':skill_name',$skill_name); // add variable
        
        $stmt->execute(); //execute query


        }
        }
        try {
            //get data
            if(isset($_GET['action'])){
                $action="edit";
                $id=$_GET['id'];
                //echo $id;
                $sql="Select * from skills where id=:id";
                $stmt=$conn->prepare($sql);
                $stmt->bindParam(':id',$id);
                $stmt->execute();
                $row=$stmt->fetch(PDO::FETCH_ASSOC);
                
                if (!empty($row)){
                    $skill_name=$row['skill_name'];

                    }
                    
                    
                    
                    }
                    
                    
                    
                    $sql="Select * from skills ";
                    
                    $stmt=$conn->prepare($sql);//1.Prepare
                    $stmt->execute(); //execute query
                    
                    $skills=$stmt->fetchAll(PDO::FETCH_ASSOC);                    
                    
                    
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
    <label>Skill Name : </label>
    <input type="text" name="skill_name" value="<?php echo($skill_name);?>">

    <br>
    <button style="margin-left:280px;">Submit</button>
</form>

 <table style="border: 1px solid gray;">
            <tr>
               <th>ID</th>     
                <th>Skill Name</th>
                
             
            </tr>

            <?php if (!empty($skills)) { ?>

                <?php foreach ($skills as $index => $skill): ?>
                       
                    <tr>
                        <td><?php echo htmlspecialchars($skill['id']);?> </td>
                    
                        <td><?php echo htmlspecialchars($skill['skill_name']);?> </td>

                        <td>
                            <a href="skill.php?action=edit&id=<?php echo htmlspecialchars($skill['id']);?>">Edit</a>
                        
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

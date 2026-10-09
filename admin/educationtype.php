

<?php
session_start();
include "checklogin.php";

$type_id=0;
$type_name="";

$action="add";
//เขียนคำสั่งให้ Insert ข้อมูลโดยให้ เช็ค การ POST

if ($_SERVER['REQUEST_METHOD']=='POST'){

   $type_id=$_POST['type_id'];
   $type_name=$_POST['type_name'];

//add
    if ($type_id==0){

   $sql="insert into education_type(type_name) 
        values(:type_name)";
   
   $stmt=$conn->prepare($sql);//1.Prepare
   $stmt->bindParam(':type_name',$type_name); // add variable
   $stmt->execute(); //execute query

    }else{
        $sql="UPDATE education_type 
              SET type_name=:type_name
                
              Where type_id=:type_id
        ";
   
   
    $stmt=$conn->prepare($sql);//1.Prepare
     $stmt->bindParam(':type_id',$type_id);
     $stmt->bindParam(':type_name',$type_name); // add variable
    $stmt->execute(); //execute query


    }
}

try {
//get data
        if(isset($_GET['action'])){
            $action="edit";
            $type_id=$_GET['type_id'];

            $sql="Select * from education_type where type_id=:type_id";
            $stmt=$conn->prepare($sql);
            $stmt->bindParam(':type_id',$type_id);
            $stmt->execute();
            $row=$stmt->fetch(PDO::FETCH_ASSOC);

            if (!empty($row)){
                $type_name=$row['type_name'];
            }



        }



    $sql="Select * from   education_type ";
    
    $stmt=$conn->prepare($sql);//1.Prepare
    $stmt->execute(); //execute query
    
    $educations=$stmt->fetchAll(PDO::FETCH_ASSOC);


    
    
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
<div class="content" >
<form action="" method="POST">
    <input type="hidden" name="type_id" value="<?php echo($type_id);?>"/>
    <label>Education : </label>
    <input type="text" name="type_name" value="<?php echo($type_name);?>">
    
    <button >Submit</button>
</form>

<!-- สร้างตาราง 3 column แสดง ออกมา -->
 <table style="border: 1px solid gray;">
            <tr>
               <th>ID</th>     
                <th>Education</th>
                <th>Action</th>
              
            </tr>

            <?php if (!empty($educations)) { ?>

                <?php foreach ($educations as $index => $education): ?>
                       
                    <tr>
                        <td><?php echo htmlspecialchars($education['type_id']);?> </td>
                        <td><?php echo htmlspecialchars($education['type_name']);?> </td>
                        <td><a href="educationtype.php?action=edit&type_id=<?php echo htmlspecialchars($education['type_id']);?>">Edit</a></td>
                    </tr>


                <?php endforeach;?>

               <?php } else {
               echo "ไม่พบข้อมูล";
               
               }
                ?>
        </table>

                </div>
    <?php include "menufooter.php"?>


    
</body>

</html>



<?php
session_start();
include "checklogin.php";

$id=0;
$category_name_th="";
$category_name_eng="";
$action="add";
//เขียนคำสั่งให้ Insert ข้อมูลโดยให้ เช็ค การ POST

if ($_SERVER['REQUEST_METHOD']=='POST'){

   $id=$_POST['id'];
   $category_name_th=$_POST['category_name_th'];
    $category_name_eng=$_POST['category_name_eng'];
//add
    if ($id==0){

   $sql="insert into profile_category(category_name_th,category_name_eng) 
        values(:category_name_th,:category_name_eng)";
   
   $stmt=$conn->prepare($sql);//1.Prepare
   $stmt->bindParam(':category_name_th',$category_name_th); // add variable
   $stmt->bindParam(':category_name_eng',$category_name_eng); // add variable
   $stmt->execute(); //execute query

    }else{
        $sql="UPDATE profile_category 
              SET category_name_th=:category_name_th,
                 category_name_eng=:category_name_eng
              Where id=:id
        ";
   
   
    $stmt=$conn->prepare($sql);//1.Prepare
     $stmt->bindParam(':id',$id);
     $stmt->bindParam(':category_name_th',$category_name_th); // add variable
    $stmt->bindParam(':category_name_eng',$category_name_eng); // add variable
    $stmt->execute(); //execute query


    }
}

try {
//get data
        if(isset($_GET['action'])){
            $action="edit";
            $id=$_GET['id'];
            //echo $id;
            $sql="Select * from profile_category where id=:id";
            $stmt=$conn->prepare($sql);
            $stmt->bindParam(':id',$id);
            $stmt->execute();
            $row=$stmt->fetch(PDO::FETCH_ASSOC);

            if (!empty($row)){
                $category_name_th=$row['category_name_th'];
                $category_name_eng=$row['category_name_eng'];
            }



        }



    $sql="Select * from   profile_category ";
    
    $stmt=$conn->prepare($sql);//1.Prepare
    $stmt->execute(); //execute query
    
    $categorys=$stmt->fetchAll(PDO::FETCH_ASSOC);


    
    
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
<div class="content">
<form action="" method="POST">
    <input type="hidden" name="id" value="<?php echo($id);?>"/>
    <label>Category Name TH : </label>
    <input type="text" name="category_name_th" value="<?php echo($category_name_th);?>">
    <br>
    <label>Category Name EN : </label>
    <input type="text" name="category_name_eng" value="<?php echo($category_name_eng);?>">
    <br>
    <button style="margin-left:280px;">Submit</button>
</form>

<!-- สร้างตาราง 3 column แสดง ออกมา -->
 <table style="border: 1px solid gray;">
            <tr>
               <th>Category ID</th>     
                <th>Category Name TH</th>
                <th>Category Name EN</th>
                <th>Action</th>
              
            </tr>

            <?php if (!empty($categorys)) { ?>

                <?php foreach ($categorys as $index => $category): ?>
                       
                    <tr>
                        <td><?php echo htmlspecialchars($category['id']);?> </td>
                        <td><?php echo htmlspecialchars($category['category_name_th']);?> </td>
                        <td><?php echo htmlspecialchars($category['category_name_eng']);?> </td>
                        <td>
                            <a href="profilecategory.php?action=edit&id=<?php echo htmlspecialchars($category['id']);?>">Edit</a>
                        <a href="skills.php">Skills</a>
                        </td>
                    
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

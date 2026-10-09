

<?php
session_start();
include "checklogin.php";

//เขียนคำสั่งให้ Insert ข้อมูลโดยให้ เช็ค การ POST


try {
    
    $sql="Select * from   users ";
    
    $stmt=$conn->prepare($sql);//1.Prepare
    $stmt->execute(); //execute query
    
    $users=$stmt->fetchAll(PDO::FETCH_ASSOC);

    
    
}catch(PDOException $e){
    echo "error".$ef->getMessage();
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
<!-- สร้างตาราง 3 column แสดง ออกมา -->
 <table style="border: 1px solid gray;">
            <tr>
               <th>User ID</th>     
                <th>Username</th>
                <th>Password</th>
                <th>Full Name</th>
              
            </tr>

            <?php if (!empty($users)) { ?>

                <?php foreach ($users as $index => $user): ?>
                       
                    <tr>
                        <td><?php echo htmlspecialchars($user['user_id']);?> </td>
                        <td><?php echo htmlspecialchars($user['username']);?> </td>
                        <td><?php echo htmlspecialchars($user['password']);?> </td>
                        <td><?php echo htmlspecialchars($user['fullname']);?> </td>
                        
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

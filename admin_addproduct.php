
<?php

@include 'config.php';

if(isset($_POST['add_medicine'])){
   $m_name = $_POST['m_name'];
   $m_price = $_POST['m_price'];
   $m_image = $_FILES['m_image']['name'];
   $m_image_tmp_name = $_FILES['m_image']['tmp_name'];
   $m_image_folder = 'uploaded_img/'.$m_image;

   $insert_query = mysqli_query($conn, "INSERT INTO `medicines`(name, price, image) VALUES('$m_name', '$m_price', '$m_image')") or die('query failed');

   if($insert_query){
      move_uploaded_file($m_image_tmp_name, $m_image_folder);
      $message[] = 'medicine add succesfully';
   }else{
      $message[] = 'could not add the medicine';
   }
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_query = mysqli_query($conn, "DELETE FROM `medicines` WHERE id = $delete_id ") or die('query failed');
   if($delete_query){
      header('location: admin_addproduct.php');
      $message[] = 'medicine has been deleted';
   }else{
      header('location: admin_addproduct.php');
      $message[] = 'medicine could not be deleted';
   };
};

if(isset($_POST['update_medicine'])){
   $update_m_id = $_POST['update_m_id'];
   $update_m_name = $_POST['update_m_name'];
   $update_m_price = $_POST['update_m_price'];
   $update_m_image = $_FILES['update_m_image']['name'];
   $update_m_image_tmp_name = $_FILES['update_m_image']['tmp_name'];
   $update_m_image_folder = 'uploaded_img/'.$update_m_image;

   $update_query = mysqli_query($conn, "UPDATE `medicines` SET name = '$update_m_name', price = '$update_m_price', image = '$update_m_image' WHERE id = '$update_m_id'");

   if($update_query){
      move_uploaded_file($update_m_image_tmp_name, $update_m_image_folder);
      $message[] = 'medicine updated succesfully';
      header('location: admin_addproduct.php');
   }else{
      $message[] = 'medicine could not be updated';
      header('location: admin_addproduct.php');
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin panel</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">


<style>
   .home-btn {
            display: block;
            width: 100px;
            margin: 20px auto;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .home-btn:hover {
            background-color: #0056b3;
      
        }

</style>


</head>
<body>
   
<?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>

<?php include 'header.php'; ?>

<div class="container">

<section>

<form action="" method="post" class="add-medicine-form" enctype="multipart/form-data">
   <h3>add a new medicine</h3>
   <input type="text" name="m_name" placeholder="enter the medicine name" class="box" required>
   <input type="number" name="m_price" min="0" placeholder="enter the medicine price" class="box" required>
   <input type="file" name="m_image" accept="image/png, image/jpg, image/jpeg" class="box" required>
   <input type="submit" value="add the medicine" name="add_medicine" class="btn">
</form>

</section>

<section class="display-medicine-table">

   <table>

      <thead>
         <th>medicine image</th>
         <th>medicine name</th>
         <th>medicine price</th>
         <th>action</th>
      </thead>

      <tbody>
         <?php
         
            $select_medicines = mysqli_query($conn, "SELECT * FROM `medicines`");
            if(mysqli_num_rows($select_medicines) > 0){
               while($row = mysqli_fetch_assoc($select_medicines)){
         ?>

         <tr>
            <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
            <td><?php echo $row['name']; ?></td>
            <td>$<?php echo $row['price']; ?>/-</td>
            <td>
               <a href="admin_addproduct.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('are your sure you want to delete this?');"> <i class="fas fa-trash"></i> delete </a>
               <a href="admin_addproduct.php?edit=<?php echo $row['id']; ?>" class="option-btn"> <i class="fas fa-edit"></i> update </a>
            </td>
         </tr>

         <?php
            };    
            }else{
               echo "<div class='empty'>no medicine added</div>";
            };
         ?>
      </tbody>
   </table>

</section>

<section class="edit-form-container">

   <?php
   
   if(isset($_GET['edit'])){
      $edit_id = $_GET['edit'];
      $edit_query = mysqli_query($conn, "SELECT * FROM `medicines` WHERE id = $edit_id");
      if(mysqli_num_rows($edit_query) > 0){
         while($fetch_edit = mysqli_fetch_assoc($edit_query)){
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <img src="uploaded_img/<?php echo $fetch_edit['image']; ?>" height="200" alt="">
      <input type="hidden" name="update_m_id" value="<?php echo $fetch_edit['id']; ?>">
      <input type="text" class="box" required name="update_m_name" value="<?php echo $fetch_edit['name']; ?>">
      <input type="number" min="0" class="box" required name="update_m_price" value="<?php echo $fetch_edit['price']; ?>">
      <input type="file" class="box" required name="update_m_image" accept="image/png, image/jpg, image/jpeg">
      <input type="submit" value="update the medicine" name="update_medicine" class="btn">
      <input type="reset" value="cancel" id="close-edit" class="option-btn">
   </form>

   <?php
            };
         };
         echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
      };
   ?>

</section>

</div>


 <a href="new adminhomepg.html" class="home-btn">Home</a>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
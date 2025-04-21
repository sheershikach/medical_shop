<?php
@include 'config.php';

if(isset($_POST['add_to_cart'])){
    $m_id = $_POST['m_id'];
    $m_name = $_POST['m_name'];
    $m_price = $_POST['m_price'];
    $m_available_quantity = $_POST['m_available_quantity'];
    $m_mfg_date = $_POST['m_mfg_date'];
    $m_exp_date = $_POST['m_exp_date'];
    $m_company_name = $_POST['m_company_name'];
    $m_image = $_POST['medicine_image'];
   
    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$m_name'");
    if(mysqli_num_rows($select_cart) > 0){
        echo "<script>alert('Medicine already added to cart');</script>";
    } else {
        $insert_medicine = mysqli_query($conn, "INSERT INTO `cart`(id, name, price, image, available_quantity, mfg_date, exp_date, company_name) VALUES ('$m_id', '$m_name', '$m_price', '$m_image', '$m_available_quantity', '$m_mfg_date', '$m_exp_date', '$m_company_name')");
        if($insert_medicine){
            echo "<script>alert('Medicine added to cart successfully');</script>";
        } else {
            echo "<script>alert('Failed to add medicine to cart');</script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Medicines</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <style>
      /* CSS for Medicine Box */
      .box {
         border: 1px solid #ccc;
         border-radius: 5px;
         padding: 10px;
         margin-bottom: 20px;
         background-color: #fff;
         box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
             }

      .box img {
         max-width: 100%;
         height: auto;
         margin-bottom: 10px;
      }
      .no-stock {
         color: red;
 
         font-size: 18px;
         font-weight: bold;
         text-transform: uppercase;
      }
      .box h3 {
         font-size: 18px;
         margin-bottom: 5px;
      }

      .box p {
         font-size: 13px;
         margin: 5px 0;
         font-family: bold;
      }

      .price {
         font-weight: bold;
         color: #1abc9c;
      }

      .btn {
         background-color: sky-blue;
         color: #fff;
         border: none;
         padding: 8px 15px;
         border-radius: 3px;
         cursor: pointer;
         transition: background-color 0.3s;
         margin-right: 10px;
      }

      .btn:hover {
         background-color: darkblack;
      }

      .disabled {
         pointer-events: none;
         opacity: 0.5;
        
      }

   </style>
</head>
<body>  

<?php include 'header1.php'; ?>
<?php include 'config.php'; ?>
<div class="container">

<section class="medicines">

   <h1 class="heading">Latest Medicines</h1>

   <div class="box-container">

      <?php
      
      $select_medicines = mysqli_query($conn, "SELECT * FROM `medicines`");
      if(mysqli_num_rows($select_medicines) > 0){
         while($fetch_medicine = mysqli_fetch_assoc($select_medicines)){
      ?>

      <div class="box">
         <form action="" method="post">
            <img src="<?php echo 'uploaded_img/'.$fetch_medicine['image']; ?>" alt="Medicine Image">

            <h3><?php echo $fetch_medicine['name']; ?></h3>
         
            <?php if ($fetch_medicine['available_quantity'] > 0): ?>
               <p>Available Quantity: <?php echo $fetch_medicine['available_quantity']; ?></p>
            <?php else: ?>
               <p class="no-stock">No Stock Available</p>
            <?php endif; ?>
            
            <p>Manufacture Date: <?php echo $fetch_medicine['mfg_date']; ?></p>
            <p>Expiry Date: <?php echo $fetch_medicine['exp_date']; ?></p>
            <p>Company Name: <?php echo $fetch_medicine['company_name']; ?></p>
            <div class="price">Price: &#8377;<?php echo $fetch_medicine['price']; ?>/-</div>
            <input type="hidden" name="m_id" value="<?php echo $fetch_medicine['id']; ?>">
            <input type="hidden" name="m_name" value="<?php echo $fetch_medicine['name']; ?>">
            <input type="hidden" name="m_price" value="<?php echo $fetch_medicine['price']; ?>">
            <input type="hidden" name="m_available_quantity" value="<?php echo $fetch_medicine['available_quantity']; ?>">
            <input type="hidden" name="m_mfg_date" value="<?php echo $fetch_medicine['mfg_date']; ?>">
            <input type="hidden" name="m_exp_date" value="<?php echo $fetch_medicine['exp_date']; ?>">
            <input type="hidden" name="m_company_name" value="<?php echo $fetch_medicine['company_name']; ?>">
            <input type="hidden" name="medicine_image" value="<?php echo $fetch_medicine['image']; ?>">
            <input type="submit" class="btn" value="Add to Cart" name="add_to_cart">
            <a href="checkout.php" class="btn">Buy Now</a>
         </form>
      
      </div>
      <?php
         }
      } else {
       
         echo "<div class='empty'>No medicines available</div>";
      }
      ?>

   </div>
</html>

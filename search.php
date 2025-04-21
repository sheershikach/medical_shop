<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Search Results</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   
   <style>
      body {
         background: url('backgroundimagbe.jpg');
         margin: 0;
         padding: 0;
      }

      .container {
         display: flex;
         flex-wrap: wrap;
         justify-content: center;
         padding: 20px;
      }

      .search-results {
         flex-basis: 100%;
      }

      .box-container {
         display: flex;
         flex-wrap: wrap;
         justify-content: center;
      }

      .box {
         width: 330px;
         margin: 20px;
         text-align: center;
         background-color: #fff;
         padding: 35px;
         border-radius: 10px;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
         border: 1px solid rgba(0, 0, 0, 0.5);
         font-size: 20px;
      }

      .box img {
         width: 100%;
         height: 220px;
         object-fit: cover;
      }
  .no-stock {
         color: red;
         /* Add additional styles here */
         font-size: 18px;
         font-weight: bold;
         text-transform: uppercase;
      }
      .box h3 {
         font-size: 18px;
         margin-bottom: 10px;
      }

      .box p {
        margin: 5px 0;
         font-size: 13px; 
font-family:bold;
      }

      .box .price {
         font-weight: bold;
         font-size: 18px;
      }

      .btn {
         display: block;
         width: 100%;
         padding: 10px;
         background-color: sky-blue;
         color: white;
         text-decoration: none;
         border: none;
         border-radius: 5px;
         margin-top: 10px;
      }

      .btn:hover {
         background-color: darkblack;
      }
   </style>
</head>
<body>

<?php include 'header1.php'; ?>

<div class="container">
   <section class="search-results">
      <h1 class="heading">Search Results</h1>
      <div class="box-container">
         <?php
         include 'config.php';
         if(isset($_GET['query'])){
            $query = $_GET['query'];

            $select_medicines = mysqli_query($conn, "SELECT * FROM `medicines` WHERE name LIKE '%$query%'");
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
            <?php if ($fetch_medicine['available_quantity'] > 0): ?>
               <input type="hidden" name="m_id" value="<?php echo $fetch_medicine['id']; ?>">
               <input type="hidden" name="m_name" value="<?php echo $fetch_medicine['name']; ?>">
               <input type="hidden" name="m_price" value="<?php echo $fetch_medicine['price']; ?>">
               <input type="hidden" name="m_available_quantity" value="<?php echo $fetch_medicine['available_quantity']; ?>">
               <input type="hidden" name="m_mfg_date" value="<?php echo $fetch_medicine['mfg_date']; ?>">
               <input type="hidden" name="m_exp_date" value="<?php echo $fetch_medicine['exp_date']; ?>">
               <input type="hidden" name="m_company_name" value="<?php echo $fetch_medicine['company_name']; ?>">
               <input type="hidden" name="medicine_image" value="<?php echo $fetch_medicine['image']; ?>">
               <input type="submit" class="btn" value="Add to Cart" name="add_to_cart">
            <?php else: ?>
               <input type="submit" class="btn disabled" value="Add to Cart" name="add_to_cart" disabled>
            <?php endif; ?>
         </form>

         </div>
         <?php 
               }
            } else {
               echo "No results found.";
            }
         }
         ?>
      </div>
   </section>
</div>

</body>
</html>

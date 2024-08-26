<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_page.php');
}
;

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>dashboard</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="./css/admin_style.css" />

   <style>
      body {
         background-image: url('images/background_no-logo.png');
         background-size: cover;
         background-repeat: no-repeat;
      }

      .holder {
         display: grid;
         grid-template-columns: auto auto auto;
         row-gap: 10px;
         column-gap: 10px;
      }
   </style>
</head>

<body>

   <?php @include 'admin_header.php'; ?>

   <section class="dashboard">

      <h1 class="title">dashboard</h1>

      <div class="box-container">

         <div class="holder">
            <div class="box">
               <?php
               $total_pendings = 0;
               $select_pendings = mysqli_query($conn, "SELECT * FROM `orders` WHERE payment_status = 'pending'") or die('query failed');
               while ($fetch_pendings = mysqli_fetch_assoc($select_pendings)) {
                  $total_pendings += $fetch_pendings['total_price'];
               }
               ;
               ?>
               <h3>PHP <?php echo $total_pendings; ?></h3>

               <a href="pending-orders.php" class="btn">Total Pendings</a>


            </div>

            <div class="box">
               <?php
               $total_completes = 0;
               $select_completes = mysqli_query($conn, "SELECT * FROM `orders` WHERE payment_status = 'completed'") or die('query failed');
               while ($fetch_completes = mysqli_fetch_assoc($select_completes)) {
                  $total_completes += $fetch_completes['total_price'];
               }
               ;
               ?>
               <h3>₱<?php echo $total_completes; ?></h3>

               <a href="completed-orders.php" class="btn">Completed Payments</a>
            </div>


            <div class="box">
               <?php
               $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
               $number_of_orders = mysqli_num_rows($select_orders);
               ?>
               <h3><?php echo $number_of_orders; ?></h3>
               <a href="admin_orders.php" class="btn">All Orders</a>

            </div>

            <div class="box">
               <?php
               $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
               $number_of_products = mysqli_num_rows($select_products);
               ?>
               <h3><?php echo $number_of_products; ?></h3>
               <a href="admin_products.php" class="btn">products</a>
            </div>

            <div class="box">
               <?php
               $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'user'") or die('query failed');
               $number_of_users = mysqli_num_rows($select_users);
               ?>
               <h3><?php echo $number_of_users; ?></h3>
               <a href="admin_users.php" class="btn">View Users</a>
            </div>

            <div class="box">
               <?php
               $select_messages = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
               $number_of_messages = mysqli_num_rows($select_messages);
               ?>
               <h3><?php echo $number_of_messages; ?></h3>
               <a href="admin_contacts.php" class="btn">View messages</a>
            </div>
         </div>

      </div>

   </section>













   <script src="js/admin_script.js"></script>

</body>

</html>
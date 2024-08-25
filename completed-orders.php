<?php
session_start();
@include 'config.php';

if (isset($_SESSION['user_id'])) { // check if user_id is set
   $user_id = $_SESSION['user_id'];

   $select_completed_orders = mysqli_query($conn, "SELECT * FROM orders WHERE user_id = '$user_id' AND payment_status = 'Completed'") or die('query failed');
}

$select_orders = mysqli_query($conn, "SELECT * FROM orders WHERE payment_status = 'Completed'") or die('query failed');
$completed_orders = mysqli_fetch_all($select_orders, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="./css/admin_style.css" />

   <style>
      body {
         background-image: url('images/background_no-logo.png');
         background-size: cover;
         background-repeat: no-repeat;
      }

      .orders {
         display: block;
         max-width: 1200px;
         margin: 20px auto;
      }

      .orders .box-container {
         display: grid;
         grid-template-columns: auto auto auto auto;
         column-gap: 10px;
         row-gap: 10px;


      }

      .orders .box-container .box {
         padding: 2rem;
         border: var(--border);
         background-color: var(--white);
         box-shadow: var(--box-shadow);
         border-radius: .5rem;
         height: 500px;

      }

      .orders .box-container .box .box-text {
         height: 435px;
      }

      .orders .box-container .box .box-text p {
         margin-bottom: 1rem;
         font-size: 1.5rem;
         color: var(--light-color);
      }

      .orders .box-container .box .box-text p span {
         color: var(--pink);
      }

      .orders .box-container .box form {
         margin-top: 1rem;
         text-align: center;
      }

      .orders .box-container .box form select {
         width: 100%;
         border: var(--border);
         padding: 1.2rem 1.4rem;
         font-size: 1.8rem;
         color: var(--black);
         border: var(--border);
         border-radius: .5rem;
         margin: .5rem 0;
      }

      h3 {
         margin-left: 25%;
         font-size: 380%;
      }
   </style>
</head>

<body>

   <?php @include 'admin_header.php'; ?>

   <section class="heading">
      <a href="admin_page.php" class="navlink">
         <i class="fas fa-arrow-left"></i>
         <h3>COMPLETED ORDERS</h3>
      </a>

   </section>



   <section class="orders">
      <h1 class="completed-order">
         <div class="box-container">
            <?php foreach ($completed_orders as $order) { ?>
               <div class="box">
                  <div class="box-text">
                     <p>Placed on: <span><?php echo $order['placed_on']; ?></span></p><br>
                     <p>Name: <span><?php echo $order['name']; ?></span></p><br>
                     <p>Number: <span><?php echo $order['number']; ?></span></p><br>
                     <p>Email: <span><?php echo $order['email']; ?></span></p><br>
                     <p>Address: <span><?php echo $order['address']; ?></span></p><br>
                     <p>Total Products: <span><?php echo $order['total_products']; ?></span></p><br>
                     <p>Total Price: <span>PHP <?php echo $order['total_price']; ?></span></p><br>
                     <p>Payment Method: <span><?php echo $order['method']; ?></span></p>
                  </div>
               </div>
            <?php } ?>
         </div>
      </h1>
   </section>

   <script src="js/script.js"></script>

</body>

</html>
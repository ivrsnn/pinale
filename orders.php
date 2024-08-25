<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}


if(isset($_GET['order_id'])){
    header('location: pending-products.php?order_id=' . $_GET['order_id']);
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <style>
      body {
         background-image: url('images/haha.jpg');
         background-repeat: no-repeat;
         background-size: cover;
         background-position: center;
         background-attachment: fixed;
         height: 100vh;
         margin: 0;
      }

   </style>

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>your orders</h3>
    <p> <a href="home.php">home</a> / order </p>
</section>

<section class="placed-orders">

    <h1 class="title">placed orders</h1>

    <div class="box-container">

        <?php
            $select_orders = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id' ORDER BY placed_on DESC") or die('query failed');
            if(mysqli_num_rows($select_orders) > 0){
                while($fetch_orders = mysqli_fetch_assoc($select_orders)){
        ?>
        <div class="box">
            <p> Placed on : <span><?php 
                $date_placed = new DateTime($fetch_orders['placed_on']);
                $new_date = date_format($date_placed, "M d, Y | h:i a");
                echo $new_date;
            ?></span> </p>
            <p> Name : <span><?php echo $fetch_orders['name']; ?></span> </p>
            <p> Number : <span><?php echo $fetch_orders['number']; ?></span> </p>
            <p> Email : <span><?php echo $fetch_orders['email']; ?></span> </p>
            <p> Address : <span><?php echo $fetch_orders['address']; ?></span> </p>
            <p> Payment method : <span><?php echo $fetch_orders['method']; ?></span> </p>
            <p> Your Orders : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
            <p> Total Price : <span>PHP <?php echo $fetch_orders['total_price']; ?></span> </p>
            <p> Payment Status : <span style="color:<?php if($fetch_orders['payment_status'] == 'Pending'){echo 'tomato'; }else{echo 'green';} ?>"><?php echo $fetch_orders['payment_status']; ?></span> </p>
        </div>
        <?php
            }
        }else{
            echo '<p class="empty">no orders placed yet!</p>';
        }
        ?>
    </div>

</section>







<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
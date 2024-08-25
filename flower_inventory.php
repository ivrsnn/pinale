<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
}
;

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `flowers` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_flowers.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Flower Inventory</title>

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

      .box-container {
         display: flex;
         width: 100%;
         justify-content: center;
         height: 60vh;
      }

      .flower-table {
         font-size: 2.0rem;
         margin: 20px auto;
         width: 80%;
      }

      .flower-table tbody tr td {
         text-align: center;

      }
   </style>

</head>

<body>

   <?php @include 'admin_header.php'; ?>

   <section class="flowers">

      <h1 class="title">Flower Inventory</h1>
      <a href="admin_page.php" class="navlink">
         <i class="fas fa-arrow-left"></i>
      </a>
      <div class="box-container">
         <table class="flower-table">
            <thead>
               <tr>
                  <th>Flower ID</th>
                  <th>Flower Name</th>
                  <th>Quantity</th>
                  <th>Price</th>
                  <th>Action</th>
               </tr>
            </thead>

            <tbody>
               <?php
               $select_flowers = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
               if (mysqli_num_rows($select_flowers) > 0) {
                  while ($fetch_flowers = mysqli_fetch_assoc($select_flowers)) {
                     ?>
                     <tr>
                        <td><?php echo $fetch_flowers['id']; ?></td>
                        <td><?php echo $fetch_flowers['name']; ?></td>
                        <td><?php echo $fetch_flowers['quantity']; ?></td>
                        <td>PHP <?php echo $fetch_flowers['price']; ?></td>
                        <td><a href="admin_orders.php?delete=<?php echo $fetch_flowers['id']; ?>"
                              onclick="return confirm('delete this flower?');" class="delete-btn">delete</a></td>
                     </tr>
                     <?php
                  }
               }
               ?>

            </tbody>
         </table>
      </div>

   </section>

</body>

</html>
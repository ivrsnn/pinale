<?php
@include 'config.php';
if (isset($_POST['submit'])) {
   $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
   $email = mysqli_real_escape_string($conn, $filter_email);
   $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
   $pass = mysqli_real_escape_string($conn, md5($filter_pass));
   $filter_cpass = filter_var($_POST['cpass'], FILTER_SANITIZE_STRING);
   $cpass = mysqli_real_escape_string($conn, md5($filter_cpass));

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

   if (mysqli_num_rows($select_users) > 0) {
      if ($pass != $cpass) {
         $message[] = 'confirm password not matched!';
      }
   } else {
      $message[] = 'user not exist!';
   }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>FORGOT PASSWORD</title>

   <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.min.css">
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./css/style.css" />

   <style>
      body {
         background-image: url('images/pompom.jpg');
         background-size: cover;
         background-repeat: no-repeat;
      }

      #popup {
         display: none;
         align-items: center;
         position: absolute;
         top: 0;
         bottom: 0;
         left: 0;
         right: 0;
         background-color: rgba(153, 170, 187, 0.8);
         z-index: 999;

      }

      .message-box {
         display: flex;
         justify-content: center;
         width: 250px;
         height: 150px;
         background-color: white;
         border: 1px solid black;
         border-radius: 5%;
         margin: auto;
         padding: 1rem;
         flex-direction: column;
         align-items: center;

      }

      .message-box span {
         font-size: 1.5rem;

      }
   </style>


</head>

<body>
   <div id="popup">
      <div class="message-box">
         <span>Password Successfully Changed</span>
         <a class="btn" href="login.php">OK</a>
      </div>
   </div>

   <?php
   if (isset($message)) {
      foreach ($message as $message) {
         echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
      }
   }
   ?>

   <section class="form-container">

      <form action="" method="post">
         <h3>CHANGE PASSWORD</h3>
         <input type="email" name="email" class="box" placeholder="enter your email" required>
         <input type="password" name="pass" class="box" placeholder="enter your new password" required>
         <input type="password" name="cpass" class="box" placeholder="confirm your new password" required>
         <input type="submit" class="btn" name="submit" value="submit">

      </form>

   </section>

</body>

</html>

<?php

if (isset($_POST['submit'])) {
   if ($pass == $cpass && empty($message)) {
      mysqli_query($conn, "UPDATE users SET password = '$pass' WHERE email = '$email'") or die('query failed');
      echo '<script>document.getElementById("popup").style.display="flex";</script>';
   }
}
?>
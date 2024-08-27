<?php

@include 'config.php';

if (isset($_POST['submit'])) {

   $filter_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
   $name = mysqli_real_escape_string($conn, $filter_name);
   $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
   $email = mysqli_real_escape_string($conn, $filter_email);
   $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
   $pass = mysqli_real_escape_string($conn, $filter_pass);
   $filter_cpass = filter_var($_POST['cpass'], FILTER_SANITIZE_STRING);
   $cpass = mysqli_real_escape_string($conn, $filter_cpass);

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./css/style.css" />

   <style>
      body {
         background-image: url('images/bgbgbg.jpg');
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
         <span>registered successfully!</span>
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
         <h3>register now</h3>
         <input type="text" name="name" class="box" placeholder="enter your username" required>
         <input type="email" name="email" class="box" placeholder="enter your email" required>
         <input type="password" name="pass" class="box" placeholder="enter your password" required>
         <input type="password" name="cpass" class="box" placeholder="confirm your password" required>
         <input type="submit" class="btn" name="submit" value="register now">
         <p>already have an account? <a href="login.php">login now</a></p>
      </form>

   </section>

</body>

</html>

<?php

if (isset($_POST['submit'])) {
   $passwordError = "";
   if (!empty($pass) && !empty($cpass)) {
      $password = htmlspecialchars($pass);
      $confirmPassword = htmlspecialchars($cpass);

      // Password pattern that is to find match containing 
      // at least 1 uppercase, lowercase, number and special characters
      // and also length 8
      $password_pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';

      if ($password != $confirmPassword) {
         $passwordError .= "Passwords are not same.\n";
      }
      if (!preg_match($password_pattern, $password)) {
         $passwordError .= "Password must have at least 8 character length with mimimum 1 uppercase, 1 lowercase, 1 number and 1 special characters.\n";
      }
   } else {
      $passwordError .= "Enter password and confirm.\n";
   }

   // Prepare validation response for acknowleding user
   if (!empty($passwordError)) {
      $message[] = $passwordError;
   } else {
      $hashedPassword = md5(htmlspecialchars($pass));
      $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

      if (mysqli_num_rows($select_users) > 0) {
         $message[] = 'user already exist!';
      } else {
         mysqli_query($conn, "INSERT INTO `users`(name, email, password) VALUES('$name', '$email', '$hashedPassword')") or die('query failed');
         echo '<script>document.getElementById("popup").style.display = "flex";</script>';
      }

   }
}
?>
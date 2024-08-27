<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
  header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>about</title>

  <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.min.css">
  <!-- font awesome cdn link  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  <!-- custom admin css file link  -->
  <link rel="stylesheet" href="./css/style.css" />

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

    .team-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 20px;
    }

    .team-member {
      position: relative;
      overflow: hidden;
    }

    .team-member img {
      width: 100%;
      height: 400px;
      object-fit: cover;
      transition: transform 0.5s ease-in-out;
    }

    .team-member:hover img {
      transform: scale(1.1);
    }

    .overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.7);
      color: #fff;
      padding: 20px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      opacity: 0;
      transition: opacity 0.5s ease-in-out;
    }

    .team-member:hover .overlay {
      opacity: 1;
    }

    .overlay h2 {
      font-size: 24px;
      margin-bottom: 10px;
    }

    .overlay p {
      font-size: 18px;
      margin-bottom: 20px;
    }

    .overlay .btn {
      background-color: #333;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .overlay .btn:hover {
      background-color: #444;
    }
  </style>
</head>

<body>

  <?php @include 'header.php'; ?>


  <section class="heading">
    <h3>about us</h3>
    <p> <a href="home.php">Home</a> / About </p>
  </section>

  <section class="about">

    <div class="flex">

      <div class="image">
        <img src="images/logo_transparent.png" alt="">
      </div>

      <div class="content">
        <h3>why choose us?</h3>
        <p>Welcome to CK Handmade Flower Shop, we take pride in crafting each bouquet with love and attention to detail.
          Our flowers are not just arrangements; they are heartfelt gifts that convey emotions and create lasting
          memories. We carefully select fresh, locally sourced materials, ensuring that every creation is not only
          beautiful but also sustainable.</p>
        <a href="shop.php" class="btn">shop now</a>
      </div>

    </div>

    <div class="flex">
      <div class="content">
        <h3>what we provide?</h3>
        <p>At CK Handmade Flower Shop, where creativity blossoms and every petal tells a story! We are a team of
          enthusiastic students who believe in the magic of flowers and their ability to brighten any occasion. From
          birthdays to anniversaries, graduations to "just because," our handmade floral arrangements are designed to
          bring joy and warmth to your loved ones.</p>
        <a href="contact.php" class="btn">contact us</a>
      </div>
    </div>

    <div class="imagee">
      <video class="d-block m-auto" width="285" height="495" autoplay muted loop>
        <source src="images/orders.mp4" type="video/mp4">

      </video>
    </div>

    </div>

    </div>


  </section>

  <section class="admins" id="admins">
    <h1 class="title">Our team</h1>
    <div class="team-grid">
      <div class="team-member">
        <img src="images/me.jpg" alt="Team Member 1">
        <div class="overlay">
          <h2>Guivencan, Kathlyn Jade C</h2>
          <p>Front End & Back End Developer</p>



        </div>
      </div>
      <div class="team-member">
        <img src="images/alben.jpg" alt="Team Member 2">
        <div class="overlay">
          <h2>Ponce, Alvin</h2>
          <p>Front End & Back End Developer</p>

        </div>
      </div>
      <div class="team-member">
        <img src="images/iverson.jpg" alt="Team Member 3">
        <div class="overlay">
          <h2>Castro, Iverson</h2>
          <p>Front end & Back end Developer </p>


        </div>
      </div>
      <div class="team-member">
        <img src="images/ande.png" alt="Team Member 4">
        <div class="overlay">
          <h2>Importado, Andhy</h2>
          <p>Designer</p>

        </div>
      </div>
    </div>
  </section>











  <?php @include 'footer.php'; ?>

  <script src="js/script.js"></script>

</body>

</html>
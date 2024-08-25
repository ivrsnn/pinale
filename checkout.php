<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}
;

if (isset($_POST['order'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $method = mysqli_real_escape_string($conn, $_POST['method']);
    $address = mysqli_real_escape_string($conn, $_POST['region'] . ' , ' . $_POST['province'] . ' , ' . $_POST['municipality'] . ' , ' . $_POST['address'] . ' , ' . $_POST['country'] . ' - ' . $_POST['pin_code']);
    date_default_timezone_set('Asia/Manila');
    $placed_on = date('Y-m-d H:i:s');

    $cart_total = 0;
    $cart_products[] = '';

    $cart_query = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id'") or die('query failed');
    if (mysqli_num_rows($cart_query) > 0) {
        while ($cart_item = mysqli_fetch_assoc($cart_query)) {
            $cart_products[] = $cart_item['name'] . ' (' . $cart_item['quantity'] . ') ';
            $sub_total = ($cart_item['price'] * $cart_item['quantity']);
            $cart_total += $sub_total;
        }
    }

    $total_products = implode(' | ', $cart_products);

    $order_query = mysqli_query($conn, "SELECT * FROM orders WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');

    if ($cart_total == 0) {
        $message[] = 'your cart is empty!';
    } elseif (mysqli_num_rows($order_query) > 0) {
        $message[] = 'order placed already!';
    } else {
        $payment_status = 'pending';

        mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on, payment_status) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on', '$payment_status')") or die('query failed');
        mysqli_query($conn, "DELETE FROM cart WHERE user_id = '$user_id'") or die('query failed');
        $message[] = 'order placed successfully!';
        echo '<script>
                window.location.href = "./orders.php";
                </script>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>checkout</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <!-- casscading script -->
    <script>
        var subjectObject = {
            "CALABARZON": {
                "Cavite": ["Alfonso", "Amadeo", "Bacoor", "Carmona", "Cavite", "Dasmarinas", "Gen. Emilio Aguinaldo", "Gen. Mariano Alvarez", "General Trias", "Imus", "Indang", "Kawit", "Magallanes", "Maragondon", "Mendez", "Naic", "Noveleta", "Rosario", "Silang", "Tagaytay", "Tanza", "Ternate", "Trece Martires"],
                "Laguna": ["Alaminos", "Bay", "Binan", "Cabuyao", "Calamba", "Calauan", "Cavinti", "Famy", "Kalayaan(LA)", "Liliw", "Los Banos", "Luisiana", "Lumban", "Mabitac", "Magdalena", "Majayjay", "Nagcarlan", "Paete", "Pagsanjan", "Pakil", "Pangil", "Pila", "Rizal", "San Pablo", "San Pedro", "Santa Maria", "Santa Rosa", "Siniloan", "Victoria"],
                "Batangas": ["Agoncillo", "Alitagtag", "Balayan", "Balete", "Batangas", "Bauan", "Calaca", "Calatagan", "Cuenca", "Ibaan", "Laurel", "Lemery", "Lian", "Lipa", "Lobo", "Mabini", "Malvar", "Mataasnakahoy", "Nasugbu", "Padre Garcia", "Rosario", "San Jose", "San Juan", "San Luis", "San Nicolas", "San Pascual", "Santa Teresita", "Santo Tomas", "Taal", "Talisay", "Tanauan", "Taysan", "Tingloy", "Tuy"],
                "Rizal": ["Angono", "Antipolo", "Baras", "Binangonan", "Cainta", "Cardona", "JalaJala", "Morong", "Pilila", "Rodriguez", "San Mateo", "Tanay", "Taytay", "Teresa"],
                "Quezon": ["Agdangan", "Alabat", "Atimonan", "Buenavista", "Burdeos", "Calauag", "Candelaria", "Catanauan", "Dolores", "General Luna", "General Nakar", "Guinayangan", "Gumaca", "Infanta", "Jomalig", "Lopez", "Lucban", "Macalelon", "Mauban", "Maulanay", "Padre Burgos", "Pagbilao", "Panukulan", "Pagtanungan", "Perez", "Pitogo", "Plaridel", "Polilo", "Quezon", "Real", "Sampaloc", "San Andres", "San Antonio", "San Francisco", "San Narciso", "Sariaya", "Tagkawayan", "Tayabas", "Tiaong", "Unisan"]
            },
        }
        window.onload = function () {
            var subjectSel = document.getElementById("region");
            var topicSel = document.getElementById("province");
            var chapterSel = document.getElementById("municipality");
            for (var x in subjectObject) {
                subjectSel.options[subjectSel.options.length] = new Option(x, x);
            }
            subjectSel.onchange = function () {
                //empty Chapters- and Topics- dropdowns
                chapterSel.length = 1;
                topicSel.length = 1;
                //display correct values
                for (var y in subjectObject[this.value]) {
                    topicSel.options[topicSel.options.length] = new Option(y, y);
                }
            }
            topicSel.onchange = function () {
                //empty Chapters dropdown
                chapterSel.length = 1;
                //display correct values
                var z = subjectObject[subjectSel.value][this.value];
                for (var i = 0; i < z.length; i++) {
                    chapterSel.options[chapterSel.options.length] = new Option(z[i], z[i]);
                }
            }
        }
    </script>
</head>

<body>

    <?php @include 'header.php'; ?>

    <section class="heading">
        <h3>checkout order</h3>
        <p> <a href="home.php">home</a> / checkout </p>
    </section>

    <section class="display-order">
        <?php
        $grand_total = 0;
        $select_cart = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id'") or die('query failed');
        if (mysqli_num_rows($select_cart) > 0) {
            while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
                $grand_total += $total_price;
                ?>
                <p> <?php echo $fetch_cart['name'] ?>
                    <span>(<?php echo 'PHP ' . $fetch_cart['price'] . ' x ' . $fetch_cart['quantity'] ?>)</span>
                </p>
                <?php
            }
        } else {
            echo '<p class="empty">your cart is empty</p>';
        }
        ?>
        <div class="grand-total">grand total : <span>PHP <?php echo $grand_total; ?></span></div>
    </section>

    <section class="checkout">

        <form action="" method="POST">

            <h3>place your order</h3>

            <div class="flex">
                <div class="inputBox">
                    <span>Name :</span>
                    <input type="text" name="name" placeholder="Enter your Name" required>
                </div>
                <div class="inputBox">
                    <span>Number :</span>
                    <input type="number" name="number" min="0" placeholder="Enter your Number">
                </div>
                <div class="inputBox">
                    <span>Email :</span>
                    <input type="email" name="email" placeholder="Enter your Email">
                </div>
                <div class="inputBox">
                    <span>Payment Method :</span>
                    <select name="method">
                        <option value=" "></option>
                        <option value="cash on delivery">Cash on Delivery</option>
                    </select>
                </div>
                <div class="inputBox">
                    <form name="form1" id="form1" action="/action_page.php">
                        <span>Region: </span>
                        <select name="region" id="region">
                            <option value="" selected="selected">Select Province First</option>
                        </select>
                        <span>Province:</span>
                        <select name="province" id="province">
                            <option value="" selected="selected">Please select Region first</option>
                        </select>
                        <span>Municipality:</span>
                        <select name="municipality" id="municipality">
                            <option value="" selected="selected">Please select Province first</option>
                        </select>
                    </form>
                </div>
                <div class="inputBox">
                    <span>Postal Code :</span>
                    <input type="text" name="pin_code" placeholder="e.g 1234">
                    <span>Country :</span>
                    <input type="text" name="country" id="country" placeholder="e.g. Philippines">
                    <span>Full Address :</span>
                    <input type="text" name="address" placeholder="e.g BLK 40... LOT 5... Brgy.....">
                </div>
                <div class="inputBox">
                    <input type="submit" name="order" value="order now" class="btn">
                </div>
            </div>
        </form>

    </section>

    <?php @include 'footer.php'; ?>

    <script src="js/script.js"></script>

</body>

</html>
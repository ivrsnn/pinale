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

      .hideForm {
         display: none;
      }

      .errorMessage {
         font-size: 1.5rem;
         color: red;
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

   <div class="message hideForm" id="errorBox">
      <span id="errorMessage"></span>
      <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
   </div>

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
   <section class="form-container">

      <form id="emailForm">
         <h3>VERIFY EMAIL</h3>
         <span class="errorMessage" id="emailerrorMessage"></span>
         <input type="email" name="email" id="email" class="box" placeholder="enter your email" required>
         <input type="button" class="btn" id="emailSubmit" name="emailSubmit" value="submit" onclick="submitEmail();">
      </form>

      <form class="hideForm" id="otpForm">
         <h3>ENTER OTP</h3>
         <p>OTP has been sent to your email. check your email and enter otp below.</p>
         <span class="errorMessage" id="otperrorMessage"></span>
         <input type="hidden" name="otp" id="otp" class="box">
         <input type="text" name="otpinput" id="otpinput" class="box" placeholder="enter your otp" required>
         <input type="button" class="btn" id="otpSubmit" name="otpSubmit" value="submit" onclick="verifyOtp();">
      </form>

      <form action="" method="post" class="hideForm" id="passwordForm">
         <h3>CHANGE PASSWORD</h3>
         <input type="hidden" name="passwordemail" id="passwordemail" class="box">
         <input type="password" name="pass" id="pass" class="box" placeholder="enter your new password" required>
         <input type="password" name="cpass" id="cpass" class="box" placeholder="confirm your new password" required>
         <input type="button" class="btn" name="submit" value="submit" onclick="changePassword();">

      </form>

   </section>

   <script>
      function submitEmail() {
         const email = document.getElementById("email").value;

         $.ajax({
            method: "POST",
            url: "forgotPasswordFunctions.php",
            data: {
               type: "verifyEmail",
               email: email,
            },
            success: function (data) {
               var error = data.error;

               if (!error) {
                  const otp = data.otp;

                  sendOtp(email, otp).then(function (otpSend) {
                     if (otpSend.error) {
                        document.getElementById("emailerrorMessage").value = otpSend.message;
                     } else {
                        document.getElementById("emailerrorMessage").innerHTML = "";
                        document.getElementById('otp').value = otpSend.otp;
                        document.getElementById('emailForm').style.display = 'none';
                        document.getElementById('otpForm').style.display = 'block';
                     }
                  }).catch(function (error) {
                     console.error("Error sending OTP:", error);
                  });

               } else {
                  document.getElementById("emailerrorMessage").innerHTML = emailVerification.message;
               }
            },
         });
      }

      function sendOtp(email, otp) {
         return $.ajax({
            method: "POST",
            url: "forgotPasswordFunctions.php",
            data: {
               type: "sendOtp",
               email: email,
               otp: otp,
            },
            dataType: 'json' // Ensure that the response is treated as JSON
         });
      }


      function verifyOtp() {

         const otp = document.getElementById('otp').value;
         const otpinput = document.getElementById('otpinput').value;

         if (otp === otpinput) {
            document.getElementById('passwordForm').style.display = 'block';
            document.getElementById('otpForm').style.display = 'none';
            document.getElementById("otperrorMessage").innerHTML = "";
            const email = document.getElementById("email").value;
            document.getElementById("passwordemail").value = email;

         }
         else {
            document.getElementById("otperrorMessage").innerHTML = "Incorrect otp";
         }
      }


      function changePassword() {
         var errorMessage = "";

         var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
         var password = document.getElementById('pass').value;
         var cpassword = document.getElementById('cpass').value;

         var email = document.getElementById('passwordemail').value;

         if (cpassword !== password) {
            errorMessage += "Passwords are not the same.\n";
         }

         if (!regex.test(password)) {
            errorMessage += "Password must have at least 8 character length with mimimum 1 uppercase, 1 lowercase, 1 number and 1 special characters.\n";
         }

         if (errorMessage) {
            document.getElementById('errorMessage').innerHTML = errorMessage;
            document.getElementById('errorBox').style.display = 'block';
         }
         else {
            document.getElementById('errorMessage').innerHTML = "";
            document.getElementById('errorBox').style.display = 'none';

            $.ajax({
               method: "POST",
               url: "forgotPasswordFunctions.php",
               data: {
                  type: "changePassword",
                  email: email,
                  pass: password
               },
               success: function (data) {
                  var error = data.error;

                  if (!error) {
                     document.getElementById("popup").style.display = "flex";
                  }
               },
            });
         }
      }
   </script>

</body>

</html>
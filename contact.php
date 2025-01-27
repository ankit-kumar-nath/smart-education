<?php

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

if(isset($_POST['submit'])){

   $name = $_POST['name']; 
   $name = filter_var($name, FILTER_SANITIZE_SPECIAL_CHARS);
$email = $_POST['email']; 
$email = filter_var($email, FILTER_SANITIZE_EMAIL);  // Use FILTER_SANITIZE_EMAIL for sanitizing email addresses
$number = $_POST['number']; 
$number = filter_var($number, FILTER_SANITIZE_NUMBER_INT);  // Use FILTER_SANITIZE_NUMBER_INT for phone numbers
$msg = $_POST['msg']; 
$msg = filter_var($msg, FILTER_SANITIZE_SPECIAL_CHARS);


   $select_contact = $conn->prepare("SELECT * FROM `contact` WHERE name = ? AND email = ? AND number = ? AND message = ?");
   $select_contact->execute([$name, $email, $number, $msg]);

   if($select_contact->rowCount() > 0){
      $message[] = 'message sent already!';
   }else{
      $insert_message = $conn->prepare("INSERT INTO `contact`(name, email, number, message) VALUES(?,?,?,?)");
      $insert_message->execute([$name, $email, $number, $msg]);
      $message[] = 'message sent successfully!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="contact">

   <div class="row">

      <div class="image">
         <img src="images/contact-img.svg" alt="">
      </div>

      <form action="" method="post">
         <h3>get in touch</h3>
         <input type="text" placeholder="enter your name" required maxlength="100" name="name" class="box">
         <input type="email" placeholder="enter your email" required maxlength="100" name="email" class="box">
         <input type="number" min="0" max="9999999999" placeholder="enter your number" required maxlength="10" name="number" class="box">
         <textarea name="msg" class="box" placeholder="enter your message" required cols="30" rows="10" maxlength="1000"></textarea>
         <input type="submit" value="send message" class="inline-btn" name="submit">
      </form>

   </div>

   <div class="box-container">

      <div class="box">
         <i class="fas fa-phone"></i>
         <h3>Phone Number</h3>
         <a href="tel:7849062783">+91 7849062783</a>
         <a href="tel:7609068783">+91 7609068783</a>
      </div>

      <div class="box">
         <i class="fas fa-envelope"></i>
         <h3>Email Address</h3>
         <a href="mailto:ankitkumarnath120@gmail.com">ankitkumarnath120@gmail.com</a>
         <a href="mailto:anasbhai@gmail.com">ankitnath120@yahoo.com</a>
      </div>

      <div class="box">
         <i class="fas fa-map-marker-alt"></i>
         <h3>Office Address</h3>
         <a href="https://www.google.com/maps/place/GIET+University/@19.0473136,83.8284775,17z/data=!4m15!1m8!3m7!1s0x3a20ddf302a63a47:0xd8c5feac139c3d1!2sGandhi+Chowk,+Brajrajnagar,+Odisha+768216!3b1!8m2!3d21.8620402!4d83.9241509!16s%2Fg%2F11bz6nyjjn!3m5!1s0x3a3c96658f8652ad:0x7dafcb1b8586f019!8m2!3d19.0473136!4d83.8310524!16s%2Fm%2F02vzm52?authuser=0&entry=ttu">Gandhi Chowk, Brajrajnagar, Jharsuguda, 768216</a>
      </div>
   </div>
   <?php include 'components/chat_bot.php'; ?>
</section>

<?php include 'components/footer.php'; ?>  
<script src="js/script.js"></script>
   
</body>
</html>
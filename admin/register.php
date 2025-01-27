<?php

include '../components/connect.php';

if(isset($_POST['submit'])){

   $id = unique_id();
   $name = $_POST['name'];
   $name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
   $profession = htmlspecialchars($_POST['profession'], ENT_QUOTES, 'UTF-8');
   $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
   
   $pass = sha1($_POST['pass']);
   $cpass = sha1($_POST['cpass']);
   
  
   $image = $_FILES['image']['name'];
   $image = htmlspecialchars($image, ENT_QUOTES, 'UTF-8');
   
   $ext = pathinfo($image, PATHINFO_EXTENSION);
   $rename = unique_id().'.'.$ext;
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_files/'.$rename;

   $select_tutor = $conn->prepare("SELECT * FROM `tutors` WHERE email = ?");
   $select_tutor->execute([$email]);
   
   if($select_tutor->rowCount() > 0){
      $message[] = 'email already taken!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm passowrd not matched!';
      }else{
         $insert_tutor = $conn->prepare("INSERT INTO `tutors`(id, name, profession, email, password, image) VALUES(?,?,?,?,?,?)");
         $insert_tutor->execute([$id, $name, $profession, $email, $cpass, $rename]);
         move_uploaded_file($image_tmp_name, $image_folder);
         $message[] = 'new tutor registered! please login now';
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body style="padding-left: 0;">

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message form">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<section class="form-container">

   <form class="register" action="" method="post" enctype="multipart/form-data">
      <h3>register new</h3>
      <div class="flex">
         <div class="col">
            <p>your name <span>*</span></p>
            <input type="text" name="name" placeholder="eneter your name" maxlength="50" required class="box">
            <p>your profession <span>*</span></p>
            <select name="profession" class="box" required>
               <option value="" disabled selected>-- select your profession</option>
               <option value="Web Developer">Web Developer</option>
               <option value="Web Desginer">Web Desginer</option>
               <option value="Frontend Developer">Frontend Developer</option>
               <option value="Backend Developer">Backend Developer</option>
               <option value="Master in Web Application">Master in Web Application</option>
               <option value="Full Stack Development">Full Stack Development</option>
               <option value="Asst. Professor">Asst. Professor</option>
               <option value="Software Developer">Software Developer</option>
               <option value="Engineer">Engineer</option>
               <option value="journalist">journalist</option>
               <option value="photographer">photographer</option>
            </select>
            <p>your email <span>*</span></p>
            <input type="email" name="email" placeholder="enter your email" maxlength="30" required class="box">
         </div>
         <div class="col">
            <p>your password <span>*</span></p>
            <input type="password" name="pass" placeholder="enter your password" maxlength="30" required class="box">
            <p>confirm password <span>*</span></p>
            <input type="password" name="cpass" placeholder="confirm your password" maxlength="30" required class="box">
            <p>select pic <span>*</span></p>
            <input type="file" name="image" accept="image/*" required class="box">
         </div>
      </div>
      <p class="link">Already have an account? <a href="login.php">Login Now</a></p>
      <input type="submit" name="submit" value="register now" class="btn">
   </form>

</section>

<script>

let darkMode = localStorage.getItem('dark-mode');
let body = document.body;

const enabelDarkMode = () =>{
   body.classList.add('dark');
   localStorage.setItem('dark-mode', 'enabled');
}

const disableDarkMode = () =>{
   body.classList.remove('dark');
   localStorage.setItem('dark-mode', 'disabled');
}

if(darkMode === 'enabled'){
   enabelDarkMode();
}else{
   disableDarkMode();
}

</script>
   
</body>
</html>
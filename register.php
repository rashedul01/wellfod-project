<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $user_type = $_POST['user_type'];

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'user already exist!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         mysqli_query($conn, "INSERT INTO `users`(name, email, password, user_type) VALUES('$name', '$email', '$cpass', '$user_type')") or die('query failed');
         $message[] = 'registered successfully!';
         header('location:login.php');
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

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>



<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
   
<div class="form-container">

   <form name="registerForm" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" onsubmit="return validateForm()">
      <h3>register now</h3>
      <input type="text" name="name" placeholder="enter your name" class="box">
       <span id="errName"></span>
       <input type="email" name="email" placeholder="enter your email" required class="box">
       <span id="errEmail"></span>
       <input type="password" name="password" placeholder="enter your password" class="box">
       <span id="errPass"></span>
       <input type="password" name="cpassword" placeholder="confirm your password" class="box">
       <span id="errCpass"></span>

       <select name="user_type" class="box">
         <option value="user">user</option>
         <option value="admin">admin</option>
         <option value="res_owner">res_owner</option>

      </select>
      <input type="submit" name="submit" value="register now" class="btn">
      <p>already have an account? <a href="login.php">login now</a></p>
   </form>

</div>

<script>
    function validateForm(){
        let name = document.forms["registerForm"]["name"].value;
        let password = document.forms["registerForm"]["password"].value;
        let cpassword = document.forms["registerForm"]["cpassword"].value;

        if(name == ""){
            document.getElementById("errName").innerHTML = "Name is required";
            return false;
        }
        if(password == ""){
            document.getElementById("errPass").innerHTML = "Password Can Not Be Empty!";
            return false;
        }
        else if(password.length <= 7){
            document.getElementById("errPass").innerHTML = "Password should be up to 8 digit!";
            return false;
        }
        if(cpassword =="" || cpassword != password){
            document.getElementById("errCpass").innerHTML = "Password Not Matched!";
            return false;
        }
    }
</script>

</body>
</html>
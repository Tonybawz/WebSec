<?php
session_start();
?>
<html>
<head>
  <title>Login</title>
</head>
<body>
  <section class="container">
    <div class="login">
      <h1>Login</h1>
      <form method="post" action="login.php">
        <p><input type="text" name="inputlogin" value="" placeholder="Username"></p>
        <p><input type="password" name="inputpassword" value="" placeholder="Password"></p>

        <p class="submit"><input type="submit" name="commit" value="Login"></p>
      </form>
    </div>

    <div class="login-help">
      <p>Not a member? <a href="register.php">Click here to register</a>.</p>
    </div>
  </section>

  <?php

  require_once("connect.php");


  if(isset($_POST['commit'])){
    $username = $_POST['inputlogin'];
    $password = $_POST['inputpassword'];
    $sql = "SELECT password FROM user WHERE username = '$username'";
    $result = $conn->query($sql);
    $pwd = $result->fetch_assoc();


    if(password_verify($password,$pwd['password'])){
      $_SESSION['CurrentUser'] = $username;
      header("location: index.php");
    }
    else{
      echo "Your Username or Password is invalid";
    }
  }
  ?>

</body>
</html>

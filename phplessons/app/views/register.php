<!DOCTYPE html>
<html lang="en">
    <head>
    <title>Signup</title>
    <meta charset = utf-8>
<link rel="stylesheet" href="http://localhost/phplessons/public/css/index.css">
    </head>
<body>
<div class="auth__container">
        <div class="auth__title">Register</div>
        <div class="auth__description">Create your first account</div>
        <?php
        session_start();
        if(isset($_SESSION["registerError"])){
          $error = $_SESSION["registerError"];
          echo "<div class=\"auth__description\">$error</div>";
        }
        session_destroy();
        ?>
        <form method="POST" action="http://localhost/phplessons/public/register/registerUser" class="auth__input__container">
          <input name="uid" class="auth__input" placeholder="Username" />
          <input name="password" type="password" class="auth__input" placeholder="Password" />
          <input name="email" type='email' class="auth__input" placeholder="Email adress" /><br />
          <button class="auth__submit" type="submit" name="signup_submit">Submit</button>
          <a href="http://localhost/phplessons/public/login" class="auth__redirect">Login</a>
        </form>
      </div>
</body>
</html>
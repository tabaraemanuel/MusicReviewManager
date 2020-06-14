<!DOCTYPE html>
<html lang="en">
    <head>
      <title>Login</title>
    <meta charset = utf-8>
<link rel="stylesheet" href="http://localhost/phplessons/public/css/index.css">
    </head>
<body>
<div class="auth__container">
        <div class="auth__title">Login</div>
        <?php
        session_start();
        if(isset($_SESSION["registered"])){
          if($_SESSION["registered"]){
            echo "<div class=\"auth__description\">Register succesful!</div>";
            session_destroy();
          }
        }
        ?>
        <div class="auth__description">Login with your account</div>
        <?php
        if(isset($data['error'])){
          $error = $data["error"];
          echo "<div class=\"auth__description\">$error</div>";
        }
        ?>
        <form action="http://localhost/phplessons/public/login/loginFunc" class="auth__input__container" method="post">
          <input type='email' class="auth__input" placeholder="Email" name="email" />
          <input class="auth__input" type="password" placeholder="Password" name="password" />
          <br />
          <button name="login-submit" class="auth__submit" type="submit">Submit</button>
          <a href="http://localhost/phplessons/public/register"  class="auth__redirect">Register</a>
        </form>
      </div>
</body>
</html>

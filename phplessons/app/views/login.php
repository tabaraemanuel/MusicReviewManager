<!DOCTYPE html>
<html lang="en">
<?php
header("Content-Type: text/html");
?>

<head>
  <title>Login</title>
  <meta charset=utf-8>
  <link rel="stylesheet" href="/phplessons/public/css/index.css">
</head>

<body>
  <div class="containerLogin">
    <div class="continutcontainerLogin">
      <div class="box">
        <h1 class="textCentrat">Login</h1>
      </div>
      <div class="box">
        <?php
        session_start();
        if (isset($_SESSION["registered"])) {
          if ($_SESSION["registered"]) {
            echo "<p>Register succesful!</p>";
            session_destroy();
          }
        }
        ?>
        <div>
          <h2 class="textCentrat">Login with your account</h2>
        </div>
        <?php
        if (isset($data['error'])) {
          $error = $data["error"];
          echo "<p>$error</p>";
        }
        ?>
        <form action="http://localhost/phplessons/public/login/loginFunc" class="auth__input__container" method="post">
          <input type='email' class="casetaInput" placeholder="Email" name="email" />
          <input class="casetaInput" type="password" placeholder="Password" name="password">
          <br>
          <div class="boxFlex">
            <button name="login-submit" class="buttonDow" type="submit">Submit</button>
          </div>
          <div class="boxFlex">
            <a href="http://localhost/phplessons/public/register" class="buttonDow2">Register page</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>
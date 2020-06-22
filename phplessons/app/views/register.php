<!DOCTYPE html>
<html lang="en">

<head>
  <title>Signup</title>
  <meta charset=utf-8>
  <link rel="stylesheet" href="css/index.css">
</head>

<body>
  <div class="containerLogin">
    <div class="continutcontainerLogin">
      <div class="box">
        <h1 class="textCentrat">Register</h1>
      </div>
      <div class="box">
        <div>
          <h2 class="textCentrat">Create your first account</h2>
        </div>
        <?php
        session_start();
        if (isset($_SESSION["registerError"])) {
          $error = $_SESSION["registerError"];
          echo "<p>$error</p>";
        }
        session_destroy();
        ?>
        <form method="POST" action="http://localhost/phplessons/public/register/registerUser" class="auth__input__container">
          <input name="uid" class="casetaInput" placeholder="Username" />
          <input name="password" type="password" class="casetaInput" placeholder="Password" />
          <input name="email" type='email' class="casetaInput" placeholder="Email adress" /><br />
          <div class="boxFlex">
            <button class="buttonDow" type="submit" name="signup_submit">Submit</button>
          </div>
          <div class="boxFlex">
            <a href="http://localhost/phplessons/public/login" class="buttonDow2">Login page</a>
          </div>

        </form>
      </div>
    </div>
  </div>
</body>

</html>
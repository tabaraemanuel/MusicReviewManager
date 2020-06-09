<!DOCTYPE html>
<html>
    <head>
    <meta charset = "utf8">
<link rel="stylesheet" href="http://localhost/phplessons/Emanuel/css/index.css">
    </head>
<body>
<div class="auth__container">
        <div class="auth__title">Login</div>
        <div class="auth__description">Login with your account</div>
        <form class="auth__input__container" action="http://localhost/phplessons/Emanuel/phpcode/controllers/loginController.php" method="post">
          <input class="auth__input" placeholder="Username" name="username" />
          <input class="auth__input" type="password" placeholder="Password" name="password" />
          <br />
          <button class="auth__submit" type="submit">Submit</button>
          <a class="auth__redirect" href="#">Forgot password?</a>
          <a class="auth__redirect" href="#/register">Register</a>
        </form>
      </div>
</body>
</html>

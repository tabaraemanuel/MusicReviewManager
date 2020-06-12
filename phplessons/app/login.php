<!DOCTYPE html>
<html>
    <head>
    <meta charset = "utf8">
<link rel="stylesheet" href="http://localhost/phplessons/public/css/index.css">
    </head>
<body>
<div class="auth__container">
        <div class="auth__title">Login</div>
        <div class="auth__description">Login with your account</div>
        <form action="http://localhost/phplessons/app/loginSytem/loginHandler.php" class="auth__input__container" method="post">
          <input type='email' class="auth__input" placeholder="Email" name="email" />
          <input class="auth__input" type="password" placeholder="Password" name="password" />
          <br />
          <button name="login-submit" class="auth__submit" type="submit">Submit</button>
          <a href="http://localhost/phplessons/app/loginSytem/signuphandler.php"  class="auth__redirect" href="#/register">Register</a>
        </form>
      </div>
</body>
</html>

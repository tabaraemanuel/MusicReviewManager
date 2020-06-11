<!DOCTYPE html>
<html>
    <head>
    <meta charset = "utf8">
<link rel="stylesheet" href="http://localhost/phplessons/public/css/index.css">
    </head>
<body>
<div class="auth__container">
        <div class="auth__title">Register</div>
        <div class="auth__description">Create your first account</div>
        <form action="http://localhost/phplessons/app/loginSytem/signuphandler.php" class="auth__input__container">
          <input name="uid" class="auth__input" placeholder="Username" />
          <input name="password" type="password" class="auth__input" placeholder="Password" />
          <input name="email" type='email' class="auth__input" placeholder="Email adress" /><br />
          <button class="auth__submit" type="submit" name="signup_submit">Submit</button>
          <a href="#/login" class="auth__redirect" href="#">Login</a>
        </form>
      </div>
</body>
</html>



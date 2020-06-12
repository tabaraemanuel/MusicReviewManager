<?php
session_start();
echo 'Helloso ' . $_SESSION['username'];
?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset = "utf8">
<link rel="stylesheet" href="http://localhost/phplessons/public/css/index.css">
</head>
<body>

<form action="http://localhost/phplessons/app/loginSytem/logoutHandler.php" class="auth__input__container" method="post">
        <button  name="logout" class="auth__submit" type="submit">Logout</button>
        </form>
</body>
</html>

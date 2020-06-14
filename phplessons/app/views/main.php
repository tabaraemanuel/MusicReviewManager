<!DOCTYPE HTML>
<?php

if(isset($data["username"])){
echo 'Helloso ' . $data['username'];
}
?>

<html>
<head>
<meta charset = "utf8">
<link rel="stylesheet" href="http://localhost/phplessons/public/css/index.css">
</head>
<body>

<form action="http://localhost/phplessons/public/logout" class="auth__input__container" method="post">
        <button  name="logout" class="auth__submit" type="submit">Logout</button>
        
</form>


<form action="http://localhost/phplessons/public/metadata" class="auth__input__container" method="post">
        <input class="auth__input" placeholder="Song title" name="song-send" />
        <br/>
        <button  name="Metadata" class="auth__submit" type="submit">Metadata</button>
</form>
</body>

</html>

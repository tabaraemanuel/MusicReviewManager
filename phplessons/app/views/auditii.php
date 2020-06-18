<!DOCTYPE html><?php header("Content-Type: text/html"); ?>
<html lang="en">

<head>
  <title>Istoric Auditii</title>
  <link rel="stylesheet" type="text/css" href="http://localhost/phplessons/public/css/Auditi.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<div class="topnav">
  <div>
    <a class="meniuleftActive" href="Main.php">Home</a>
    <a class="meniuleft" href="#">Flux Stiri</a>
    <a class="meniuleft" href="Export.php">Favorite</a>
    <a class="meniuleft" href="Auditi.php">Auditii utilizatori</a>
  </div>
  <a class="meniuright" href="#Logout">Logout</a>
</div>

<div class="continutContainter">
  <div class="continut">
    <div class="box">
      <h1 class="textCentrat">Istoric auditii</h1>
    </div>
    <?php
    $lastid = 0;
    $conn = $data['conn'];
    $sql = "SELECT * from istoric order by timestamp desc limit 5";
    $myres = array();
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
      $lastid = $row['id'];
      $songid = $row['songID'];
      $time = $row['timestamp'];
      $username = $row['username'];
      $songName = $row['songName'];
      $albumName = $row['albumName'];
      echo  '<div class="box">
          <span class="dataRightCorner">' . $time . '</span>
          <h2 class="textCentrat">' . $username . ' a ascultat <a href="http://localhost/phplessons/public/css/song/' . $songid . '" class="linkCategori">' . $songName . '</a> de pe <a href="#" class="linkCategori">' . $albumName . '</a>. </h2>
          </div>';
    }
    ?>
  </div>
</div>

</html>
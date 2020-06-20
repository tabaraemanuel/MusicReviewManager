<!DOCTYPE html><?php header("Content-Type: text/html"); ?>
<html lang="en">

<head>
  <title>Istoric Auditii</title>
  <link rel="stylesheet" type="text/css" href="http://localhost/phplessons/public/css/Auditi.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<?php include "css/men.shtml"; ?>

<div class="continutContainter">
  <div class="continut">
    <div class="box">
      <h1 class="textCentrat">Istoric auditii</h1>
    </div>
    <?php
    $lastid = 0;
    $conn = $data['conn'];
    $sql = "SELECT * from istoric order by id limit 5";
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
          <h2 class="textCentrat">' . $username . ' a ascultat <a href="http://localhost/phplessons/public/song/' . $songid . '" class="linkCategori">' . $songName . '</a> de pe <a href="#" class="linkCategori">' . $albumName . '</a>. </h2>
          </div>';
    }
    ?>
  </div>
  <script type="text/javascript">
    {
      var again = true;
      var count = document.getElementsByClassName('box');
      var lastId = count.length - 1;
      if (again) {
        window.onscroll = function() {
          if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
            if (again) {
              var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  oldid = lastId;
                  elem = document.getElementsByClassName('continut');
                  elem[0].innerHTML += this.responseText;
                  count = document.getElementsByClassName('box');
                  lastId = count.length - 1;
                  console.log(oldid, lastId)
                  if (oldid != 5 + lastId)
                    again = false;
                }
              };
              xmlhttp.open("GET", 'http://localhost/phplessons/public/utilitar/index/' + lastId, true);
              xmlhttp.send();
            }
          }
        };
      }
    }
  </script>
</div>

</html>
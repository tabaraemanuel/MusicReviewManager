<!DOCTYPE html>
<?php
header("Content-Type: text/html");
?>
<html lang=ro>
<title>Melodii inrudite</title>
<link rel="stylesheet" type="text/css" href="http://localhost/phplessons/public/css/recomandate.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>


<?php include 'css/men.shtml'; ?>



<div class="continutContainter">
  <div class="continut">

    <div class="box">
      <h2 class="textCentrat">Melodii inrudite</h2>
    </div>


    <div class="box">

      <div class="boxOrdine">
        <div class="divOrdine">
          <button class="butonOrdine">Ordoneaza:</button>
          <div class="butonOrdine-content">
            <button>Durata</button>
            <button>An</button>
            <button>Popularitate</button>
          </div>
        </div>
      </div>


      <?php
      $max = 0;
      if (isset($data)) {
        $max = count($data);
      }
      for ($i = 0; $i < $max; $i++) {
        if (!empty($data)) {
          $id = $data[$i]['id'];
          $releaseDate = $data[$i]['releaseDate'];
          $songName = $data[$i]['songName'];
          $albumName = $data[$i]['albumName'];
          $artists = $data[$i]['artists'];
          $popularity = $data[$i]['popularity'];
          $duration =  $data[$i]['duration'];
          echo '<div class="melodie">
          <a href="/phplessons/public/song/' . $id . '">' . $songName . ' - ' . $artists . ' (' . $duration . ' ms)</a>
        </div>';
        }
      }
      ?>
    </div>



  </div>
</div>

</html>
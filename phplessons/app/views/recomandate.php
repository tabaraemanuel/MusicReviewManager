<!DOCTYPE html>
<?php
header("Content-Type: text/html");
if (isset($data['camp']) && isset($data['arr']) && (count($data['arr']) > 0)) {
  $camp = $data['camp'];
  $value = $data['arr'][0][$camp];
  $value = preg_replace('/\s+/', '_', $value);
}
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
            <a href="http://localhost/phplessons/public/recomandate/index/<?php echo isset($camp) ? $camp : " " ?>/<?php echo isset($value) ? $value : " " ?>/duration">Durata</a>
            <a href="http://localhost/phplessons/public/recomandate/index/<?php echo isset($camp) ? $camp : " " ?>/<?php echo isset($value) ? $value : " " ?>/releaseDate">An</a>
            <a href="http://localhost/phplessons/public/recomandate/index/<?php echo isset($camp) ? $camp : " " ?>/<?php echo isset($value) ? $value : " " ?>/popularity">Popularitate</a>
          </div>
        </div>
      </div>


      <?php
      $max = 0;
      if (isset($data['arr'])) {
        $max = count($data['arr']);
      }
      for ($i = 0; $i < $max; $i++) {
        if (!empty($data['arr'])) {
          $id = $data['arr'][$i]['id'];
          $releaseDate = $data['arr'][$i]['releaseDate'];
          $songName = $data['arr'][$i]['songName'];
          $albumName = $data['arr'][$i]['albumName'];
          $artists = $data['arr'][$i]['artists'];
          $popularity = $data['arr'][$i]['popularity'];
          $duration =  $data['arr'][$i]['duration'];
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
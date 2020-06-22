<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  header("Content-Type: text/html");
  ?>


  <title>Main</title>
  <link rel="stylesheet" type="text/css" href="http://localhost/phplessons/public/css/Main.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>

  </style>
</head>
<?php include "css/men.shtml"; ?>

<form action="http://localhost/phplessons/public/metadata" class="auth__input__container" method="POST">
  <input class="auth__input" placeholder="Song id" name="meta-send" />
  <br />
  <button name="Metadata" class="auth__submit" type="submit">Metadata</button>
</form>
<div class="continutContainter">
  <div class="continut">
    <div class="box">
      <h1 class="textCentrat">Music Review Manager</h1>
    </div>


    <div class="box">
      <h2 class="textCentrat">Top 5 cele mai apreciate melodii</h2>

    </div>


    <div class="boxFlex">

      <?php
      $max = 0;
      if (isset($data['popular'])) {
        $max = count($data['popular']);
      }
      for ($i = 0; $i < $max; $i++) {
        if (!empty($data['popular'])) {
          $id = $data['popular'][$i]['id'];
          $releaseDate = $data['popular'][$i]['releaseDate'];
          $songName = $data['popular'][$i]['songName'];
          $albumName = $data['popular'][$i]['albumName'];
          $artists = $data['popular'][$i]['artists'];
          $songImage = $data['popular'][$i]['songImage'];
          $genre = $data['popular'][$i]['genre'];
          $popularity = $data['popular'][$i]['popularity'];
          $albumNamesec = preg_replace('/\s+/', '_', $albumName);
          $artistssec = preg_replace('/\s+/', '_', $artists);
          $genresec = preg_replace('/\s+/', '_', $genre);
          echo '<div class="boxMargin">
      <a href="Song.php" class="linkCategori"> <img class="coverRecenzie" src="' . $songImage . '" alt="user"></a>
      <p class="textCentrat">
        Melodie:<a href="song/' . $id . '" class="linkCategori">' . $songName . '</a> <br>
        Album:<a href="/phplessons/public/recomandate/index/albumName/' . $albumNamesec . '" class="linkCategori"> ' . $albumName . '</a> <br>
        Artist:<a href="/phplessons/public/recomandate/index/artists/' . $artistssec . '" class="linkCategori">' . $artists . '</a><br>
        Categorie:<a href="/phplessons/public/recomandate/index/genre/' . $genresec . '" class="linkCategori">' . $genre . '</a> <br>
        An:<a class="linkCategori"> ' . $releaseDate . '</a> <br>
      </p>
    </div>';
        }
      }
      ?>
    </div>

    <div class="box">
      <h2 class="textCentrat">Albume noi</h2>
    </div>
    <div class="boxFlex">
      <?php
      $max = 0;
      if (isset($data['album'])) {
        $max = count($data['album']);
      }
      for ($i = 0; $i < $max; $i++) {
        if (!empty($data['album'])) {
          $releaseDate = $data['album'][$i]['releaseDate'];
          $albumName = $data['album'][$i]['albumName'];
          $artists = $data['album'][$i]['artistName'];
          $image = $data['album'][$i]['image'];
          $albumNamesec = preg_replace('/\s+/', '_', $albumName);
          $artistssec = preg_replace('/\s+/', '_', $artists);
          echo '<div class="boxMargin">
          <a href="Song.php" class="linkCategori"> <img class="coverRecenzie" src="' . $image . '" alt="user"></a>
          <p class="textCentrat">
            Album:<a href="/phplessons/public/recomandate/index/albumName/' . $albumNamesec . '" class="linkCategori"> ' . $albumName . '</a> <br>
            Artist:<a href="/phplessons/public/recomandate/index/artists/' . $artistssec . '" class="linkCategori">' . $artists . '</a><br>
            An:<a class="linkCategori"> ' . $releaseDate . '</a> <br>
          </p>
        </div>';
        }
      }
      ?>


    </div>

    <div class="box">
      <h2 class="textCentrat">Melodii noi</h2>

    </div>
    <div class="boxFlex">
      <?php
      $max = 0;
      if (isset($data['recent'])) {
        $max = count($data['recent']);
      }
      for ($i = 0; $i < $max; $i++) {
        if (!empty($data['recent'])) {
          $id = $data['recent'][$i]['id'];
          $releaseDate = $data['recent'][$i]['releaseDate'];
          $songName = $data['recent'][$i]['songName'];
          $albumName = $data['recent'][$i]['albumName'];
          $artists = $data['recent'][$i]['artists'];
          $songImage = $data['recent'][$i]['songImage'];
          $genre = $data['recent'][$i]['genre'];
          $popularity = $data['recent'][$i]['popularity'];
          $albumNamesec = preg_replace('/\s+/', '_', $albumName);
          $artistssec = preg_replace('/\s+/', '_', $artists);
          $genresec = preg_replace('/\s+/', '_', $genre);
          echo '<div class="boxMargin">
          <a href="Song.php" class="linkCategori"> <img class="coverRecenzie" src="' . $songImage . '" alt="user"></a>
          <p class="textCentrat">
            Melodie:<a href="song/' . $id . '" class="linkCategori">' . $songName . '</a> <br>
            Album:<a href="/phplessons/public/recomandate/index/albumName/' . $albumNamesec . '" class="linkCategori"> ' . $albumName . '</a> <br>
            Artist:<a href="/phplessons/public/recomandate/index/artists/' . $artistssec . '" class="linkCategori">' . $artists . '</a><br>
            Categorie:<a href="/phplessons/public/recomandate/index/genre/' . $genresec . '" class="linkCategori">' . $genre . '</a> <br>
            An:<a class="linkCategori"> ' . $releaseDate . '</a> <br>
          </p>
        </div>';
        }
      }
      ?>
    </div>

    <div class="box">
      <h1 class="textCentrat">Descarca Statistici:</h1>
      <br>
      <br>
      <div class="boxFlexGol">
        <a href="/phplessons/public/main/getcsv" class="buttonDowL">Format CSV</a>
        <a href="/phplessons/public/main/getpdf" class="buttonDowR">Format PDF</a>
      </div>
    </div>
  </div>
</div>

</html>
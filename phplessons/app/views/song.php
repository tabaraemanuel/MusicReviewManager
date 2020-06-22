<!DOCTYPE html>
<?php

if (!empty($data['data'])) {
  $id = $data['data']['id'];
  $releaseDate = $data['data']['releaseDate'];
  $songName = $data['data']['songName'];
  $albumName = $data['data']['albumName'];
  $artists = $data['data']['artists'];
  $songImage = $data['data']['songImage'];
  $genre = $data['data']['genre'];
  $popularity = $data['data']['popularity'];
  $albumNamesec = preg_replace('/\s+/', '_', $albumName);
  $artistNamesec = preg_replace('/\s+/', '_', $artists);
  $genresec = preg_replace('/\s+/', '_', $genre);
}
header("Content-Type: text/html");
?>
<html lang=ro>

<head>
  <title>Melodie</title>
  <link rel="stylesheet" type="text/css" href="http://localhost/phplessons/public/css/Song.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <?php include "css/men.shtml"; ?>
  <div class="continutContainter">
    <div class="continut">
      <div class="box">
        <h2 class="textCentrat"><?php echo (isset($songName)) ? $songName : ''; ?> </h2>
      </div>
      <div class="box">
        <img class="cover" src="<?php echo (isset($songImage)) ? $songImage : ''; ?>" alt="AlbumCover">

        <p class="textCentrat">
          Artist:<a href="/phplessons/public/recomandate/index/artists/<?php echo (isset($artistNamesec)) ? $artistNamesec : ''; ?>" class="linkCategori"> <?php echo (isset($artists)) ? $artists : ''; ?></a><br>
          Categorie:<a href="/phplessons/public/recomandate/index/genre/<?php echo (isset($genresec)) ? $genresec : ''; ?>" class="linkCategori"> <?php echo (isset($genre)) ? $genre : ''; ?></a> <br>
          An:<a class="linkCategori"> <?php echo (isset($releaseDate)) ? $releaseDate : ''; ?></a> <br>
          Album:<a href="/phplessons/public/recomandate/index/albumName/<?php echo (isset($albumNamesec)) ? $albumNamesec : ''; ?>" class="linkCategori"> "<?php echo (isset($albumName)) ? $albumName : ''; ?>"</a> <br>
          Popularitate:<?php echo (isset($popularity)) ? $popularity : ''; ?>


        </p>
      </div>
      <div class="box">
        <?php
        if (isset($id)) {
          echo '<form action="http://localhost/phplessons/public/metadata" class="auth__input__container" method="POST">
    <input hidden class="auth__input" name="meta-send" value=' . '\'' . $id . '\'' . ' />
    <br/>
    <button  name="Metadata"  type="submit">Metadata</button>
</form> <br>';
        } ?>
      </div>

      <div class="box">
        <div>
          <form action="http://localhost/phplessons/public/song/sendComment/<?php echo (isset($id)) ? $id : 0; ?>" class="auth__input__container" method="POST">
            <input readonly class="inputNume" type="text" name="fname" value="<?php echo (isset($_SESSION['username'])) ? $_SESSION['username'] : ''; ?>">
            <input class="inputNota" type="number" min=1 max=5 name="fnota" value=1>
            <br>
            <br>
            <textarea rows="4" name="content" Placeholder="Spuneti parerea aici."></textarea>
            <br><br>
            <button name="comment-submit" class="buttonTrimitere" type="submit">Trimite</button>
          </form>
        </div>
        <?php
        if (isset($_SESSION['username'])) {
          if (isset($data['comments'])) {
            $leng = count($data['comments']);
            for ($i = 0; $i < $leng; $i++) {
              echo '
      <div class="box">
      <div class="box2PentruRating">
        <div class="nameComentariu">' . $data['comments'][$i]['username'] . '<br>';
              $rating = $data['comments'][$i]['rating'];
              echo '<p class="rating">';
              for ($fs = 0; $fs < 5; $fs++) {
                if ($fs < $rating) {
                  echo '<span class="fa fa-star checked"></span>';
                } else {
                  echo '<span class="fa fa-star"></span>';
                }
              }

              echo '</p></div>

            <div class="comentariu">
              <span class="comentariu">' . $data['comments'][$i]['content'] .
                '</span>
            </div>
        
          </div>
      </div>
      ';
            }
          }
        }

        ?>
      </div>
    </div>
  </div>
</body>

</html>
<!DOCTYPE html>
<?php
header("Content-Type: text/html");
?>
<html lang=ro>

<head>
  <title>Admin</title>
  <link rel="stylesheet" type="text/css" href="/phplessons/public/css/Admin.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>


<?php include 'css/men.shtml'; ?>


<div class="continutContainter">
  <div class="continut">


    <div class="box">
      <h1 class="textCentrat">Admin</h1>
    </div>



    <div class="box">
      <h2 class="textCentrat">Sterge utilizator</h2><br>
      <div class="boxMargin">
        <?php
        if (!empty($data)) {
          if (!empty($data['users'])) {
            $count = count($data['users']);
            $users = $data['users'];
            for ($j = 0; $j < $count; $j++) {
              echo '<div class="numeU">
                    <span class="textNumeU">' . $users[$j]['username'] . '</span><a href="/phplessons/public/admin/deleteusers/' . $users[$j]['username'] . '" class="butonStergere"><i class="fa fa-trash"></i> Sterge</a>
                  </div> ';
            }
          }
        }
        ?>
      </div>
    </div>


    <div class="box">
      <h2 class="textCentrat">Adauga album</h2><br>
      <div class="boxMargin">

        <div class="textMetadate">

          <form action="http://localhost/phplessons/public/admin/saveAlbum" method="POST">
            AlbumName: <input class="casetaMetadate" type="text" name="album"><br>
            ReleaseDate: <input class="casetaMetadate" type="date" name="release"> <br>
            Artists: <input class="casetaMetadate" type="text" name="artists"><br>
            AlbumImageURL: <input class="casetaMetadate" type="url" name="image"> <br>
            <br>
            <button class="buttonTrimitere" type="submit">Salveaza</button>
          </form>

        </div>
      </div>
    </div>


    <div class="box">
      <h2 class="textCentrat">Adauga melodie</h2><br>
      <div class="boxMargin">

        <div class="textMetadate">

          <form action="http://localhost/phplessons/public/admin/saveSong" method="POST">
            ReleaseDate: <input class="casetaMetadate" type="date" name="release"> <br>
            SongName: <input class="casetaMetadate" type="text" name="song"><br>
            AlbumName: <input class="casetaMetadate" type="text" name="album"><br>
            Artists: <input class="casetaMetadate" type="text" name="artists"><br>
            AlbumImageURL: <input class="casetaMetadate" type="url" name="imageURL"> <br>
            Genre:<input class="casetaMetadate" type="text" name="genre"><br>
            Adnotari:<input class="casetaMetadate" type="text" name="adnotari"><br>
            Isrc:<input class="casetaMetadate" type="number" name="isrc"><br>
            <label>Duration:</label>
            <input class="casetaMetadate" type="number" name="duration" min="0" placeholder="Milisecunde"> <br>
            <button class="buttonTrimitere" type="submit">Salveaza</button>

          </form>

        </div>
      </div>
    </div>


    <div class="box">
      <h2 class="textCentrat">Bara Sql</h2><br>
      <div class="boxMargin">

        <div class="textSql">

          <form action="http://localhost/phplessons/public/admin/execsql" method="POST">

            <textarea class="casetaSQl" name="sqlCommmand" rows="3" cols="50" placeholder="Intorduceti comanda sql:">
  </textarea>
            <button class="buttonExecuta" type="submit">Executa</button>


          </form>
        </div>
        <pre class="rezultat">



 <?php

  if (isset($data['sqlrez'])) {
    print_r(array_values($data['sqlrez']));
  }


  if (!empty($data['msg'])) {

    $msg = $data['msg'];
    $msg = str_replace('_', ' ', $msg);
    echo  "Rezultat " . $msg;
  } ?></pre>

      </div>
    </div>






  </div>
</div>

</html>
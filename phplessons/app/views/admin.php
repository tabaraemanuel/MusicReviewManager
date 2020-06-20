<!DOCTYPE html>
<?php
header("Content-Type: text/html");
?>
<html lang=ro>

<head>
  <title>Admin</title>
  <link rel="stylesheet" type="text/css" href="css/Admin.css">
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

        <div class="numeU">
          <span class="textNumeU"> Numele Contului </span><a class="butonStergere"><i class="fa fa-trash"></i> Sterge</a>
        </div>

        <div class="numeU">
          <span class="textNumeU"> Numele Contului </span><a class="butonStergere"><i class="fa fa-trash"></i> Sterge</a>
        </div>
        <div class="numeU">
          <span class="textNumeU"> Numele Contului </span><a class="butonStergere"><i class="fa fa-trash"></i> Sterge</a>
        </div>
        <div class="numeU">
          <span class="textNumeU"> Numele Contului </span><a class="butonStergere"><i class="fa fa-trash"></i> Sterge</a>
        </div>
      </div>
    </div>


    <div class="box">
      <h2 class="textCentrat">Adauga album</h2><br>
      <div class="boxMargin">

        <div class="textMetadate">

          <form>
            AlbumName: <input class="casetaMetadate" type="text" name="sname"><br>
            ReleaseDate: <input class="casetaMetadate" type="date" name="birthday"> <br>
            Artists: <input class="casetaMetadate" type="text" name="sname"><br>
            AlbumImageURL: <input class="casetaMetadate" type="url" name="imageURL"> <br>
            Genre:<input class="casetaMetadate" type="text" name="sname"><br>

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

          <form>
            Explicit: <input class="casetaMetadate" type="text" name="explicit"><br>
            Id: <input class="casetaMetadate" type="text" name="id"><br>
            ReleaseDate: <input class="casetaMetadate" type="date" name="birthday"> <br>
            SongName: <input class="casetaMetadate" type="text" name="sname"><br>
            AlbumName: <input class="casetaMetadate" type="text" name="sname"><br>
            Artists: <input class="casetaMetadate" type="text" name="sname"><br>
            AlbumImageURL: <input class="casetaMetadate" type="url" name="imageURL"> <br>
            Genre:<input class="casetaMetadate" type="text" name="sname"><br>
            Adnotari:<input class="casetaMetadate" type="text" name="sname"><br>
            Isrc:<input class="casetaMetadate" type="number" name="sname"><br>
            <label>Duration:</label>

            <input class="casetaMetadate" type="number" name="quantity" min="0" placeholder="Milisecunde"> <br>
            <button class="buttonTrimitere" type="submit">Salveaza</button>

          </form>

        </div>
      </div>
    </div>


    <div class="box">
      <h2 class="textCentrat">Bara Sql</h2><br>
      <div class="boxMargin">

        <div class="textSql">

          <form>

            <textarea class="casetaSQl" name="sqlComand" rows="3" cols="50" placeholder="Intorduceti comanda sql:">
  </textarea>
            <button class="buttonExecuta" type="submit">Executa</button>


          </form>
        </div>
        <pre class="rezultat">Rezultat
mere</pre>

      </div>
    </div>






  </div>
</div>

</html>
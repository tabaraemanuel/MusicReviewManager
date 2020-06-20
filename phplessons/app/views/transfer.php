<!DOCTYPE html>
<?php
header("Content-Type: text/html");
?>
<html>

<head>
  <title>Album</title>
  <link rel="stylesheet" type="text/css" href="css/Transfer.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<?php include 'css/men.shtml'; ?>
<div class="continutContainter">
  <div class="continut">
    <div class="box">
      <h1 allign="center">Favorite</h1>
    </div>
    <div class="box">
      <div class="boxOrdine">
        <div class="divOrdine">
          <button class="butonOrdine">Ordoneaza:</button>
          <div class="butonOrdine-content">
            <button>Durata</button>
            <button>An</button>
            <button>Popularity</button>
          </div>
        </div>
      </div>

      <?php
      if (!empty($data)) {
        $count = count($data);
        for ($repeat = 0; $repeat < $count; $repeat++) {
          $id = $data[$repeat]['id'];
          $song = $data[$repeat]['song'];
          $creator = $data[$repeat]['creator'];
          echo '<div class="melodie">
  <a class="fullDiv">' . $song . '-' . $creator . '</a>
</div>';
          if ($id != -1) {
            echo '<form action="http://localhost/phplessons/public/metadata" class="auth__input__container" method="POST">
    <input hidden class="auth__input" name="meta-send" value=' . '\'' . $id . '\'' . ' />
    <br/>
    <button  name="Metadata" class=\"auth__submit" type="submit">Metadata</button>
</form> <br>';
          }
        }
      }
      ?>
      <br>
      <label for="file-upload" class="buttonTrimitereleft">
        Importa o lista noua
      </label>
      <form enctype="multipart/form-data" method="POST" action="http://localhost/phplessons/public/transfer/import" class="auth__input__container">
        <input type="hidden" name="MAX_FILE_SIZE" value="10000" />
        <input id="file-upload" type="file" name="file-send" />
        <button class="buttonTrimitereleftCumargine" type="submit" name="import-submit">Submit</button>
      </form>
      <a href="http://localhost/phplessons/public/transfer/export" class="buttonTrimitere">Exporta lista</a>
      <br>
    </div>
  </div>
</div>

</html>
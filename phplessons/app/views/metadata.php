<!DOCTYPE html>
<?php
        if(!empty($data)){
              $id = $data[0]['id']; 
              $isExplicit = $data[0]['isExplicit'];
              $releaseDate = $data[0]['releaseDate'];
              $songName = $data[0]['songName'];
              $albumName = $data[0]['albumName'];
              $artists = $data[0]['artists'];
              $addedAt = $data[0]['addedAt'];
              $albumImageURL = $data[0]['albumImageURL'];
              $genre = $data[0]['genre'];
              $duration = $data[0]['duration'];
              $annotations = $data[0]['addonations'];
              $isrc = $data[0]['isrc'];
              $popularity = $data[0]['popularity'];
         }
         header("Content-Type: text/html");
?> 
<html lang="en">
<head>
  <meta charset="utf=8">
  <title>Album</title>
<link rel="stylesheet" type="text/css" href="http://localhost/phplessons/public/css/Metadata.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="topnav">
<div >
  <a class="meniuleftActive" href="#home">Home</a>
  <a class="meniuleft" href="#2">Flux Stiri?</a>
  <a class="meniuleft" href="#3">Exporta/Importa</a>
  <a class="meniuleft" href="#4">Favorite</a>
  <a class="meniuleft" href="Friends.php">Prieteni/Grupuri</a>
   <a class="meniuleft" href="#6">Cautare</a>
</div>
 <a class="meniuright" href="http://localhost/phplessons/public/logout">Logout</a>
</div>

<div class="continutContainter">
<div class="continut">
<div class="box">
<h1 allign="center">Metadata</h1> 
</div>
<div class="box">
<div class="textMetadate">
<form action="http://localhost/phplessons/public/metadata/save" class="auth__input__container" method="post">
    Explicit: <br>    <input style="margin-top: 12px;  margin-bottom: 11px ;" type="radio" id="t" name="expicit" value="T" >
  <label for="T">T</label>
  <input type="radio" id="f" name="expicit" value="F">
  <label for="F">F</label><br>
    SongID : <input type="text" class="casetaMetadate" name="id" value="<?php echo (isset($id))?$id:'';?>" readonly><br>
    ReleaseDate:   <input value="<?php echo (isset($releaseDate))?$releaseDate:'';?>" class="casetaMetadate" type="date" id="birthday" name="release">  <br>
    SongName:      <input value="<?php echo (isset($songName))?$songName:'';?>" class="casetaMetadate" type="text"  name="song"><br>
    AlbumName:     <input value="<?php echo (isset($albumName))?$albumName:'';?>" class="casetaMetadate" type="text" name="album"><br> 
    Artists:       <input value="<?php echo (isset($artists))?$artists:'';?>" class="casetaMetadate" type="text" name="artists"><br> 
    AddedAt:       <input value="<?php echo (isset($addedAt))?$addedAt:'';?>" class="casetaMetadate" type="date" id="birthday" name="added"> <br>
    AlbumImageURL: <input value="<?php echo (isset($albumImageURL))?$albumImageURL:'';?>" class="casetaMetadate" type="url" id="imageURL" name="imageURL"> <br>
    Genre:<input value="<?php echo (isset($genre))?$genre:'';?>" class="casetaMetadate" type="text"  name="genre"><br> 
   <label for="quantity">Duration:</label> <input class="casetaMetadate" type="number" id="quantity" name="duration" value="<?php echo (isset($duration))?$duration:'';?>" placeholder="Milliseconds">
   <button name="meta-submit" class="buttonTrimitere" type="submit">Save</button>      
</form>     
</div>
</div>
</div>
</div>
</body>
</html>
<!DOCTYPE html>
<?php
header("Content-Type: text/html");
?>
<html>
<head>
  <title>Album</title>
<link rel="stylesheet" type="text/css" href="Album.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    body{
margin: 0;
color: white;
 background-color: #6a62d2;
}
.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}



.meniuleft{
 float: left;
  border-right: 2px solid black;
  
}

.meniuleftActive{
 float: left;
 background-color: #1c1d22
;
 border-right: 2px solid black;
  color: white;
}

.meniuright{
  float: right;
   border-left: 2px solid black;
 
}
.continut
{
	
    margin-top: 15px;
    margin-bottom: 40px;
	padding-right: 20px;
    padding-left: 20px;
    background: #171717;
    padding-top: 20px;
    padding-bottom: 10px;
    border: 1px solid #323232;
    box-shadow: 2px 2px 5px rgb(0, 0, 0);
    border-radius: 7px;
}

.continutContainter
{   padding-right: 20px;
    padding-left: 20px;
    margin-right: auto;
    margin-left: auto;
	display: block;
}
.box
{    background-color: #1c1d22;
    padding: 15px;
    border: 1px solid #323232;
    box-shadow: 2px 2px 5px rgb(0, 0, 0);
    overflow:auto;
    clear: both;
    margin: 0 0 10px;
	border-radius: 7px;
	
}
.box2PentruRating
{     display:inline;
}
.melodie
{
	 background-color:  #404040;
	border-radius: 3px;
	margin-top: 15px;
	padding: 10px;
}
.melodie:hover
{
	 background-color:  #595959;
	 color: #ffffff;
	
}

.melodie a
{   color: white;
	text-decoration: none;
}
textarea{
	padding: 10px;
	resize: vertical;
	height: auto;
	margin: 15px;
	width: 97%;
	border-radius: 6px;
}
.inputNume
{    
	border-radius: 3px;
	padding: 3px;
}
.inputNota
{   float: right;
	border-radius: 3px;
	padding: 3px;
}
.nameComentariu
{
	font-size: 25 px;
}
.comentariu
{  
 margin-top: 10px;
	text-align: justify;
}
.imagineUser
{
	 width: 50px;
	  height:48px;
	 border-radius: 50px;
	 vertical-align:middle;
	 margin-right:7 px;
	 margin-bottom: 10px;
}
.rating
{
 margin-top: 15px;
 margin-right:30px;
 float:right;

}
.checked {
  color: orange;
}
.cover {
 display: block;
  margin-left: auto;
  margin-right: auto;
  width: 30%;
}
.buttonTrimitere
{
	float: right;
	border-radius: 8px;
	background-color: #4169E1;
	text-align: center;
  text-decoration: none;
	color: white;
  padding: 15px 32px;
}
.buttonTrimitereleft
{
	float: left;
	border-radius: 8px;
	background-color: #4169E1;
	text-align: center;
  text-decoration: none;
	color: white;
  padding: 15px 32px;
}
.buttonTrimitereleftCumargine
{   margin-left: 10px;
	float: left;
	border-radius: 8px;
	background-color: #4169E1;
	text-align: center;
  text-decoration: none;
	color: white;
  padding: 15px 32px;
}
.linkCategori
{
	text-decoration:none;
	color: white;
}
.fullDiv
{
	width:inherit;
}
.coverRecenzie
{  float: left;
display: block;
 margin-right: 20px;
  width: 10%;
  
	
}
.boxRecenziePrieten
{  padding-right: 20px;
    padding-left: 20px;
	margin-bottom: 30px;
	
}
.textCategoriRecenzie
{   
   font-size: 150%;
}
.textMetadate
{
	text-align: left;
	font-size:24px ;
}
.casetaMetadate
{
	width: 100%;
  padding: 10px 10px;
  margin-top: 9px ;
   margin-bottom: 9px ;
  border-radius: 10px;
  	font-size:15px ;
}
.buttonMetadate
{
	float: right;
	background-color: black;
	padding: 4px 8px  4px 8px;
	border-radius: 10px;
	  text-align: center;

}
input[type="file"] {
    display: none;
}
    </style>
</head>


<div class="topnav">
<div >
  <a class="meniuleftActive" href="#home">Home</a>
  <a class="meniuleft" href="#2">Flux Stiri?</a>
  <a class="meniuleft" href="#3">Exporta/Importa</a>
  <a class="meniuleft" href="#4">Favorite</a>
  <a class="meniuleft" href="Friends.php">Prieteni/Grupuri</a>
   <a class="meniuleft" href="#6">Cautare</a>
</div>
 <a class="meniuright" href="#Logout">Logout</a>
</div>
<div class="continutContainter">
<div class="continut">
<div class="box">
<h1 allign="center">Favorite</h1> 
</div>
<div class="box">
<?php
if(!empty($data)){
$count = count($data);
for($repeat = 0; $repeat < $count;$repeat++){
$id = $data[$repeat]['id'];
$song = $data[$repeat]['song'];
$creator = $data[$repeat]['creator'];
echo '<div class="melodie">
  <a class="fullDiv">' . $song .'-'. $creator .'</a>
</div>';
if($id!=-1){
  echo '<form action="http://localhost/phplessons/public/metadata" class="auth__input__container" method="POST">
    <input hidden class="auth__input" name="meta-send" value=' . '\'' . $id . '\''. ' />
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
<form enctype="multipart/form-data"  method="POST" action="http://localhost/phplessons/public/transfer/import" class="auth__input__container">
  <input type="hidden" name="MAX_FILE_SIZE" value="10000" />
  <input id="file-upload" type="file" name="file-send"/> 
<button class="buttonTrimitereleftCumargine" type="submit" name="import-submit">Submit</button>
</form>
  <a href="http://localhost/phplessons/public/transfer/export" class="buttonTrimitere">Exporta lista</a>
  <br>
</div>
</div>
</div>
</html>
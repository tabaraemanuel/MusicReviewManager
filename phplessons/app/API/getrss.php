<?php
//generates rss feed
// Create connection
$servername = "localhost";
$dbusername = "root";
$dbpass = "";
$databse = "proiect";
$conn = mysqli_connect($servername, $dbusername, $dbpass, $databse);
// Check connection
if (mysqli_connect_errno($conn)) {
    echo "Database connection failed!: " . mysqli_connect_error();
}
$sql = 'SELECT * FROM events ORDER BY ID desc limit 5';
$result = mysqli_query($conn, $sql);

header("Content-type: text/xml");

echo "<?xml version='1.0' encoding='UTF-8'?>
 <rss version='2.0'>
 <channel>
 <title> RSS feed</title>
 <link>/</link>
 <description>Cloud RSS</description>
 <language>en-us</language>";


while ($row = mysqli_fetch_assoc($result)) {
    $content = $row['content'];
    $date = $row['date'];
    $link = $row['link'];
    echo "<item>
   <title>$content</title>
   <description>$date</description>
   <link>$link</link>
   </item>";
}
echo "</channel></rss>";

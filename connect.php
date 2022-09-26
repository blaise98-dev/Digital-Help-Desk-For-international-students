<?php
/* Local Database*/

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "online-admission";

//$servername = "localhost";
//$username = "dailyear_root11";
//$password = "dailyearnings123456789";
//$dbname = "dailyear_dailyearnings";


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?> 
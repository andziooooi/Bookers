<?php
$hostName = "localhost";
$dbUser = "root";
$dbPass="";
$dbName="wypozyczalnia";
$conn = mysqli_connect($hostName, $dbUser, $dbPass, $dbName);
if(!$conn){
    die("Coś poszło nie tak");
}
?>
<?php
$host="localhost";
$user ="root";
$pass ="";
$db ="booksdb";

$conn = new mysqli($host, $user, $pass, $db);

if($conn->connect_error){
    die("CONNECTION FAILED: " . $conn->connect_error);
}
?>
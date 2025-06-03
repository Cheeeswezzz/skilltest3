<?php
<<<<<<< HEAD
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "bookdb";

    $conn = new mysqli($host, $user, $pass, $db);

    if($conn->connect_error){
        die("CONNECTION FAILED: " . $conn->connect_error);
    }
=======
$host="localhost";
$user ="root";
$pass ="";
$db ="booksdb";

$conn = new mysqli($host, $user, $pass, $db);

if($conn->connect_error){
    die("CONNECTION FAILED: " . $conn->connect_error);
}
>>>>>>> e8c707042d86c095c4ee48ebb5304133f6f3696a
?>
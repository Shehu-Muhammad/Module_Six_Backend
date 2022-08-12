<?php
//4 parameters needed to connect to database
//servername, username, password, database name
//database servername should be equal to server name of the database
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "root";
$dbName = "movies_module_six";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

if( mysqli_connect_errno() ) {
    exit(" Database connection error!!!!");
}

// echo ("Connection to the database was succesful!");

?>
<?php

$hostname = 'localhost';
$user = 'root';
$pass = '';
$db = 'yt-database';

$conn=mysqli_connect($hostname, $user, $pass, $db);

if(!$conn){
    die(mysqli_error($conn));
}

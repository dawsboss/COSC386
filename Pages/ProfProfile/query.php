<?php

$connect=@mysqli_connect('localhost', 'bforsythe2', 'Bstar$123', 'SUResearchProjDB');

$query = "SELECT * FROM Professor WHERE Name = 'Joseph Anderson'");

$name = mysqli_query($connect, $query);
$user = mysqli_fetch_array($name);

session_start();
$_SESSION['user'] = $user['Name'];

mysqli_close($connect);
?>

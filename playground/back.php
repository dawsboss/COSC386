<?php

if( $connect = @mysqli_connect('localhost', 'gdawson1', 'gdawson1','SUResearchProjDB') ){
}

$jtaquery = 'SELECT * FROM Professor WHERE Name="Joseph Anderson"';
$jtasql = mysqli_query($connect, $jtaquery);
$jta = mysqli_fetch_array($jtasql);

session_start();
$_SESSION['user'] = $jta;

mysqli_close($connect);
?>

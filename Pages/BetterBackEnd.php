<?php

if( $connect = @mysqli_connect('localhost', 'bmason3', 'bmason3','SUResearchProjDB') ){
  //echo "<h1>Connect</h1>";
}
session_start();
#init session vars
$_SESSION['logged'] = "null";
$_SESSION['admin'] = 0;
$profile = null;

#Search Page Quering
#To use: Make the href have ?q=VAR1&f=VAR2
#Returns: A query p in Professor table where VAR2 like %VAR1%
# search - An array of tuples and all attributes
if((isset($_GET["q"]) || isset($_GET["f"])) && $_GET["q"] && $_GET["f"]){
#SEARCHING STUFF
  $data = null;
  $search=[];
  $Sfilter = mysqli_real_escape_string($connect,$_GET["f"]);
  $Squestion = mysqli_real_escape_string($connect,$_GET["q"]);
  $Squery = "SELECT * FROM Professor WHERE $Sfilter LIKE \"%$Squestion%\"";
  $Ssql = mysqli_query($connect, $Squery);
  while($data = mysqli_fetch_array($Ssql)){
    array_push($search, $data);
  }
}
mysqli_close($connect);
?>
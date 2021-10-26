<?php

if( $connect = @mysqli_connect('localhost', 'gdawson1', 'gdawson1','SUResearchProjDB') ){
  echo "<p>Connect</p>";
}

//if ( count($_POST) > 0 ){
  //echo "DO THE STUFF TO UPDATE PROFESSOR " . $_POST['id'] . " to have name " . $_POST['name'] . "<br>";
  //echo "UPDATE SUCCESSFUL, here is a link to go home: <a href='google.com'>HOME</a><br>";
  //header('Location: http://www.google.com');
  //exit;
//}

$data = null;
$search=[];
if((isset($_GET["q"]) || isset($_GET["f"])) && $_GET["q"] && $_GET["f"]){
  $filter = mysqli_real_escape_string($connect,$_GET["f"]);
  $question = mysqli_real_escape_string($connect,$_GET["q"]);
  $query = "SELECT * FROM Professor WHERE $filter LIKE \"%$question%\"";
  print("$query");
  $sql = mysqli_query($connect, $query);
  while($data = mysqli_fetch_array($sql)){
    array_push($search, [$data]);
  }
  //print_r($search);
  //print("End of func");
}

//echo "DATA IS " . json_encode($data);

mysqli_close($connect);
?>

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
  $sql = mysqli_query($connect, $query);
  while($data = mysqli_fetch_array($sql)){
    array_push($search, $data);
  }



/*$query = "SELECT * FROM Professor WHERE ? LIKE \"%?%\"";
  if($stmt = mysqli_prepare($connect, $query)){
    print("Quering");
    mysqli_stmt_bind_param($stmt,'ss', $_GET["f"], $_GET["q"]);
    print_r($stmt);
    mysqli_stmt_execute($stmt);
    print_r($stmt);
    mysqli_stmt_bind_result($stmt, $Name, $Email, $DeptName, $SchoolName, $RS, $Website, $Aval, $Bio, $PhoneNum);
    print_r($stmt);
    while($data = mysqli_stmt_fetch($stmt)){
      print("while loop");
      array_push($search, [$Name,$Email,$DeptName,$SchoolName,$RS,$Website,$Aval,$Bio,$phoneNum]);
      #array_push($search, [$data]);
    }
    print_r($search);
    mysqli_stmt_close($stmt);
  }*/
  //print_r($search);
  //print("End of func");
}

//echo "DATA IS " . json_encode($data);

mysqli_close($connect);
?>

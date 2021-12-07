<!DOCTYPE html>
<html>
<head>
<!--<link rel="stylesheet" href="style.css?v=<?php //echo time();?>" type="text/css"/>-->
<link rel="stylesheet" href="style.css"/>
<meta name="viewport" content="width=device-width, initial scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link href="../../dist/css/bootstrap.min.css" rel="stylesheet">
<style>
.alert-fixed {
    position:fixed; 
    top: 0px; 
    left: 0px; 
    width: 100%;
    z-index:9999; 
    border-radius:0px;
}
.my-custom-scrollbar {
position: relative;
height: 300px;
overflow: auto;
}
.table-wrapper-scroll-y {
display: block;
}
</style>
<!-- <style>
.button{
  background-color:#910101;
  color: #ffffff;
  padding: 15px 15px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  border-radius: 17%;
}
.button:hover{
        color=#ffffff;
        background-color: #b00000;
}
</style> -->
  <title>Admin Edit <?php echo $_POST['table'];?></title>
</head>
<body>
<div class="header">
        <h1><b>Admin Add</b></h1>
        <!--<button class="button" onclick="history.go(-1)">Back </button>-->
        <form action="tempTableMenu.php">
        <input type="submit" value="Back" class="btn btn-outline-secondary mb-2">
        </form>

</div>
<center>
<?php
session_start();
//echo "<button class=\"button\" onclick=\"history.go(-1)\">Back </button>";//goes back to the table selection page
require_once("config.php");
if(isset($_SESSION['table'])){
  $tableName=$_SESSION['table'];//gets the table from the previous page or this page
}
$query1 = "SELECT * FROM $tableName";//to display the table
    $columnNames=array();//gets the names of the columns
$count=0;
if($r = $connect->query($query1)){
    echo "<div class=\"container-fluid\">";
    echo "<div class=\"row-fluid\">";
    echo "<div class=\"table-wrapper-scroll-y my-custom-scrollbar\">";
    echo "<table class=\"table\" >";
    echo "<thead>";
    echo "<tr>";
    while($hold=$r->fetch_field()){
            echo "<th scope=\"col\">" . $hold->name . "</th>";
    }
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    while($row=mysqli_fetch_array($r)){
            echo "<tr>";
            for($i=0; $i<sizeof($row)/2; $i++){
                    echo "<td>" . $row[$i] . "</td>";
            }
            echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
}
else{
        echo "if statement did not work for r";
}
if($r = $connect->query($query1)){
        while($hold=$r->fetch_field()){
                $columnNames[$count]=$hold->name;
                $count++;
        }
}
$keyQuery="show fields from $tableName";
$getKeys=mysqli_query($connect, $keyQuery);
$keys=array();
$keyCount=0;
while($row=mysqli_fetch_array($getKeys)){
  if($row['Key']!=Null){
    $keys[$keyCount]=$row['Field'];
    $keyCount++;
  }
}
echo "<div class=\"container \">";
echo "<div class=\"row\">";
echo "<div class=\"col-sm-4 mx-auto mt-2\">";
echo "<form name=\"mainForm\" method=\"post\">";
for ($i=0; $i < sizeof($columnNames);$i++){
  if(in_array($columnNames[$i],$keys)||$columnNames[$i]=="Password"||$columnNames[$i]=="Admin"){
    // echo "<label>".$columnNames[$i]." (Required) </label>
    //   <input type=\"hidden\" name=\"keyAttIn".$i."\" id=\"keyAttIn".$i."\" value=\"$columnNames\">
    //   <input type=\"text\" name=\"input".$i."\" id=\"input".$i."\" value=\"".$info[$i]."\" style=\"width:300px;\" required>";
    echo "<div class=\"input-group mb-3 mx-sm-3 mb-2 \" >
      <input type=\"hidden\" name=\"keyAttIn".$i."\" id=\"keyAttIn".$i."\" value=\"$columnNames\">
      <input type=\"text\" class=\"form-control\" placeholder=\"".$columnNames[$i]." (Required)\" aria-label=\"name\" aria-describedby=\"basic-addon2\" name=\"input".$i."\" id=\"input".$i."\" value=\"".$info[$i]."\" required>
      </div>";
    }
    else{
      // echo"<label>".$columnNames[$i]."</label>
      //           <input type=\"hidden\" name=\"keyAttIn".$i."\" id=\"keyAttIn".$i."\" value=\"$columnNames\">
      //           <input type=\"text\" name=\"input".$i."\" id=\"input".$i."\" value=\"".$info[$i]."\" style=\"width:300px;\">";
      //   
      echo "<div class=\"input-group mb-3 mx-sm-3 mb-2 \" >
      <input type=\"hidden\" name=\"keyAttIn".$i."\" id=\"keyAttIn".$i."\" value=\"$columnNames\">
      <input type=\"text\" class=\"form-control\" placeholder=\"".$columnNames[$i]."\" aria-label=\"name\" aria-describedby=\"basic-addon2\" name=\"input".$i."\" id=\"input".$i."\" value=\"".$info[$i]."\" required>
      </div>";
    }
}
echo "<button name=\"submit\" type=\"submit\" value=\"Submit\" name=\"submitChanges\" data-toggle=\"modal\" data-target=\"#exampleModalCenter\" class=\"btn btn-outline-secondary\">Submit</button>";
echo "</form>";
$addQuery="INSERT INTO $tableName VALUES ('".$_POST['input0']."'";
for($i=1; $i <sizeof($columnNames); $i++){
  if($columnNames[$i]=="Password"){
    $pass=hash('sha256', $_POST['input'.$i]);
    $addQuery.=", '".$pass."'";
  }
  else{
    $addQuery.=", '".$_POST['input'.$i]."'";
  }
}
$addQuery.=");";
//echo "Add Query= $addQuery\n";
if($_REQUEST['submit']=='Submit'){
$a=mysqli_query($connect, $addQuery);
if($a){
  echo "<div class=\"alert alert-success alert-fixed alert-dismissible fade show\" role=\"alert\">
    Success! 
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">&times;</span>
    </button>
  </div>";
}
else{
  echo "<div class=\"alert alert-danger alert-fixed alert-dismissible fade show\" role=\"alert\">
    Failed!
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">&times;</span>
    </button>
  </div>";
}
if(isset($_POST['submitChanges'])){
   header("Refresh:0");
}

}
mysqli_close($conneciton);
?>
<form method="post" action="tempShowUpdate.php">
<input type="hidden" name="table" id="table" value="<?php echo $tableName;?>">
     <button class="btn btn-outline-secondary" type="submit">View Updated Table</button>
</form>
</center>
</body>
</html>

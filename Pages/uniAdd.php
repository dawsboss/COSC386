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
</style>
  <title>Admin Edit <?php echo $_POST['table'];?></title>
</head>
<body>
    <?php
         if($_SESSION['admin']!=true){
           header("Location: search.php");
         }
      ?>
    <?php include ("navbar.php");?>
<div class="header">
        <h1><b>Admin Add</b></h1>
        <!--<button class="button" onclick="history.go(-1)">Back </button>-->
        <form action="tableMenu.php">
        <input type="submit" class="button" value="Back">
        </form>

</div>
<center>
<?php
session_start();
//echo "<button class=\"button\" onclick=\"history.go(-1)\">Back </button>";//goes back to the table selection page
if($connect = @mysqli_connect('localhost','jfernandez3','jfernandez3','SUResearchProjDB')){//connects to the database
        echo "CONNECTION SUCCESS";
}
else{
        echo "Connection Error";
}
if(isset($_SESSION['table'])){
  $tableName=$_SESSION['table'];//gets the table from the previous page or this page
}
$query1 = "SELECT * FROM $tableName";//to display the table
    $columnNames=array();//gets the names of the columns
$count=0;
if($r = $connect->query($query1)){
        echo "<table = border='1'>";
        echo "<thead><tr>";
        while($hold=$r->fetch_field()){
                echo "<th>" . $hold->name . "</th>";
                  }
        echo "</tr>";
        echo "</thead>";
}
if($r = mysqli_query($connect, $query1)){
        while($row=mysqli_fetch_array($r)){
                echo "<tr>";
                for($i=0; $i<sizeof($row)/2; $i++){
                        echo "<td>" . $row[$i] . "</td>";
                }
                echo "</tr>";
        }
        echo "</table>";
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
echo "<form name=\"mainForm\" method=\"post\">";
for ($i=0; $i < sizeof($columnNames);$i++){
  if(in_array($columnNames[$i],$keys)||$columnNames[$i]=="Password"||$columnNames[$i]=="Admin"){
    echo "<label>".$columnNames[$i]." (Required) </label>
      <input type=\"hidden\" name=\"keyAttIn".$i."\" id=\"keyAttIn".$i."\" value=\"$columnNames\">
      <input type=\"text\" name=\"input".$i."\" id=\"input".$i."\" value=\"".$info[$i]."\" style=\"width:300px;\" required>";
    }
    else{
      echo"<label>".$columnNames[$i]."</label>
                <input type=\"hidden\" name=\"keyAttIn".$i."\" id=\"keyAttIn".$i."\" value=\"$columnNames\">
                <input type=\"text\" name=\"input".$i."\" id=\"input".$i."\" value=\"".$info[$i]."\" style=\"width:300px;\">";
        }
    echo "<br>";
}
echo "<input name=\"submit\" type=\"submit\" value=\"Submit\" class=\"button\">
      </form>";
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
echo "Add Query= $addQuery\n";
if($_REQUEST['submit']=='Submit'){
$a=mysqli_query($connect, $addQuery);
if($a){
  echo "Query Success\n";
}
else{
  echo "Query Unsuccessfull\n";
}
}
mysqli_close($conneciton);
?>
<form method="post" action="showUpdate.php">
<input type="hidden" name="table" id="table" value="<?php echo $tableName;?>">
     <input type="submit" class="button" value="View updated table">
</form>
</center>
</body>
</html>

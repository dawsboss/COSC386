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
	<?php include ("navbar.php");?>
<div class="header">
        <h1><b>Admin Edit</b></h1>
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
echo "<form name=\"getInfo\" action=\"\" method=\"post\">
        <input type=\"hidden\" name=\"table\" id=\"table\" value=\"$tableName\">
        <input type=\"text\" name=\"attribute\" id=\"attribute\" placeholder=\"Enter the name of the attribute you would like to change\" style=\"width:300px;\"><br>
        <input type=\"text\" name=\"key\" id=\"key\" placeholder=\"Enter the key for the attribute you entered\" style=\"width:300px;\"><br>
        <input type=\"submit\" value=\"submit\" class=\"button\">
        </form>";
$attribute=$_POST['attribute'];
$k=$_POST['key'];
$_SESSION['key']=$key;
//echo "table name=$tableName";
//echo "Attribute=$att";
//echo "key=$k";
$query2 = "SELECT * FROM $tableName where $attribute=\"$k\"";
$d=mysqli_query($connect,$query2);
$info=mysqli_fetch_array($d);
#echo "<br> Size of columnNames= " . sizeof($columnNames);
for ($i=0; $i < sizeof($columnNames);$i++){
        echo"<form name=\"".$columnNames[$i]."\" action =\"\" method=\"post\">
                <label>".$columnNames[$i]."</label>
                <input type=\"hidden\" name=\"attribute\" id=\"attribute\" value=\"".$columnNames[$i]."\">
                <input type=\"hidden\" name=\"table\" id=\"table\" value=\"$tableName\">
                <input type=\"hidden\" name=\"toReplace\" id=\"toReplace\" value=\"".$info[$i]."\">
                <input type=\"hidden\" name=\"keyValIn\" id=\"keyValIn\" value=\"$k\">
                <input type=\"hidden\" name=\"keyAttIn\" id=\"keyAttIn\" value=\"$attribute\">
                <input type=\"text\" name=\"input\" id=\"input\" value=\"".$info[$i]."\" style=\"width:300px;\">
                <input type=\"submit\" value=\"Submit\" class=\"button\">
                </form>";
$toReplace=$_POST['toReplace'];
$att=$_POST['attribute'];
$replaceWith=$_POST['input'];
$key=$_SESSION['key'];
$keyAtt=$_POST['keyAttIn'];
$keyVal=$_POST['keyValIn'];
	$query = "UPDATE $tableName SET $att=\"$replaceWith\" WHERE $keyAtt=\"$keyVal\"";
//echo "<br>Query=$query<br>";
$test=$connect->query($query);
if(!$test){
        //echo"<br>update query failed";
}
else{
        //echo"<br>update query succeeded";
}
}
if(!$d){
        //echo "<br>The table query failed";
}
else{
        //echo "<br>The table query succeeded";
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

<!DOCTYPE html>
<html>
<head>
<!--<link rel="stylesheet" href="style.css?v=<?php //echo time();?>" type="text/css"/>-->
<link rel="stylesheet" href="style.css">
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
</head>
<body>
<center>
<div class="header">
<h1><b>Updated <?php
    session_start();
    echo $_SESSION['table'];?> Table</b></h1>
        <!--<button class="button" onclick="history.go(-1)">Back </button>-->
        <form action="https://lamp.salisbury.edu/~jfernandez3/COSC386/Pages/edit/adminEdit/tableMenu.php">
        <input type="submit" class="button" value="Back to table selection">
        </form>

</div>
<?php
session_start();
if($connect = @mysqli_connect('localhost','jfernandez3','jfernandez3','SUResearchProjDB')){//connects to the database
        //echo "CONNECTION SUCCESS";
}
else{
        //echo "Connection Error";
}
$tableName=$_SESSION['table'];//gets the table from the previous page or this page
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
?>
</center>
</body>
</html>

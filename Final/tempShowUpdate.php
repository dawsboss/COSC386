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
</head>
<body>
<center>
<div class="header">
<h1><b>Updated <?php echo $_POST['table'];?> Table</b></h1>
        <!--<button class="button" onclick="history.go(-1)">Back </button>-->
        <form action="https://lamp.salisbury.edu/~bmason3/COSC386-1/Final/tempTableMenu.php">
        <input type="submit" value="Back to table selection" class="btn btn-outline-secondary">
        </form>

</div>
<?php
require_once("config.php");
$tableName=$_POST['table'];//gets the table from the previous page or this page
$query1 = "SELECT * FROM $tableName";//to display the table
$columnNames=array();//gets the names of the columns
$count=0;
echo "<div class=\"container-fluid\">";
echo "<div class=\"row-fluid\">";
if($r = $connect->query($query1)){  
        echo "<table class=\"table\">";
        echo "<thead>";
        echo "<tr>";
        while($hold=$r->fetch_field()){
                echo "<th scope=\"col\">" . $hold->name . "</th>";
        }
        echo "</tr>";
        echo "</thead>";
}
echo "<tbody>";
  if($r = mysqli_query($connect, $query1)){
        while($row=mysqli_fetch_array($r)){
                echo "<tr>";
                for($i=0; $i<sizeof($row)/2; $i++){
                        echo "<td>" . $row[$i] . "</td>";
                }
                echo "</tr>";
        }
        echo "</tbody>";
    }else{
        echo "if statement did not work for r";
}
echo "</table>";
echo "</div>";
echo "</div";
echo "</div>";
?>
</center>
</body>
</html>

<html>
<body>
<?php
 if($connect = @mysqli_connect('localhost','jfernandez3','jfernandez3','SUResearchProjDB')){
  echo "CONNECTION SUCCESS";
 }
 else{
         echo "Connection Error";
 }
 echo"<form name=\"getUsr1\" action =\"\" method\"get\">
         <input type=\"text\" name=\"search\" id=\"search\" placeholder=\"What you would like to change\">
        </form>";
 echo"<form name=\"getUsr2\" action =\"\" method\"get\">
         <input type=\"text\" name=\"to\" id=\"to\" placeholder=\"What you would like to change it to\">
        </form>";
 $search=$_GET['search'];
 echo $_GET['search'];
 echo $search;
$replaceWith=$_Get['to'];
$query = "UPDATE Department SET Name=\"$replaceWith\" WHERE Name=\"$search\"";
$d = mysqli_query($connect, $query);
$query1 = "SELECT * FROM Department";
$r = mysqli_query($connect, $query1);
echo "<table border='1'>
        <thead>
        <tr>
        <th>NAME</th>
        <th>School Name</th>
        </tr>
        </thead>";
while($row=mysqli_fetch_array($r)){
        echo "<tr>";
        echo "<td>" . $row['Name'] . "</td>";
        echo "<td>" . $row['SchoolName'] . "</td>";
        echo "</tr>";
}
echo "</table>";
mysqli_close($connection);
?>
</body>
</html>

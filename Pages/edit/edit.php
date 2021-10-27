<!DOCTYPE html>
<html>
<body>
<?php
 if($connect = @mysqli_connect('localhost','jfernandez3','jfernandez3','SUResearchProjDB')){
  echo "CONNECTION SUCCESS";
 }
 else{
         echo "Connection Error";
 }
 echo"\nDEPARTMENT ONLY. THIS IS FOR TESTING";
 echo"<form name=\"getUsr\" action =\"\" method\"get\">
         <input type=\"text\" name=\"table\" id=\"table\" placeholder=\"Enter table name\" style=\"width:300px;\"><br>
        <input type=\"text\" name=\"attribute\" id=\"attribute\" placeholder=\"Which attribute would you like to change\" style=\"width:300px;\"><br>
         <input type=\"text\" name=\"search\" id=\"search\" placeholder=\"What value in the attribute would you like to change\" style=\"width:300px;\"><br>
         <input type=\"text\" name=\"changeTo\" id=\"changeTo\" placeholder=\"What you would like to change it to\" style=\"width:300px;\"><br><br>
        <input type=\"submit\" value=\"Submit\"> 
        </form>";
 $search=$_GET['search'];
 echo "Search =$search\n";
 $replaceWith=$_GET['changeTo'];
 echo "Replace with=$replaceWith\n";
 $attribute=$_GET['attribute'];
 echo "Attribute=$attribute";
 $table=$_GET['table'];
 echo "Table=$table";
$query = "UPDATE $table SET $attribute=\"$replaceWith\" WHERE $attribute=\"$search\"";
$d = mysqli_query($connect, $query);
if(!$d){
        echo "The query failed";
}
else{
        echo "The query succeeded";
}
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

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
 echo "<label for \"table\"> Select a Table: </label>
  <form action=\"\" method=\"post\">
         <select name=\"table\" id=\"table\">
                <option value=\"Department\">Department</option>
                <option value=\"FundedBy\">Funded By</option>
                <option value=\"Grants\">Grants</option>
                <option value=\"Has\">Has</option>
                <option value=\"Login\">Login</option>
                <option value=\"Professor\">Professor</option>
                <option value=\"Research\">Research</option>
                <option value=\"School\">School</option>
                <option value=\"Student\">Student</option>
                <option value=\"WorkOn\">Work On</option>
        </select>
        <input type=\"submit\" name=\"submit\">
        </form>";
 echo"<form name=\"getUsr\" action =\"\" method\"get\">
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
 $table=$_POST['table'];
 echo "Table=$table";
$query = "UPDATE $table SET $attribute=\"$replaceWith\" WHERE $attribute=\"$search\"";
$d = mysqli_query($connect, $query);
if(!$d){
        echo "The query failed";
}
else{
        echo "The query succeeded";
}
$query1 = "SELECT * FROM $table";
if($r = mysqli_query($connect, $query1)){
        echo "<table = border='1'>";
        while($row=mysqli_fetch_array($r)){
                foreach($row as $key => $value){
                        if(!is_numeric($key)){
                                echo "<tr><td>" . $key . "</td><td>" . $value . "</td></tr>";
                        }
                }
        }
        echo "</table>";
}
else{
        echo "if statement did not work for r";
}
mysqli_close($connection);
?>
</body>
</html>
           

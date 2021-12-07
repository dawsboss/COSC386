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
  echo"<form name=\"getUsr\" action =\"\" method\"get\">
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
                                        </select><br>
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
    if(isset($_GET['table'])){
            $table=$_GET['table'];
    }
     echo "Table=$table";
     $query = "UPDATE $table SET $attribute=\"$replaceWith\" WHERE $attribute=\"$search\"";
     $d = $connect->query($query);
     if(!$d){
                     echo "The query failed";
     }
     else{
                     echo "The query succeeded";
     }
     $query1 = "SELECT * FROM $table";
     $test=0;
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
     mysqli_close($connection);
?>
</body>
</html>

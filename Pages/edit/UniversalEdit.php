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
   $tableName="School";
 $query1 = "SELECT * FROM $tableName";
 $columnNames=array();
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
 echo "<form name=\"getInfo\" action=\"\" method=\"get\">
         <input type\"text\" name=\"attribute\" id=\"attribute\" placeholder=\"Enter the name of the attribute you would like to change\" style=\"width:300px;\"><br>
        <input type\"text\" name=\"key\" id=\"key\" placeholder=\"Enter the key for the attribute you entered\" style=\"width:300px;\"><br>
         <input type=\"submit\" value\"Submit\">
        </form>";
 $att=$_GET['attribute'];
 $k=$_GET['key'];
$query2 = "SELECT * FROM $tableName where $att=\"$k\"";
 $d=mysqli_query($connect,$query2);
 $info=mysqli_fetch_array($d);
 #echo "<br> Size of columnNames= " . sizeof($columnNames);
 for ($i=0; $i < sizeof($columnNames);$i++){
         #echo $columnNames[$i] . "<br>";
         echo"<form name=\"".$columnNames[$i]."\" action =\"\" method\"get\">
                 <label>".$columnNames[$i]."</label>
           <input type=\"text\" name=\"".$columnNames[$i]."\" id=\"".$columnNames[$i]."\" value=\"".$info[$i]."\" style=\"width:300px;\"><br>
             <input type=\"submit\" value=\"Submit\">
             </form>";
        $toReplace=$info[$i];
         $replaceWith=$_GET[$columnNames[$i]];
 echo "<br>Replace with=$replaceWith";
 echo "<br>To Replace=".$info[$i];
 $test=$info[0];
 echo "<br>To Replacetest =$test";
        $query = "UPDATE $tableName SET $attribute=\"$replaceWith\" WHERE $attribute=\"$test\"";
 $test=$connect->query($query);
 if(!$test){
         echo"<br>update query failed";
 }
 else{
         echo"<br>update query succeeded";
 }
 }
     if(!$d){
                     echo "The query failed";
     }
     else{
                     echo "The query succeeded";
     }
     mysqli_close($conneciton);
?>
</body>
</html>

<html>
<body>
<?php
session_start();
include("../BackEnd.php");
if($connect = @mysqli_connect('localhost','jfernandez3','jfernandez3','SUResearchProjDB')){
  echo "CONNECTION SUCCESS";
 }
 else{
         echo "Connection Error";
 }
$rID = $research['ID'];
echo $rID;
?>
<form name="getDelStud" method="post">
<select name="table" id="table">
<?php
foreach($students as $printStudents){
  echo "<option value=\"".$printStudents['Email']."\">".$printStudents['Name']."</option>";
}
?>
</select>
<input type="submit" value="Delete student">
</form>
<?php
$delQuery="DELETE FROM WorkOn WHERE studentEmail='".$_POST['table']."'";
echo $delQuery;
if(isset($_POST['table'])){
  $delStudent=mysqli_query($connect, $delQuery);
  if($delStudent){
    echo "<br>Student successfuly deleted<br>";
  }
  else{
    echo "<br>Student not deleted <br>";
  }
  $addStudent=mysqli_query($connect, $addToStudentQuery);
  if($addStudent){
     echo "Add student successful<br>";
  }
  else{
     echo "add student unsuccessful\n";
  }
}
$findRQuery="select count(studentEmail) as numE from WorkOn where studentEmail='".$_POST['studentEmail']."'";
$findRStud=mysqli_query($connect, $findRQuery);
if($findRStud){
  echo "find r stud successful\n";
}
else{
  echo "find r stud unsuccessful\n";
}
$findRArr=mysqli_fetch_assoc($findRStud);
if($findRArr['numE']==0){
  $addStudentToResearch="insert into WorkOn values('".$rID."','".$_POST['studentEmail']."')";
  echo "<br>".$addStudentToResearch;
  $add=mysqli_query($connect, $addStudentToResearch);
  if($add){
    echo "Student inserted to workon\n";
  }
  else{
    echo "student not added to workon\n";
  }
}
}
?>
</body>
</html>
}
?>
<form name="addStud" method="post">
<input type="text" name="studentName" id="studentName" placeholder="Please add the student's name" required>
<input type="text" name="studentEmail" id="studentEmail" placeholder="Please add the student's email" required>
<input type="submit" value="Add student">
</form>
<?php
if(isset($_POST['studentName'])&& isset($_POST['studentEmail'])){
$findQuery= "select count(Name) as num from Student where Name='".$_POST['studentName']."' and Email='".$_POST['studentEmail']."'";
echo $findQuery;
$findStud=mysqli_query($connect, $findQuery);
if($findStud){
  echo "find query successful";
}
else{
  echo "find query unsuccessful";
}
$findArr=mysqli_fetch_assoc($findStud);
echo $findArr['num'];
if($findArr['num']==0){
  $addToStudentQuery="insert into Student values('".$_POST['studentEmail']."','".$_POST['studentName']."')";
  echo $addToStudentQuery;

<html>
  <head>
  <title><?php echo $research['Title']; ?> Add Student</title>
    <meta charset="utf-8".>
    <meta name="viewport" content="width=device-width, initial scale=1">
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
 </head>
<body>
<header class="header" style="position: relative; margin-bottom: 100px;">
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
//echo $rID;
include("../navbar.php");
?>
<form name="getDelStud" method="post">
<div class="container">
<div class="row justify-content-md-center">
        <div class="dropdown text-center">
                <form action="tempUniEdit.php" method="post">
                <select class="btn btn-outline-secondary dropdown-toggle" type="button"
                aria-haspopup="true" aria-expanded="false" name="table" id="table">
<?php
foreach($students as $printStudents){
  echo "<option  class= \"dropdown-item\" value=\"".$printStudents['Email']."\">".$printStudents['Name']."</option>";
}
?>
</select>
<button type="submit" onClick="value='Delete student'" class="btn btn-outline-secondary" style="width:70px;">Delete</button>
</form>
<?php
$delQuery="DELETE FROM WorkOn WHERE studentEmail='".$_POST['table']."'";
//echo $delQuery;
if(isset($_POST['table'])){
  $delStudent=mysqli_query($connect, $delQuery);
  if($delStudent){
    echo "<br>Student successfuly deleted<br>";
  }
  else{
     echo "<br>Student not deleted <br>";
  }
}
?>
<form name="addStud" method="post">
<div class="input-group mb-3 mx-sm-3 mb-2" >
<input type="text" class="form-control" name="studentName" id="studentName" placeholder="Please add the student's name" required>
<input type="text" class="form-control" name="studentEmail" id="studentEmail" placeholder="Please add the student's email" required>
<button type="submit" onClick="value='Add student'" class="btn btn-outline-secondary" style="width:70px;">Add</button>
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
<form action="researchEdit.php">
  <input type="hidden" name="r" id="r" value="<?php echo $rID;?>">
  <input type="submit" class="button" value="Back">
</form>
</body>
</html>

<html>
  <head>
  <title><?php echo $research['Title']; ?> Add Grant</title>
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
  //echo "CONNECTION SUCCESS";
 }
 else{
         //echo "Connection Error";
 }
$rID = $research['ID'];
//echo $rID;
include("../navbar.php");
?>
<form name="getDelStud" method="post">
<select name="table" id="table">
<?php
foreach($grants as $printgrant){
  $getIDQuery="select ID as grantID from Grants where Organization='".$printgrant['Organization']."' and year='".$printgrant['year']."' and amount='".$printgrant['Amount']."'";
  //echo "<br>$getIDQuery <br>";
  $findID=mysqli_query($connect,$getIDQuery);
  if($findID){
    //echo "<br>ID successfuly found<br>";
  }
  else{
    //echo "<br>ID not found<br>";
  }
  $IDArr=mysqli_fetch_assoc($findID);
  echo "<option value=\"".$IDArr['grantID']."\">".$printgrant['Organization']." ".$printgrant['year']." $". $printgrant['Amount']."</option>";
}
?>
</select>
<input type="submit" value="Delete grant">
  </form>
<?php
$delQuery="DELETE FROM FundedBy WHERE grantID=".$_POST['table']."";
echo $delQuery;
echo "table output: ".$_POST['table']."<br>";
if(isset($_POST['table'])){
  $delStudent=mysqli_query($connect, $delQuery);
  if($delStudent){
    echo "<br>Grant successfuly deleted<br>";
  }
  else{
    echo "<br>Grant not deleted <br>";
  }
}
?>
<form name="addGrant" method="post">
<input type="text" name="grantOrg" id="grantOrg" placeholder="Please add the grant organization" required>
<input type="text" name="grantYear" id="grantYear" placeholder="Please add the grant year" required>
<input type="text" name="grantAmount" id="grantAmount" placeholder="Please add the grant amount" required>
<input type="submit" value="Add grant">
</form>
<?php
if(isset($_POST['grantOrg'])&& isset($_POST['grantYear'])){
  $findQuery= "select count(Organization) as num from Grants where Organization='".$_POST['grantOrg']."' and year='".$_POST['grantYear']."' and Amount='".$_POST['grantAmount']."'";
echo $findQuery;
$findGrant=mysqli_query($connect, $findQuery);
if($findGrant){
  echo "find query successful";
}
else{
  echo "find query unsuccessful";
}
$findArr=mysqli_fetch_assoc($findGrant);
echo $findArr['num'];
if($findArr['num']==0){
  $findNextQ="select max(id) as next from Grants";
  $findMaxID=mysqli_query($connect, $findNextQ);
  if($findMaxID){
    echo "Find max successful<br>";
  }
  else{
    echo "find max unsuccessful<br>";
  }
  $nextArr=mysqli_fetch_assoc($findMaxID);
  $nextID=$nextArr['next']+1;
  echo "<br>next id: $nextID<br>";
  $addToGrantQuery="insert into Grants values('".$_POST['grantAmount']."','".$_POST['grantYear']."',$nextID,'".$_POST['grantOrg']."')";
  echo $addToGrantQuery;
  $addGrant=mysqli_query($connect, $addToGrantQuery);
  if($addGrant){
     echo "<br>Add grant successful<br>";
  }
  else{
     echo "<br>add grant unsuccessful\n";
  }
}
$findGQuery="select count(grantID) as numG from FundedBy where grantID='$nextID'";
$findGGrant=mysqli_query($connect, $findGQuery);
if($findGGrant){
  echo "find r stud successful\n";
}
else{
  echo "find r stud unsuccessful\n";
}
$findGArr=mysqli_fetch_assoc($findGGrant);
if($findGArr['numG']==0){
  $addGrantToFundedBy="insert into FundedBy values('".$nextID."','".$rID."')";
  echo "<br>".$addGrantToFundedBy;
  $add=mysqli_query($connect, $addGrantToFundedBy);
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

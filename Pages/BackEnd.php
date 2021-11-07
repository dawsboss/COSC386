<?php

if( $connect = @mysqli_connect('localhost', 'gdawson1', 'gdawson1','SUResearchProjDB') ){
  echo "<p>Connect</p>";
}
session_start();
#init session vars
if(!isset($_SESSION['logged'])){
  $_SESSION['logged'] = "null";
  $_SESSION['admin'] = 0;
}
$profile = null;

//print_r($_SESSION);

#Search Page Quering
#To use: Make the href have ?q=VAR1&f=VAR2
#Returns: A query p in Professor table where VAR2 like %VAR1%
# search - An array of tuples and all attributes
if((isset($_GET["q"]) || isset($_GET["f"])) && $_GET["q"] && $_GET["f"]){
#SEARCHING STUFF
  $data = null;
  $search=[];
  $Sfilter = mysqli_real_escape_string($connect,$_GET["f"]);
  $Squestion = mysqli_real_escape_string($connect,$_GET["q"]);
  $Squery = "SELECT * FROM Professor WHERE $Sfilter LIKE \"%$Squestion%\"";
  $Ssql = mysqli_query($connect, $Squery);
  while($data = mysqli_fetch_array($Ssql)){
    array_push($search, $data);
  }
  //print_r($search);
}

#Login Page Quering and Access
#To use: Post with username and passhash - username and the password hashed
#Returns: logged in status, admin status
# session->logged - *username*
# session->admin - T/F 
if(isset($_POST['username']) && $_POST['username'] && isset($_POST['password']) && $_POST['password']){
  print("u:{$_POST['username']} | p:{$_POST['password']}");
  $logUser = null;
  $Luname = mysqli_real_escape_string($connect,$_POST["username"]);
  print($Luname);
  $Lpass = mysqli_real_escape_string($connect,$_POST["password"]);
  print($Lpass);
  $Lquery = "SELECT * FROM Login WHERE Username = \"$Luname\"";
  $Lsql = mysqli_query($connect, $Lquery);
  $logUser = mysqli_fetch_array($Lsql);
  if($logUser){#There is a username found
    print("UserName correct<br>");
    print("Here:".hash('sha256',$Lpass)." | DB: ".$logUser['Password']);
    if(hash('sha256',$Lpass) == $logUser['Password']){#Then valid login
      $_SESSION['logged'] = $Luname;
      print("<br> Logged");
    }
    if($logUser['Admin'] == 1){
      $_SESSION['admin'] = true;
      print("<br> isAdmin");
    }
  }
  print("<br>");
  print_r($_SESSION);
  header("Location: Login/login.php");
}

#Profile Page Quering
#To use: Make the href have ?p=VAR
#Returns: A query p in Professor table
# profile: A tuple and all attributes
# currentresearch: List of current rsearch
# pastresearch: List of past research
if(isset($_GET['p']) && $_GET['p']){
  $profile = null;
  $data = null;
  $Pusername = mysqli_real_escape_string($connect,$_GET['p']);
  $Pquery = "SELECT * FROM Professor WHERE Username = \"$Pusername\"";
  $Psql = mysqli_query($connect,$Pquery);
  $profile = mysqli_fetch_array($Psql);

  if($profile){
    $currentresearch = [];
    $pastresearch = [];
    $RPquery = "SELECT * FROM Research WHERE ID in (SELECT researchID FROM Has WHERE Username = \"{$profile['Username']}\")";
    $RPsql = mysqli_query($connect,$RPquery);
    while($data = mysqli_fetch_array($RPsql)){
      //print_r($data);
      if($data['Current'] == 1){#It is current
        array_push($currentresearch, $data);
      }else{
        array_push($pastresearch, $data);
      } 
    }
  }
}

#Research Page Quering
#To use: Make the href have ?r=VAR
#Returns: A query r in Research table
# research - Tuple of research and all attributes
# students - Tuple of students and all attributes
if(isset($_GET['r']) && $_GET['r']){
  #RESEARCH STUFF TODO test
  $research = null;#pulls research info
  $RID = mysqli_real_escape_string($connect, $_GET['r']);
  $Rquery = "SELECT * FROM Research WHERE ID = $RID";
  $Rsql = mysqli_query($connect,$Rquery);
  $research = mysqli_fetch_array($Rsql);
  //session_close();

  $students = null;#Pulls students that worked on the research project
  $data = null;
  $RSquery = "SELECT * FROM Student WHERE Email IN (SELECT studentEmail FROM WorkOn AS SE WHERE researchID = $RID)";
  $RSsql = mysqli_query($connect, $RSquery);
  echo mysqli_error($connect);
  while($data = mysqli_fetch_array($RSsql)){
    print($data." test<br>");
    array_push($students, $data);
  }

  print_r($students);

  $grants = null;#pulls the grants the research worked under
  $data = null;
  $RGquery = "SELECT Amount AS A, year AS B, ID AS C, Organization AS D FROM Grants LEFT JOIN FundedBy ON Grants.ID = FundedBy.researchID = $RID";
  if (!$RGquery ) echo mysqli_error($connect);
  $RGsql = mysqli_query($connect, $RGquery);
  while($data = mysqli_fetch_array($RGsql)){
	  array_push($grants, $data);
  }
  print_r($grants);

  $profs = null;#List of professors that worked on the proj
  $data = null;
  $RPquery="SELECT * FROM Professor WHERE Username in (SELECT Username FROM Has where researchID = $RID)";
  $RPsql = mysqli_query($RPquery);
  while($data = mysqli_fetch_array($RPsql)){
    array_push($profs,$data);
  }
  print_r($profs);

}

#Editing Page Querying
#To use: Post using 'eu' editUsername
#Returns: A querry of current infomation in DB
# Eprofile - Tuple of all profile attributes
if(isset($_POST['eu']) && $_POST['eu']){
  #EDIT STUFF
  if($_SESSION['logged'] == $_POST['eu'] || $_SESSION['admin'] == true){#If they are trying to edi tthemselves or are admin
    $Eprofile = null;
    $Eusername = mysqli_real_escape_string($connect,$_POST['eu']);
    $Equery = "SELECT * FROM Professor WHERE Username LIKE \"$Eusername%\"";#TODO turn like to = when fix email att stuff
    $Esql = mysqli_query($connect,$Equery);
    $Eprofile = mysqli_fetch_array($Esql);
  }
}
#Editing Page Alter
#To use: Post using 'ea' editAalter
#Returns: Nothing
#Will update a tuple matching the login
#eu - editing page|| ename - new name
if(isset($_POST['ename']) && $_POST['ename'] && isset($_POST['euname']) && $_POST['euname'] && isset($_POST['edname']) && $_POST['edname'] && isset($_POST['esname']) && $_POST['esname'] && isset($_POST['erstate']) && $_POST['erstate'] && isset($_POST['eweb']) && $_POST['eweb'] && isset($_POST['eaval']) && $_POST['eaval'] && isset($_POST['ebio']) && $_POST['ebio'] && isset($_POST['ephone']) && $_POST['ephone'] && isset($_POST['eu']) && $_POST['eu']){
  #EDIT ALTER
  $_SESSION['edit'] = false;
  if($_POST['admin'] == true || $_POST['logged'] == $_POST['eu']){#User is either admin or logged into account

    $Ename = mysqli_real_escape_string($connect,$_POST['ename']);
    $Edeptname = mysqli_real_escape_string($connect,$_POST['edname']);
    $Eschoolname = mysqli_real_escape_string($connect,$_POST['esname']);
    $EresearchState = mysqli_real_escape_string($connect,$_POST['erstate']);
    $Eweb = mysqli_real_escape_string($connect,$_POST['eweb']);
    $Eaval = mysqli_real_escape_string($connect,$_POST['eaval']);
    $Ebio = mysqli_real_escape_string($connect,$_POST['ebio']);
    $Ephone = mysqli_real_escape_string($connect,$_POST['ephone']);



    $ECquery = "UPDATE Professor SET (Name=$Ename, Deptname=$Edeptname, Schoolname=$Eschoolname, ResearchStatment=$EresearchState, Website=$Eweb, Availabilty=$Eaval, Bio=$Ebio, PhoneNum=$Ephone)";
    $Esql = mysqli_query($connect,$ECquery);
    if($ECsql){
      $_SESSION['edit'] = true;
    }


    
    
  }
}



#Creating Page Insert
#To use: Post using 'ci' createInsert
#Returns: SESSION -> create: T/F
#Will create new user can only be down by admin
#User must be admin to create new professors
/*if(isset($_POST['admin']== true){
  if(isset($_POST['cname']) && $_POST['cname'] && isset($_POST['cuname']) && $_POST['cuname'] && isset($_POST['cdname']) && $_POST['cdname'] && isset($_POST['csname']) && $_POST['csname'] && isset($_POST['crstate']) && $_POST['crstate'] && isset($_POST['cweb']) && $_POST['cweb'] && isset($_POST['caval']) && $_POST['caval'] && isset($_POST['cbio']) && $_POST['cbio'] && isset($_POST['cphone']) && $_POST['cphone'], isset($_POST['cpass']) && $_POST['cpass'] && isset($_POST['Cadmin'] && $_POST['Cadmin'])){
    #CREATE STUFF
    $Cname = mysqli_real_escape_string($connect,$_POST['cname']);
    $Cuname = mysqli_real_escape_string($connect,$_POST['cuname']);
    $Cdeptname = mysqli_real_escape_string($connect,$_POST['cdname']);
    $Cschoolname = mysqli_real_escape_string($connect,$_POST['csname']);
    $CresearchState = mysqli_real_escape_string($connect,$_POST['crstate']);
    $Cweb = mysqli_real_escape_string($connect,$_POST['cweb']);
    $Caval = mysqli_real_escape_string($connect,$_POST['caval']);
    $Cbio = mysqli_real_escape_string($connect,$_POST['cbio']);
    $Cphone = mysqli_real_escape_string($connect,$_POST['cphone']);


    $CPquery = "INSERT INTO Professor VALUES(\"$Cname\", \"$Cuname\", \"$Cdeptname\", \"$Cschoolname\", \"$CresearchState\", \"$Cweb\", $Caval, \"$Cbio\", \"$Cphone\")";#TODO turn like to = when fix email att stuff
    $CPsql = mysqli_query($connect,$Cquery);

    $CLquery = "INSERT INTO Login VALUES(\"$Cuname\", \"$Cpass\", $Cadmin)"#TODO Make sure admin is being given right compared from HTML compared to DB

    if($CPsql && $CLsql){
      $_SESSION['create'] = true;
    }else if($CPsql){
      print("Only Professor added");#TODO Drop the table then
    }else if($CLsql){
      print("Only login added");#TODO drop the table then
    }else{
      print("Nothing added");
    }
  }
}
 */
mysqli_close($connect);
?>

<?php

if( $connect = @mysqli_connect('localhost', 'gdawson1', 'gdawson1','SUResearchProjDB') ){
  echo "<p>Connect</p>";
}
session_start();
#init session vars
$_SESSION['logged'] = "null";
$_SESSION['admin'] = false;
$profile = null;

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
  print_r($search);
}

#Login Page Quering and Access
#To use: Post with username and passhash - username and the password hashed
#Returns: logged in status, admin status
# session->logged - *username*
# session->admin - T/F 
if(isset($_POST['username']) && $_POST['username'] && isset($_POST['passhash']) && $_POST['passhash']){
  #LOGIN STUFF
  $logUser = null;
  $Luname = mysqli_real_escape_string($connect,$_POST["username"]);
  $Lpass = mysqli_real_escape_string($connect,$_POST["passhash"]);
  $Lquery = "SELECT * FROM Login WHERE Username = \"$Luname\"";
  $Lsql = mysqli_query($connect, $Lquery);
  $logUser = mysqli_fetch_array($Lsql);
  if(logUser){#There is a username found
    if(passhash == logUser['Password']){#Then valid login
      $_SESSION['logged'] = $Luname;
    }
    if(logUser['Admin'] == 1){#User was an admin TODO changed based on Login table values
      $_SESSION['admin'] = true;
    }
  }

}

#Profile Page Quering
#To use: Make the href have ?p=VAR
#Returns: A query p in Professor table
# profile: A tuple and all attributes
if(isset($_GET['p']) && $_GET['p']){
#PROFILE STUFF TODO not tested
  $profile = null;
  $Pusername = mysqli_real_escape_string($connect,$_GET['p']);
  $Pquery = "SELECT * FROM Professor WHERE Email LIKE \"$Pusername%\"";#TODO turn like to = when fix email att stuff
  $Psql = mysqli_query($connect,$Pquery);
  $profile = mysqli_fetch_array($Psql);
  #print_r($profile);
  #echo "<br>";
  #print($profile['Bio']);
  #echo "<br>";
  #print("<h1>hello</h1>");
}

#Research Page Quering
#To use: Make the href have ?r=VAR
#Returns: A query r in Research table
# research - Tuple of research and all attributes
if(isset($_GET['r']) && $_GET['r']){
  #RESEARCH STUFF TODO test
  $research = null;
  $RID = mysqli_real_escape_string($connect, $_GET['r']);
  $Rquery = "SELECT * FROM Research WHERE ID = $RID";#TODO idk if this will work yet... string stuff no fun
  $Rsql = mysqli_query($connect,$Rquery);
  $research = mysqli_fetch_array($Rsql);
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
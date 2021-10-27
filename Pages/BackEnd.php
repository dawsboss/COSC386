<?php

if( $connect = @mysqli_connect('localhost', 'gdawson1', 'gdawson1','SUResearchProjDB') ){
  echo "<p>Connect</p>";
}



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
}

#Login Page Quering and Access
#To use: Post with username and passhash - username and the password hashed
#Returns: logged in status, admin status
# logged - *username*
# admin - T/F 
if(isset($_POST['username']) && $_POST['username'] && isset($_POST['passhash']) && $_POST['passhash']){
#LOGIN STUFF

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
  $profile = mysqli_fetch($Psql);
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
  $research = mysqli_fetch($);
}

#Editing Page Querying
#To use: Post using 'eu' editUsername
#Returns: A querry of current infomation in DB
if(isset($_POST['eu']) && $_POST['eu']){
  #EDIT STUFF

}
#Editing Page Alter
#To use: Post using 'ea' editAalter
#Returns: Nothing
#Will update a tuple matching the login
if(isset($_POST['ea']) && $_POST['ea']){
  #EDIT ALTER

}


#Creating Page Insert
#To use: Post using 'ci' createInsert
#Returns: Nothing
#Will create new user can only be down by admin
if(isset($_POST['ci']) && $_POST['ci']){
#CREATE STUFF

}

mysqli_close($connect);
?>

<html>
	<body>
<?php
include ("back.php");
include ("BackEnd.php");

session_start();

if( $connect = @mysqli_connect('localhost', 'gdawson1', 'gdawson1','SUResearchProjDB') ){
	echo 'Successfully connected to MySQL';
}

$query = 'SELECT * FROM Professor';
$sql = mysqli_query($connect, $query);


$jtaquery = 'SELECT * FROM Professor WHERE Name="Joseph Anderson"';
$jtasql = mysqli_query($connect, $jtaquery);
$profile['Name'];
$jta = mysqli_fetch_array($jtasql);
$name = $_SESSION['Name'] = $jta['Name'];
$bio = $_SESSION['Bio'] = $jta['Bio'];
$email = $_SESSION['Email'] = $jta['Email'];
$researchstatement = $_SESSION['ResearchStatement'] = $jta['ResearchStatement'];
$phone = $_SESSION['PhoneNum'] = $jta['PhoneNum'];

mysqli_close($connect);
?>

</body>
</html>

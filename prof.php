<html>
	<body>
<?php

if( $connect = @mysqli_connect('localhost', 'gdawson1', 'gdawson1','SUResearchProjDB') ){
	echo 'Successfully connected to MySQL';
}

$query = 'SELECT * FROM Professor';
$sql = mysqli_query($connect, $query);

$jtaquery = 'SELECT * FROM Professor WHERE Name="Joseph Anderson"';
$jtasql = mysqli_query($connect, $jtaquery);
$jta = mysqli_fetch_array($jtasql);

echo "<table border=1>
	<thead>
		<tr>
			<th>Name</th>
			<th>Email</th>
			<th>Department Name</th>
			<th>School Name</th>
			<th>Research Statment</th>
			<th>Website</th>
			<th>Availability</th>
			<th>Bio</th>
			<th>Phone Number</th>
		</tr>
	</thread>";
while($row = mysqli_fetch_array($sql)){
	echo "<tr>";
	echo "<td>" . $row['Name'] . '</td>';
	echo "<td>" . $row['Email'] . '</td>';
	echo "<td>" . $row['DeptName'] . '</td>';
	echo "<td>" . $row['SchoolName'] . '</td>';
	echo "<td>" . $row['ResearchStatment'] . '</td>';
	echo "<td>" . $row['Website'] . '</td>';
	echo "<td>" . $row['Availability'] . '</td>';
	echo "<td>" . $row['Bio'] . '</td>';
	echo "<td>" . $row['PhoneNum'] . '</td>';
	echo "<tr>";

}
echo "</table>";



echo "<h1>Thingy</h1>";
echo "<h3> Test ".$jta['PhoneNum']."</h3>";

mysqli_close($connect);
?>


<h1>Try 1</h1>
<h3 id="demo1"></h3>
<h1>Try 2</h1>
<h3 id="demo2"></h3>
<h1>Try 3</h1>
<h3 id="demo3"></h3>
<h1>Try 4</h1>
<h3 id="demo4"></h3>



<script>
var data = <?php echo $jta['PhoneNum'];?>;
document.getElementById("demo1").innerHTML = data;
</script>

<script>
var data = "<?php echo $jta['Name'];?>";
document.getElementById("demo2").innerHTML = data;
</script>

<script>
var data = <?php echo json_encode($jta);?>;
document.getElementById("demo3").innerHTML = data['Name'];
document.getElementById("demo4").innerHTML = data['Name']+' | '+data['Email'];
</script>



</body>
</html>

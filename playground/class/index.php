<?php

if( $connect = @mysqli_connect('localhost', 'gdawson1', 'gdawson1','gdawson1DB') ){
	echo 'Successfully connected to MySQL';
}

$query = 'SELECT * FROM Ships';

$sql = mysqli_query($connect, $query);

echo "<table border=1>
	<thead>
		<tr>
			<th>Name</th>
			<th>Class</th>
			<th>Launched</th>
		</tr>
	</thread>";

while($row = mysqli_fetch_array($sql)){
	//echo $row['name'] . ", " . $row['class'] . ", " . $row['launched'];

	echo "<tr>";
	echo "<td>" . $row['name'] . '</td>';
	echo "<td>" . $row['class'] . '</td>';
	echo "<td>" . $row['launched'] . '</td>';
	echo "<tr>";

}
echo "</table>";
mysqli_close($connect);

echo "My first";

?>

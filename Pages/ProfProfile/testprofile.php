<html>
<body>
<?php
$connect=@mysqli_connect('localhost', 'bforsythe2', 'Bstar$123', 'SUResearchProjDB');

$query = "SELECT * FROM Professor WHERE Name = 'Joseph Anderson'";
$sql = mysqli_query($connect, $query);
$jta = mysqli_fetch_array($sql);

mysqli_close($connect);
?>

<div class = "text-center">
	<h1 id = "profname"> </h1>
	<h3 id = "researchStatement"> </h3>
</div>	

<script>
	var data = <?php echo json_encode($jta); ?>;
	document.getElementById("profname").innerHTML = data['Name'];
	document.getElementById("researchStatement").innerHTML = data['ResearchStatment'];
</script>

<div class="row">
	<div class="col">Title</div>
	<div class="col">Description</div>
</div>
<div class="row">
	<div class="col">Page</div>
	<div class="col">Page Description</div>
</div>

</body>
</html>

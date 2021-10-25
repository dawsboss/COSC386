<html>
<body>
<?php
include ("backV2.php");
?>

  <input type="text" placeholder="search..." id="search">
  <p>Select search by:</p>
  <input type="radio" id="school" name="filter" value="SchoolName">
  <label for="school">School</label><br>
  <input type="radio" id="department" name="filter" value="DeptName">
  <label for="department">Department</label><br>
  <input type="radio" id="email" name="filter" value="Email">
  <label for="email">Email</label><br>
  <input type="radio" id="name" name="filter" value="Name">
  <label for="name">Name</label><br>
  <button onclick="transfer(document.getElementById('search').value)">Query</button>
<!--<div id="table" style="display:none">
</div>-->
<?php if ( count($search) > 0 ): ?>
<p><?php print_r($search); ?></p>
<?php else: ?>
  <h1>waiting</h1>
<?php endif; ?>
<!--
<form method="post" action="profV2.php">
Submit me to change the name of professor
<input type="text" placeholder="id" name="id" id="id"/>
<input type="text" placeholder="New Name" name="name" id="name"/>
<input type="submit" value="Submit">
</form> 
-->

<script>
var data;
function transfer(search){
  var filter;
  var radios = document.getElementsByName('filter');
  for (var radio of radios){
    if(radio.checked){
      filter=radio.value;
    }
  }

  var linkout =  window.location.pathname + "?q=" + search + "&f=" + filter;


  window.location.href = linkout;
  //reutrn false;
  //data = <?php echo json_encode($data)?>;
  //console.log(data);
  //document.getElementById('output').innerHTML = data[0];
  //document.getElementById('table').style.display = "block";
}
</script>

</body>
</html>

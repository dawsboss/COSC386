<?php

session_start();
#init session vars
$_SESSION['logged'] = "null";
$_SESSION['admin'] = 0;
$profile = null;
print_r($_SESSION);
?>
<html>
<a href="login.php"> admin 1</a>
<a href="logout.php"> admin 0</a>
<a href="junk.php"> admin 3 </a>
</html>
<?php

var_dump($_SESSION);

?>

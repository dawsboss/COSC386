<!DOCTYPE html>
<?php 
session_start();
include('BackUp.php');
?>

<html lang="en">
  <head>
    <meta charset="utf-8".>
    <meta name="viewport" content="width=device-width, initial scale=1">
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">
    <title>Signin Template for Bootstrap</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">
    <!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>
  <body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="search.php">Salisbury University</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="search.php">Search</a>
      </li>
      <?php
         if($_SESSION['admin']==true){
           echo"<li class=\"nav-item\">
             <a class=\"nav-link\" href=\"tempTableMenu.php\">Admin</a>
              </li>";
         }
      ?>
      <?php 
if($_SESSION['logged']!="null"){
echo "
  <li class='nav-item'>
    <form action='BackEnd.php' method='POST'>
      <input type='hidden' name='back' value= $_SERVER[REQUEST_URI]>
      <button type=\"submit\" class=\"btn btn-outline-secondary\" style='position:absolute; right:1%;' >Logout</button>
    </form>
  </li>
";
}else{
echo "
  <li class='nav-item'>
    <a class='nav-link' href='login.php'>Login</a>
  </li>
";
}

if($_SESSION['logged']!='null'){
echo "
  <li id='logname' class='nav-item'>
    <a class='nav-link' style='position:absolute; right:12%;' >Hello, ".$_SESSION['logged']."</a>
  </li>
  <script type='text/javascript'>
    document.getElementById('logname').onclick = function () {
      window.document.location = \"profile.php?p={$_SESSION['logged']}\"
    };
  </script>
  <style type=\"text/css\">
                .nav-item{
                cursor:pointer;
                }
  </style>
";
}
      ?>
    </ul>
  </div>
</nav>




  </body>
</html>

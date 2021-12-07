<!DOCTYPE html>
<html>
<head>
<title> Select table for admin edit</title>
<!--<style>
        <?php //include "style.css" ?>
        <?php //echo "hello"?>
</style>
<link rel="stylesheet" href="style.css">-->
<meta name="viewport" content="width=device-width, initial scale=1">
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link href="../../dist/css/bootstrap.min.css" rel="stylesheet">
<!-- <link href="style.css" rel="stylesheet"> -->
</head>
<body>
<?php
        include("BackEnd.php");
         if(!isset($_SESSION['admin'])){
           header("Location: search.php");
         }
?>

        <header class="header">
                <div class="jumbotron jumbotron-fluid" , style="width: auto; height: auto;">
                        <div class="container">
                        <div class="row">
                                <div class="col-12">
                                <?php echo "<h1 class='text-center'>Admin</h1>";?>
                                </div>
                        </div>
                        </div>
                </div>
        </header>
        <div class="container">
                <div class="row justify-content-md-center">
                        <div class="dropdown text-center">
                                <form method="post">
                                <select class="btn btn-outline-secondary dropdown-toggle" type="button"
                                aria-haspopup="true" aria-expanded="false" name="table" id="table">
                                        <option class="dropdown-item" value="Department">Department</option>
                                        <option class="dropdown-item" value="FundedBy">Funded By</option>
                                        <option class="dropdown-item" value="Grants">Grants</option>
                                        <option class="dropdown-item" value="Has">Has</option>
                                        <option class="dropdown-item" value="Login">Login</option>
                                        <option class="dropdown-item" value="Professor">Professor</option>
                                        <option class="dropdown-item" value="Research">Research</option>
                                        <option class="dropdown-item" value="School">School</option>
                                        <option class="dropdown-item" value="Student">Student</option>
                                        <option class="dropdown-item" value="WorkOn">Work On</option>
                                </select>
                        </div>
                </div>
                <div class="row justify-content-md-center">
                        <button type="submit" name='editButton' class="btn btn-outline-secondary" style="width:70px; margin-right: 16px; margin-top:6px;">Edit</button>
                        <button type="submit" name='addButton'  class="btn btn-outline-secondary" style="width:70px; margin-top:6px;">Add</button>
                        <button type="submit" name='deleteButton'  class="btn btn-outline-secondary" style="width:70px; margin-left: 16px; margin-top:6px; ">Delete</button>
                        </form>
                </div>
        </div>  
<?php
session_start();
$_SESSION['table']=$_POST['table'];
echo $_SESSION['table'];
if(isset($_POST['editButton'])){
  header('Location: tempUniEdit.php');
  exit();
}
else if(isset($_POST['addButton'])){
  header('Location: tempUniAdd.php');
  exit();
}
else if(isset($_POST['deleteButton'])){
  header('Location: uniDelete.php');//FILLER UNTIL uniDel.php IS MADE
  exit();
}
?>
</body>
</html>

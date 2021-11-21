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
        <header class="header">
                <div class="jumbotron jumbotron-fluid" , style="width: auto; height: auto;">
                        <div class="container">
                        <div class="row">
                                <div class="col-12">
                                <?php echo "<h1 class='text-center'>Admin Edit</h1>";print_r($_SESSION);?>
                                </div>
                        </div>
                        </div>
                </div>
        </header>
        <div class="container">
                <div class="dropdown text-center">
                        <form action="tempUniEdit.php" method="post">
                        <select class="btn btn-outline-secondary dropdown-toggle" type="button"
                            aria-haspopup="true" aria-expanded="false" name="table">
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
                        <input type="submit" name="submit" value="Go!" class="btn btn-outline-secondary">
                        </form>
                
                </div>
        </div>
</body>
<!-- <body>
<style>
.button{
  background-color:#910101;
  color: #ffffff;
  padding: 15px 15px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  border-radius: 17%;
}
.button:hover{
        color=#ffffff;
        background-color: #b00000;
}
</style>
<div class="header">
        <h1><b>Admin Edit</b></h1>
</div>
<center>
<label for "table" style="font-size: 150%;"> Select a Table: </label>
            <form action="uniEdit.php" method="post">
                     <select name="table" id="table">
                                     <option value="Department">Department</option>
                                     <option value="FundedBy">Funded By</option>
                                     <option value="Grants">Grants</option>
                                     <option value="Has">Has</option>
                                     <option value="Login">Login</option>
                                     <option value="Professor">Professor</option>
                                     <option value="Research">Research</option>
                                     <option value="School">School</option>
                                     <option value="Student">Student</option>
                                        <option value="WorkOn">Work On</option>
                                        </select>
                                        <br>
                                        <input type="submit" name="submit" value="Go!" class="button">
                                    </form>
</center>
</body> -->
</html>

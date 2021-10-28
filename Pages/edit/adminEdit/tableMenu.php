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
<link href="style.css" rel="stylesheet">
</head>
<body>
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
        <h1><b>Admin edit</b></h1>
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
</body>
</html>

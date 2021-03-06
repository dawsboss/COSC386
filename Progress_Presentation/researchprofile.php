<!DOCTYPE html>

<?php
session_start();
include("../BackEnd.php");
if ( !$_GET['r'] ):
  header('Location: ../Search/testing.php');#TODO Go to search page
endif;


?>

<html lang="en">
  <head>	
  <title><?php echo $research['Title']; ?></title>
    <meta charset="utf-8".>
    <meta name="viewport" content="width=device-width, initial scale=1">
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
 </head>
<body>
    <header class="header" style="position: relative; top: -50px;">
    <?php include ("../navbar.php");?>
        <div class="jumbotron jumbotron-fluid", style="width: auto; height: auto;">
          <div class="container">
          <?php
            
            if($_SESSION['admin'] == true || in_array($_SESSION['logged'], $profs) ):
              echo "<a type='button' class='btn btn-warning' href='#'> Edit </a>";
            endif;
            if ( !$research ):
              echo "<h1 class='text-center'>NO PROFILE</h1>";
            else:
              echo session_id();
              echo "<h1 class='text-center'>{$research['Title']}<br>".print_r($_SESSION)."<br>".session_id()."</h1>";
            endif;
          ?>
          </div>
        </div>
    </header>
    <div class="container"> 
        <div class= "row">       
            <div class= "col-3" style="position: relative; top: -85px;">
                <div class="mt-4 card" style="width: 17rem;">
                    <div class="card-body">
                        <h5 class="card-title">Description</h5>
        <p class="card-text"><?php echo $research['Description'];?>
                        <h5 class="card-title">Contact</h5>
        <p class="card-text">Link(s):<br><?php echo $research['Link'];?></p>
        <p class="card-text">Phone:<br><?php echo $profile['PhoneNum'];?></p>
        <p class="card-text">Office:<br><?php echo $profile['OfficeLoc'];?>Sample data to show that the box will stretch down as you add more text so it fits the screen better. Man this really should have gone in the Description portion but oh well... here we are</p>
                    </div>
                </div>
            </div>
            <div class="col-9" style="position: relative; top: -60px; height: auto">
                <div class="mb-4 card" style="width: 55rem;">
                    <div class="card-body">
                        <h5 class="card-title">Abstract</h5>
                        <p class="card-text"><?php echo $research['Abstract'];?></p>
                    </div>
                </div>
		<table class="table" border="5">
		<tr>
			<th colspan = "2">
			 <h3 style = "text-align: center"><br> Students </h3>
			</th>
		</tr>
				<tr>
				 <td> Test 1 </td>
				 <td> Test 2 </td>
				</tr>
				<tr>
				 <td> Test 3 </td>
				 <td> Test 4 </td>
				</tr>
				<?php
			  	foreach($students as $printstudents){
			    	echo "Hello"; 
		 	    	echo "<tr>"; 
			    	echo "<td>{$printstudents['Email']}</td>";
			    	echo "<td>{$printstudents['Name']}</td>";
                            	echo "</tr>";
			  	}?>
                </table>
		<table class="table" border="5">
		<tr>
			<th colspan = "2">
			 <h3 style = "text-align: center"><br> Grants Provided </h3>
			</th>
		</tr>
				<tr>
				 <td> Test 1 </td>
				 <td> Test 2 </td>
				</tr>
				<tr>
				 <td> Test 3 </td>
				 <td> Test 4 </td>
				</tr>
				<?php 
                          	foreach($grants as $printgrant){
		 	    	echo "<tr>"; 
                            	echo "<td>{$printgrant['Organization']}</td>";
                            	echo "<td>{$printgrant['Year']}</td>";
			    	echo "<td>{$printgrant['Amount']}</td>";
                            	echo "</tr>";
			  	}?>
                </table>
            </div>
        </div>
        </div>
    </div>
</body>
</html>

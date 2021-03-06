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
                <div class="mt-4 card" style="width: 17rem; border: 4px solid black">
                    <div class="card-body">
                        <h5 class="card-title">Description</h5>
        <p class="card-text"><?php echo $research['Description'];?>
                        <h5 class="card-title">Contact</h5>
        <p class="card-text">Link(s):<br><?php echo $research['Link'];?></p>
        <p class="card-text">Phone:<br><?php echo $profile['PhoneNum'];?></p>
        <p class="card-text">Office:<br><?php echo $profile['OfficeLoc'];?></p>
                    </div>
                </div>
            </div>
            <div class="col-9" style="position: relative; top: -60px; height: auto">
                <div class="mb-4 card" style="width: 55rem; border: 4px solid black">
                    <div class="card-body">
                        <h5 class="card-title">Abstract</h5>
                        <p class="card-text"><?php echo $research['Abstract'];?></p>
                    </div>
                </div>
			<h3 style = "text-align: center"><br> Students </h3>
			<table class = "table" border = "5" style = "width: 55rem">
				<thead>
					<tr>
					<th scope = "col"> Email</th>
					<th scope = "col"> Name</th>
					</tr>
				</thead>
				<tbody>
				<?php
	      			$EmailCount = 0;
	      			$NameCount = 1;
	      			foreach($students as $printstudents){
		 	    	    echo "<tr>"; 
			     	    echo "<td>{$students[$EmailCount]}</td>";
			    	    echo "<td>{$students[$NameCount]}</td>";
				    echo "</tr>";
				    $EmailCount += 2;
				    $NameCount += 2;
				}?>
				</tbody>
                	</table>
			<h3 style = "text-align: center"><br> Grants </h3>
			<table class = "table" border = "5" style = "width: 55rem">
				<thead>
					<tr>
					<th scope = "col"> Organization</th>
					<th scope = "col"> Year</th>
					<th scope = "col"> Amount</th>
					</tr>
				</thead>
				<tbody>
				<?php 
				$OrgCount = 0;
			        $yearCount = 1;
		                $AmountCount = 2;		    
                          	foreach($grants as $printgrant){
				    echo "<tr>"; 
                                    echo "<td>{$grants[$OrgCount]}</td>";
                            	    echo "<td>{$grants[$yearCount]}</td>";
			    	    echo "<td>{$grants[$AmountCount]}</td>";
				    echo "</tr>";
				    $OrgCount += 3;
				    $yearCount += 3;
				    $AmountCount += 3;
			  	}?>
				</tbody>
                	</table>
            </div>
        </div>
        </div>
    </div>
</body>
</html>

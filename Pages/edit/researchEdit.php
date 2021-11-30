<!DOCTYPE html>

<?php
session_start();
include("../BackEnd.php");
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
    <header class="header" style="position: relative; margin-bottom: 100px;">
    <?php include ("../navbar.php");?>
        <div class="jumbotron jumbotron-fluid", style="width: auto; height: auto;">
          <div class="container">
          <?php

            if($_SESSION['admin'] == true || in_array($_SESSION['logged'], $profs) ):
                            echo "<a type='button' class='btn btn-warning' href='#'> Edit </a>";
                        endif;
                        if ( !$research ):
                                        echo "<h1 class='text-center'>NO RESEARCH</h1>";
                                    else:
                                      echo "<h1 class='text-center'><textarea name=\"title\" rows=\"2\" cols=\"30\">{$research['Title']}</textarea></h1>";
                                    endif;
                                  ?>
          </div>
        </div>
    </header>
    <div class="container"> 
        <div class= "row">       
            <div class= "col-3" style="position: relative; top: -84px;">
                <div class="mt-4 card" style="width: 17rem; border: 4px solid black; height: auto">
                    <div class="card-body">
                        <h5 class="card-title">Description</h5>
        <form name="rGetInfo" action="" method="post">
        <p class="card-text"><textarea name="description" rows="4" cols="22"><?php echo $research['Description'];?></textarea>
        <p class="card-text">Link(s):<br><input type="text" name="link" value="<?php echo $research['Link'];?>" size="22"></p>
                    </div>
                </div>
            </div>
            <div class="col-9" style="position: relative; top: -60px; height: auto">
                <div class="mb-4 card" style="width: 55rem; border: 4px solid black">
                    <div class="card-body">
<h5 class="card-title">Abstract</h5>
                        <p class="card-text">
                          <textarea name="abstract" rows="4" cols="89"><?php echo $research['Abstract'];?></textarea>
                        </p>
                    </div>
                </div>
      <h3 style = "text-align: center"><br> Students </h3>
      <table class = "table" border = "4" style = "width: 55rem">
        <thead>
          <tr>
          <th scope = "col"> Email</th>
          <th scope = "col"> Name</th>
          </tr>
        </thead>
        <tbody>
        <?php
              $stuCount=0;
              foreach($students as $printstudents){
                echo "<tr>"; 
                echo "<td><input type=\"text\" name=\"stuEmail".$stuCount."\" value=\"{$printstudents['Email']}\" size=\"30\"></td>";
                echo "<td><input type\"text\" name=\"stuName".$stuCount."\" value=\"{$printstudents['Name']}\" size=\"25\"></td>";
                echo "</tr>";
                $stuCount=$stuCount+1;
        }?>
        </tbody>
      </table>
      <h3 style = "text-align: center"><br> Grants </h3>
      <table class = "table" border = "4" style = "width: 55rem">
        <thead>
          <tr>
          <th scope = "col"> Organization</th>
          <th scope = "col"> Year</th>
          <th scope = "col"> Amount</th>
          </tr>
        </thead>
        <tbody>
        <?php 
          $graCount=0;
          foreach($grants as $printgrant){
            echo "<tr>"; 
            echo "<td><input type=\"text\" name=\"graOrg".$graCount."\" value=\"{$printgrant['Organization']}\" size=\"10\"></td>";
            echo "<td><input type=\"text\" name=\"graYear".$graCount."\" value=\"{$printgrant['year']}\" size=\"10\"></td>";
            echo "<td><input type=\"text\" name=\"graOrg".$graCount."\" value=\"{$printgrant['Amount']}\" size=\"10\"></td>";
            echo "</tr>";
            $graCount=$graCount+1;
          }
        ?>
        </tbody>
                  </table>
            </div>
        </div>
        </div>
    </div>
  <center><input type="submit" value="Submit Changes" class="button"></center>
    <?php
      echo "Testing php for submit query\n";
    ?>
    </form>
</body>
</html>

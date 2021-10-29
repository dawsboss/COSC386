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
    <header class="header" style="position: relative; top: -50px;">
        <div class="jumbotron jumbotron-fluid", style="width: auto; height: auto;">
          <div class="container">
          <h1 class="text-center"><?php echo $research['Title'];?></h1>
          </div>
        </div>
    </header>
    <div class="container"> 
        <div class= "row">       
            <div class= "col-3" style="position: relative; top: -60px;">
            <img style="width: 17rem;height: 300px"  src="https://0utwqfl7.cdn.imgeng.in/_images/headshots/profile/jtanderson.jpg" alt="logo"/>   
                <div class="mt-4 card" style="width: 17rem;">
                    <div class="card-body">
                        <h5 class="card-title">Description</h5>
        <p class="card-text"><?php echo $research['Description']; $bio?>
                        <h5 class="card-title">Contact</h5>
        <p class="card-text">Link<br><?php echo $research['Link'];?>@salisbury.edu</p>
        <p class="card-text">Phone:<br><?php echo $profile['PhoneNum'];;?></p>
        <p class="card-text">Office:<br><?php echo $profile['OfficeLoc'];?></p>
                    </div>
                </div>
            </div>
            <div class="col-9" style="position: relative; top: -60px;">
                <div class="mb-4 card" style="width: 55rem;">
                    <div class="card-body">
                        <h5 class="card-title">Abstract</h5>
                        <p class="card-text"><?php echo $research['Abstract'];?></p>
                    </div>
                </div>
                <h3> Current Research</h3>
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--<tr>
                        <td>Naive Floating Body</td>
                        <td>Exploring the proof of a faster method to approximate the Floating Body of a convex polytope.</td>
                        </tr>
                        <tr>
                        <td>Gaussian Mixture Models</td>
                        <td>Using methods in Convex Geometry to assist in Rust Learning of Gaussian Mixture Models</td>
                        </tr>-->
                        <?php 
                          foreach($currentresearch as $printpast){
                            echo "<tr>"; 
                            echo "<td>{$printpast['Title']}</td>";
                            echo "<td>{$printpast['Description']}</td>";
                            echo "</tr>";
                          } 
                        ?>
                    </tbody>
                </table>
                <h3> Past Research</h3>
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--<tr>
                        <td>Efficiency of the floating body as a robust measure of dispersion.</td>
                        <td>Exploring the proof of a faster method to approximate the Floating Body of a convex polytope.</td>
                        </tr>
                        <tr>
                        <td>Heavy-Tailed Analogues of the Covariance Matrix for ICA</td>
                        <td>Using methods in Convex Geometry to assist in Rust Learning of Gaussian Mixture Models</td>
                        </tr>
                        <tr>
                        <td>Heavy-Tailed Independent Component Analysis</td>
                        <td>Using methods in Convex Geometry to assist in Rust Learning of Gaussian Mixture Models</td>
                        </tr>-->
                            <?php 
                              foreach($pastresearch as $printpast){
                                echo "<tr>"; 
                                echo "<td>{$printpast['Title']}</td>";
                                echo "<td>{$printpast['Description']}</td>";
                                echo "</tr>";
                              } 
                            ?>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
</body>
</html>

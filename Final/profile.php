<!DOCTYPE html>

<?php
if ( !$_GET['p'] ):
  header('Location: search.php');#TODO go back to search screen
endif;
session_start();
include("BackEnd.php");
?>

<html lang="en">
<style>
.container a {
  color: #000;
  text-decoration: none;
}

.table-row{
  cursor:pointer;
}
</style>
  <head>	
  <title><?php echo $profile['Name']; ?></title>
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
      <?php include ("navbar.php"); ?>
        <div class="jumbotron jumbotron-fluid", style="width: auto; height: auto;">
          <div class="container">
            <?php
              if ($_SESSION['logged'] == $profile['Username'] || $_SESSION['admin'] == true):
              echo "<a type='button' class='btn btn-warning' href='#'> Edit </a>";
              endif;
            ?>
            <h1 class="text-center"><?php echo $profile['Name'];?></h1>
          </div>
        </div>
    </header>
    
    <div class="container"> 
        <div class= "row">       
            <div class= "col-3" style="position: relative; top: -60px;">
            <img style="width: 17rem;height: 300px"  src="https://0utwqfl7.cdn.imgeng.in/_images/headshots/profile/<?php echo $profile['Username'];?>.jpg" alt="logo"/>   
                <div class="mt-4 card" style="width: 17rem;">
                    <div class="card-body">
                        <h5 class="card-title">Bio</h5>
        <p class="card-text"><?php echo $profile['Bio']; $bio?>
                        <h5 class="card-title">Contact</h5>
        <p class="card-text">Email:<br><?php echo $profile['Username'];?>@salisbury.edu</p>
        <p class="card-text">Phone:<br><?php echo $profile['PhoneNum'];;?></p>
        <p class="card-text">Office:<br><?php echo $profile['OfficeLoc'];?></p>
                    </div>
                </div>
            </div>
            <div class="col-9" style="position: relative; top: -60px;">
                <div class="mb-4 card" style="width: 55rem;">
                    <div class="card-body">
                        <h5 class="card-title">Research Statement</h5>
                        <p class="card-text"><?php echo $profile['ResearchStatement'];?></p>
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
                        <?php
                          foreach($currentresearch as $printpast){
                            echo "<tr class='table-row' data-href='https://lamp.salisbury.edu/~bmason3/COSC386-1/Final/researchprofile.php?r={$printpast['ID']}'>";
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
                            echo "<tr class='table-row' data-href='https://lamp.salisbury.edu/~bmason3/COSC386-1/Final/researchprofile.php?r={$printpast['ID']}'>";
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
<script type="text/javascript">
  $(document).ready(function($) {
    $(".table-row").click(function() {
      window.document.location = $(this).data("href");
    });
  });
</script>
</html>


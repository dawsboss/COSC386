<!DOCTYPE html>

<?php
if ( !$_GET['p'] ):
  header('Location: "search.php"');#TODO go back to search screen
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




    <header class="header" >
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Salisbury University</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="search.php">Search</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="login.php">Login</a>
      </li>
      <!--<li class="nav-item">
        <a class="nav-link" href="#">Pricing</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown link
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>-->
    </ul>
  </div>
</nav>
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
                            echo "<tr class='table-row' data-href=https://lamp.salisbury.edu/~gdawson1/GitHub/COSC386/Progress_Presentation/researchprofile.php?r={$printpast['ID']}>";
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
                            echo "<tr class='table-row' data-href=https://lamp.salisbury.edu/~gdawson1/GitHub/COSC386/Progress_Presentation/researchprofile.php?r={$printpast['ID']}>";
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


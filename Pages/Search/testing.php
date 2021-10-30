<!DOCTYPE html>
<?php
session_start();
include("../BackEnd.php");
?>
<html lang="en">
<head>
    
    <title>Search</title>
    <meta charset="utf-8" .>
    <meta name="viewport" content="width=device-width, initial scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <header class="header">
        <div class="jumbotron jumbotron-fluid" , style="width: auto; height: 170px;">
            <div class="container">
                <div class="row">
                    <div class="col-11">
                        <h1 class="text-center">Begin Your Research Journey Here</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="row">
        <form method="get">
            <div class="col-11">
                <div class="input-group">
                    <input type="text" class="form-control" aria-label="Text input with dropdown button" name="q">
                    <div class="input-group-append">
                        <select class="btn btn-outline-secondary dropdown-toggle" type="button"
                            aria-haspopup="true" aria-expanded="false" name="f">
                            <option  class="dropdown-item" value="" disabled selected>Choose option</option>
                            <option  class="dropdown-item" value="Name">Name</option>
                            <option  class="dropdown-item" value="ResearchStatement">Research Interest</option>
                            <option  class="dropdown-item" value="DeptName">Department</option>
                            <option  class="dropdown-item" value="Availability">Availability</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-1">
                <input class="btn btn-outline-secondary float-right" type="submit">
            </div>
            </form>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="mt-2 col-11">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Research Interest</th>
                            <th scope="col">Department</th>
                            <th scope="col">Availability</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                          print_r($search);
                          foreach($search as $printpast){
                            echo "<tr>"; 
                            echo "<td>{$printpast['Name']}</td>";
                            echo "<a href=\"https://lamp.salisbury.edu/~gdawson1/GitHub/COSC386/Pages/ProfProfile/profile.php?p={$printpast['Username']}\" class='stretched-link'></a>";
                            echo "</tr>";
                          } 
                        ?>
                        <!-- <tr>
                            <td>Seth Friese</td>
                            <td>Synthetic Organic Chemistry</td>
                            <td>Chemistry</td>
                            <td>Not Available</td>
                            <a href="#" class="stretched-link"></a>
                        </tr> -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
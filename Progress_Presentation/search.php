<!DOCTYPE html>
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
    <?php
        include ("BackEnd.php");
    ?>
    <header class="header">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Salisbury University</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="search.php">Search<span class="sr-only">(current)</span></a>
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
    <form method="get">
        <div class="row">
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
        </div>
        </form>
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
                          foreach($search as $printpast){
                            echo "<tr>"; 
                            echo "<tr class='table-row' data-href=\"https://lamp.salisbury.edu/~gdawson1/GitHub/COSC386/Progress_Presentation/profile.php?p={$printpast['Username']}\" class='stretched-link'></th>";
                            echo "<td>{$printpast['Name']}</td>";
                            echo "<td>{$printpast['ResearchStatement']}</td>";
                            echo "<td>{$printpast['DeptName']}</td>";
                            echo "<td>{$printpast['Availability']}</td>";
                            echo "</tr>";
                          } 
                        ?>
                    </tbody>
                </table>
                <script type="text/javascript">
                $(document).ready(function($) {
                    $(".table-row").click(function() {
                        window.document.location = $(this).data("href");
                    });
                });
                </script>
                <style type="text/css">
                .table-row{
                cursor:pointer;
                }
                </style>
            </div>
        </div>
    </div>
</body>

</html>

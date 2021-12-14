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
        include ("navbar.php");
        session_start();
    ?>
    <header class="header">
        <div class="jumbotron jumbotron-fluid" , style="width: auto; height: auto;">
            <div class="container">
                <div class="row">
                    <div class="col-11">
                      <?php echo "<h1 class='text-center'>Begin Your Research Journey Here</h1>";?>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
    <form method="get">
        <div class="row">
            <div class="col-10">
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
                <button class="btn btn-outline-secondary float-right" type="submit">Search</button>
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
                            echo "<tr class='table-row' data-href=\"profile.php?p={$printpast['Username']}\" class='stretched-link'></th>";
                            echo "<td>{$printpast['Name']}</td>";
                            echo "<td>{$printpast['ResearchStatement']}</td>";
                            echo "<td>{$printpast['DeptName']}</td>";
                            if($printpast['Availability'] == 1):
                                echo "<td>Available</td>";
                            else:
                                echo "<td>Unavailable</td>";
                            endif;
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

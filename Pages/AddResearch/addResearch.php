<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Research</title>
    <meta charset="utf-8" .>
    <meta name="viewport" content="width=device-width, initial scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<!-- <header class="header" style="position: relative; top: -50px;">
    <div class="jumbotron jumbotron-fluid" , style="width: auto; height: auto;">
        <div class="container">
            <?php /*
            if ($_SESSION['logged'] == $profile['Username'] || $_SESSION['admin'] == true) :
                echo "<a type='button' class='btn btn-warning' href='#'> Edit </a>";
            endif;*/
            ?>
            <h1 class="text-center"><?php /* echo $profile['Name'];
                                    echo "<br>";
                                    print_r($_SESSION);
                                    echo "<br>";
                                    echo session_id(); */ ?></h1>
        </div>
    </div>
</header> -->

<body>

    <?php

    session_start();
    include('../BackEnd.php');
    include('../navbar.php');

    ?>
    <div class="container mt-5">
        <form action="submitResearch.php" method="post">


            <div class="row g-3">
                <div class="col-md-12">
                    <label for="researchTitle">Research Title</label>
                    <div class="row g-3">


                        <div class="col-md-10">

                            <input type="text" class="form-control" name="rtitle">
                        </div>
                        <div class="col-md-2">

                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">Ongoing Research?</label>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row g-3">
                <div class="col-md-12">
                    <label for="researchDesc">Research Description</label>
                    <textarea class="form-control" rows="5" name="rdesc"></textarea>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="researchAbstract">Abstract</label>
                    <textarea class="form-control" rows="5" name="rabstract"></textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-primary" name="Submit">Submit</button>
        </form>
    </div>
</body>


</html>
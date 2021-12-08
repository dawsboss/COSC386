<!-- Justin Ventura -->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Research Information</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <?php
    include('BackEnd.php');
    include('navbar.php');

    if (!($connect = @mysqli_connect('localhost', 'gdawson1', 'gdawson1', 'SUResearchProjDB'))) {
        echo "<p>Connection Failed in submitResearch.php</p>";
    }

    # Check for the submit POST:
    if (isset($_POST['submit'])) {
        # Collect data from submit text fields:
        $research_title = $_POST['rtitle'];
        $research_desc = $_POST['rdesc'];
        $research_link = $_POST['rlink'];
        $research_abstract = $_POST['rabstract'];

        # Collect data from the submit checkbox:
        if (isset($_POST['ongoing'])) $is_ongoing = 1;
        else $is_ongoing = 0;

        # Prepare and execute the database post:
        $r_query = $connect->prepare("INSERT INTO Research(Description, Abstract, Link, Title, Current) VALUES(?, ?, ?, ?, ?)");
        $r_query->bind_param(
            "ssssi",
            $research_desc,
            $research_abstract,
            $research_link,
            $research_title,
            $is_ongoing
        );
        $r_query->execute();

        $r_id = $connect->insert_id;
        echo "New research profile created successfully. Last inserted ID is: " . $r_id;

        # Now we must change the Has relation:
        $h_query = $connect->prepare("INSERT INTO Has(Username, researchID) VALUES(?, ?)");
        $h_query->bind_param(
            "si",
            $_SESSION['logged'],
            $r_id
        );
        $h_query->execute();
        $h_query->close();
        $r_query->close();
    }
    $connect->close();

    ?>

    <div class="container mt-5">
        <form name="submit" action="https://lamp.salisbury.edu/~jventura3/COSC386/Pages/AddResearch/submitResearch.php" method="post">
            <div class="row g-3 mb-2">
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
                <div class="col-md-12 mb-2">
                    <label for="researchDesc">Research Description</label>
                    <textarea class="form-control" rows="5" name="rdesc"></textarea>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="researchAbstract">Abstract</label>
                    <textarea class="form-control" rows="5" name="rabstract"></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
</body>


</html>
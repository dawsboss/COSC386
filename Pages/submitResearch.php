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
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

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

        # Now we must change the Has relation:
        $h_query = $connect->prepare("INSERT INTO Has(Username, researchID) VALUES(?, ?)");
        $h_query->bind_param(
            "si",
            $_SESSION['logged'],
            $r_id
        );
        $h_query->execute();
        $r_query->close();
        $h_query->close();

        # If there is a grant, add it:
        if (isset($_POST['gamount'])) {
            $g_query = $connect->prepare("INSERT INTO Grants(Amount, year, Organization) VALUES(?, ?, ?)");
            $g_query->bind_param(
                "iss",
                $_POST['gamount'],
                $_POST['gyear'],
                $_POST['gorg']
            );
            $g_query->execute();
            $g_query->close();
            $g_id = $connect->insert_id;

            $fundedby_query = $connect->prepare("INSERT INTO FundedBy(GrantID, researchID) VALUES(?, ?)");
            $fundedby_query->bind_param(
                "ii",
                $g_id,
                $r_id
            );
            $fundedby_query->execute();
            $fundedby_query->close();
        }
        # If there is a student, add them:
        if (isset($_POST['sname'])) {
            $s_query = $connect->prepare("INSERT INTO Student(Email, Name) VALUES(?, ?)");
            $s_query->bind_param(
                "ss",
                $_POST['semail'],
                $_POST['sname']
            );
            $s_query->execute();
            $s_query->close();

            $workon_query = $connect->prepare("INSERT INTO WorkOn(researchID, studentEmail) VALUES(?, ?)");
            $workon_query->bind_param(
                "is",
                $r_id,
                $_POST['semail']
            );
            $workon_query->execute();
            $workon_query->close();
        }
    }
    $connect->close();

    ?>

    <div class="container mt-5">
        <form name="submit" action="https://lamp.salisbury.edu/~jventura3/COSC386/Pages/submitResearch.php" method="post">
            <div class="row g-3 mb-2">
                <div class="col-md-12">
                    <label for="researchTitle">Research Title</label>
                    <div class="row g-3">
                        <div class="col-md-10">
                            <input type="text" class="form-control shadow-sm rounded" name="rtitle">
                        </div>
                        <div class="col-md-2">
                            <input class="form-check-input shadow-sm rounded" type="checkbox" value="" name="ongoing" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">Ongoing Research?</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-3 mb-2">
                <div class="col-md-12">
                    <label for="researchLink">Link</label>
                    <input type="text" class="form-control shadow-sm rounded" name="rlink">
                </div>
            </div>
            <div class="row g-3 mb-2">
                <div class="col-md-12 mb-2">
                    <label for="researchDesc">Research Description</label>
                    <textarea class="form-control shadow-sm rounded" rows="5" name="rdesc"></textarea>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="researchAbstract">Abstract</label>
                    <textarea class="form-control shadow-sm rounded" rows="5" name="rabstract"></textarea>
                </div>
            </div>
            <div class="row g-3 mb-2">
                <div class="col-md-2 mb-2">
                    <label for="grantAmount">Grant Amount (USD)</label>
                    <input type="text" class="form-control shadow-sm rounded" name="gamount">
                </div>
                <div class="col-md-2 mb-2">
                    <label for="grantYear">Grant Year</label>
                    <input type="text" class="form-control shadow-sm rounded" name="ryear">
                </div>
                <div class="col-md-8 mb-2">
                    <label for="grantOrg">Organization</label>
                    <input type="text" class="form-control shadow-sm rounded" name="gorg">
                </div>
            </div>
            <div class="row g-3 mb-2">
                <div class="col-md-6">
                    <label for="studentName">Student Researcher Name</label>
                    <input type="text" class="form-control shadow-sm rounded" name="sname">
                </div>
                <div class="col-md-6">
                    <label for="studentEmail">Student Email</label>
                    <input type="text" class="form-control shadow-sm rounded" name="semail">
                </div>
            </div>
            <button type="submit" class="btn btn-primary shoadow-sm" name="submit">Submit</button>
        </form>
    </div>
</body>


</html>
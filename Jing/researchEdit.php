<!DOCTYPE html>

<?php
session_start();
include("BackEnd.php");
require_once("config.php");
?>

<html lang="en">

<head>
  <title><?php echo $research['Title']; ?></title>
  <meta charset="utf-8" .>
  <meta name="viewport" content="width=device-width, initial scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
  <header class="header" style="position: relative; margin-bottom: 100px;">
    <?php include("navbar.php"); ?>
    <div class="jumbotron jumbotron-fluid" , style="width: auto; height: auto;">
    <?php
            if ($_SESSION['logged'] == $profile['Username'] || $_SESSION['admin'] == true):
              echo "<form action='researchprofile.php' method='get'>
                <input type='hidden' name='r' value='{$research['ID']}'>
                <input type='submit' class='btn btn-outline-secondary float-left ml-2' value='Back'>
                </form>";
              endif;
        ?>
      <div class="container">
        <form name="rGetInfo" action="" method="post">
          <?php
          if ($_SESSION['logged'] != $profile['Username'] && $_SESSION['admin'] != true){
       header("Location: search.php");
    }
          if (!$research) :
            echo "<h1 class='text-center'>NO RESEARCH</h1>";
          else :
            echo "<h1 class='text-center'>
            <textarea name=\"title\" rows=\"2\" cols=\"30\">{$research['Title']}
            </textarea>
            </h1>";
          endif;
          ?>
      </div>
    </div>
  </header>
  <div class="container">
    <div class="row">
      <div class="col" style="position: relative; top: -84px;">
        <div class="mt-4 card" style="width: 20rem;">
          <div class="card-body">
            <h5 class="card-title">Description</h5>
            <p class="card-text"><textarea name="description" rows="4" cols="50"><?php echo $research['Description']; ?></textarea>
            <p class="card-text">Link(s):<br><input type="text" name="link" value="<?php echo $research['Link']; ?>" size="22"></p>
          </div>
        </div>
      </div>
      <div class="col" style="position: relative; top: -60px; height: auto">
        <div class="mt-4 card" style="width: 59rem;">
          <div class="card-body">
            <h5 class="card-title">Abstract</h5>
            <p class="card-text">
              <textarea name="abstract" rows="4" cols="89"><?php echo $research['Abstract']; ?></textarea>
            </p>
          </div>
        </div>
        <h3 style="text-align: center"><br> Students </h3>
        <table class="table">
          <thead>
            <tr>
              <th scope="col"> Email</th>
              <th scope="col"> Name</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $stuCount = 0;
            foreach ($students as $printstudents) {
              echo "<tr>";
              echo "<td><input type=\"text\" name=\"stuEmail" . $stuCount . "\" value=\"{$printstudents['Email']}\" size=\"30\"></td>";
              echo "<td><input type\"text\" name=\"stuName" . $stuCount . "\" value=\"{$printstudents['Name']}\" size=\"25\"></td>";
              echo "</tr>";
              $stuCount = $stuCount + 1;
            } ?>
            <!--<tr><td><a href="https://www.google.com"><button>add a new student</button></a></td><tr></td></tr>-->
          </tbody>
        </table>
        <h3 style="text-align: center"><br> Grants </h3>
        <table class="table">
          <thead>
            <tr>
              <th scope="col"> Organization</th>
              <th scope="col"> Year</th>
              <th scope="col"> Amount</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $graCount = 0;
            foreach ($grants as $printgrant) {
              echo "<tr>";
              echo "<td><input type=\"text\" name=\"graOrg" . $graCount . "\" value=\"{$printgrant['Organization']}\" size=\"10\"></td>";
              echo "<td><input type=\"text\" name=\"graYear" . $graCount . "\" value=\"{$printgrant['year']}\" size=\"10\"></td>";
              echo "<td><input type=\"text\" name=\"graAmount" . $graCount . "\" value=\"{$printgrant['Amount']}\" size=\"10\"></td>";
              echo "</tr>";
              $graCount = $graCount + 1;
            }
            $_SESSION['rID'] = $research['ID'];
            $rID = $_SESSION['rID'];
            //echo $_SESSION['rID'];
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  </div>
  <center><button type="submit" class="btn btn-outline-secondary mb-4 ml-2">Submit</submit>
    </form>
    <?php
    if (isset($_POST['abstract'])) {
      $rQuery = "update Research set Description='" . $_POST['description'] . "', Abstract='" . $_POST['abstract'] . "', Link='" . $_POST['link'] . "', Title='" . $_POST['title'] . "' where ID = $rID";
      //echo "<br> $rQuery <br>";
      $editResearch = mysqli_query($connect, $rQuery);
      $gCount = 0;
      foreach ($grants as $getGrantInfo) {
        $tempA = "graAmount" . $gCount;
        $tempY = "graYear" . $gCount;
        $tempO = "graOrg" . $gCount;
        $gQuery = "update Grants set Amount='" . $_POST[$tempA] . "', year=" . $_POST[$tempY] . ", Organization='" . $_POST[$tempO] . "' where Amount='" . $getGrantInfo['Amount'] . "' and year=" . $getGrantInfo['year'] . " and Organization='" . $getGrantInfo['Organization'] . "'";
        $editGrant = mysqli_query($connect, $gQuery);
        if ($editGrant) {
          //echo "<br>editGrant Successful<br>";
        } else {
          //echo "<br>editGrant unsuccessful<br>";
        }
        $gCount = $gCount + 1;
      }
      $sCount = 0;
      foreach ($students as $getStudInfo) {
        $tempN = "stuName" . $sCount;
        $tempE = "stuEmail" . $sCount;
        $sQuery = "update Student set Email='" . $_POST[$tempE] . "', Name='" . $_POST[$tempN] . "' where Email='" . $getStudInfo['Email'] . "'";
        //echo"<br>$sQuery";
        $editStudent = mysqli_query($connect, $sQuery);
        if ($editStudent) {
          //echo "<br>student edited successfuly<br>";
        } else {
          //echo "<br>student edit unsuccessful<br>";
        }
        $wQuery = "update WorkOn set studentEmail='" . $_POST[$tempE] . "' where studentEmail='" . $getStudInfo['Email'] . "' and researchID=$rID";
        //echo $wQuery;
        $editWorkOn = mysqli_query($connect, $wQuery);
        if ($editWorkOn) {
          //echo "<br> workon edited successfuly<br>";
        } else {
          //echo "<br> workon edit unsuccessful<br>";
        }
        $sCount = $sCount + 1;
      }
    }
    ?>
    <form name="editStudent" action="addStudent.php" method="get">
      <input type="hidden" name="r" value="<?php echo $rID; ?>">
      <button type="submit" class="btn btn-outline-secondary mb-4 ml-2">Add/Remove Student</submit>
    </form>
    <form name="editGrants" action="addGrant.php" method="get">
      <input type="hidden" name="r" value="<?php echo $rID; ?>">
      <button type="submit" class="btn btn-outline-secondary mb-4 ml-2">Add/Remove Grant</submit>
    </form>
  </center>
</body>

</html>
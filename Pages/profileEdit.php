<!DOCTYPE html>

<?php
session_start();
include("BackEnd.php");
?>

<html lang="en">
  <head>
  <title><?php echo $profile['Name']; ?> Edit</title>
    <meta charset="utf-8".>
    <meta name="viewport" content="width=device-width, initial scale=1">
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
 </head>
<body>
    <header class="header" style="position: relative; top: -70px;">
      <?php include ("navbar.php");?>
        <div class="jumbotron jumbotron-fluid", style="width: auto; height: auto;">
          <div class="container">
          <h1 class="text-center"><?php echo $profile['Name'];?></h1>
          </div>
        </div>
    </header>
    <?php
      if($connection = @mysqli_connect('localhost','jfernandez3','jfernandez3','SUResearchProjDB')){
        //echo "<br> connection successful<br>";
      }
    ?>
    <div class="container">
        <div class= "row">
            <div class= "col-3" style="position: relative; top: -60px;">
            <img style="width: 17rem;height: 300px"  src="https://0utwqfl7.cdn.imgeng.in/_images/headshots/profile/<?php echo $profile['Username'];?>.jpg" alt="logo"/>
                <div class="mt-4 card" style="width: 17rem;">
                    <div class="card-body">
                        <h5 class="card-title">Bio</h5>
        <p class="card-text">
        <form name="getInfo" action="" method="post">
              <input type="text" name="bio" id="bio" value="<?php echo $profile['Bio']; //$bio?>">
                        <h5 class="card-title">Contact</h5>
        <p class="card-text">Email:<br>
             <input type="text" name="email" value="<?php echo $profile['Username'];?>">@salisbury.edu
        </p>
        <p class="card-text">Phone:<br><!--<form name="getPhone" action="" method="post">-->
                 <input type="text" name="phoneNum" value="<?php echo $profile['PhoneNum'];?>">
                 </p>
        <p class="card-text">Office:<br>
                  <input type="text" name="office" value="<?php echo $profile['OfficeLoc'];?>">
            </p>
                    </div>
                </div>
            </div>
            <div class="col-9" style="position: relative; top: -60px;">
                <div class="mb-4 card" style="width: 55rem;">
                    <div class="card-body">
                      <h5 class="card-title">Research Statement</h5>
                        <p class="card-text">
                            <center><textarea name="researchStatement" rows="3" cols="80"><?php echo $profile['ResearchStatement'];?></textarea></center>
                            </textarea>
                        </p>
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
                         $countCurr=0;
                         foreach($currentresearch as $printpast){
                           $tempTitle=$printpast['Title'];
                           $tempDes=$printpast['Description'];
                           $currId=$printpast['ID'];
                           $currentIDs=[$countCurr];
                           array_push($currentIDs,$currId);
                            echo "<tr>";
                            echo "<td>";
                            echo "<textarea name=\"currentTitle".$countCurr."\" rows=\"3\" cols=\"40\">$tempTitle</textarea></td>
                              <td><textarea name=\"currentDes".$countCurr."\" rows=\"4\" cols=\"70\">$tempDes</textarea></td>
                              </tr>";
                            $countCurr=$countCurr+1;
                          } ?>
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
                    <?php
                            $countPast=0;
                              foreach($pastresearch as $printpast){
                                $tempTitle=$printpast['Title'];
                                $tempDes=$printpast['Description'];
                                echo "<tr>";
                                echo "<td><textarea name=\"pastTitle".$countPast."\" rows=\"3\" cols=\"40\"> $tempTitle</textarea>";
                                echo "</td>";
                                echo "<td><textarea name=\"pastDes".$countPast."\" rows=\"4\" cols=\"70\">$tempDes</textarea></td>";
                                echo "</tr>";
                                $count=$count+1;
                              }
                      ?>
                    </tbody>
                </table>
            </div>
      </div>
        </div>
    </div>
   <center><input type="submit" value="Submit Changes" class="button"></center>
<?php
                         if($_POST['bio']!=""){
                           $query="UPDATE Professor SET Bio=\"".$_POST['bio']."\", ResearchStatement=\"".$_POST['researchStatement']."\", PhoneNum=\"".$_POST['phoneNum']."\", OfficeLoc=\"".$_POST['office']."\" WH$                         }
                         //"\"", ResearchStatement=\"".$_POST['researchStatement']."\", PhoneNum=\"".$_POST['phoneNum']."\", OfficeLoc=\"".$_POST['office'].
                         //echo $query;
                         $test=mysqli_query($connection, $query);
                         if($test){
                           echo "<br> update query succeeded";
                         }
                         else{
                           echo "<br> update query failed";
                         }
                         for($i=0; $i<$countCurr; $i++){
                           $temp="currentTitle".$i;
                           echo "<br>".$_POST[$temp];
                           $tempTitle=$_POST[$temp];
                           $temp="currentDes".$i;
                           echo "<br>".$_POST[$temp];
                           $tempDes=$_POST[$temp];
                           echo "<br>ID: ".$currentIDs[$i];
                           $queryCurr= "UPDATE Research SET Description=\"$tempDes\", Title=\"$tempTitle\" where ID=".$currentIDs[$i];
                         echo "<br>".$queryCurr;
                         }
                         for($i=0; $i<$count;$i++){
                           $temp="pastTitle".$i;
                           echo "<br>".$_POST[$temp];
                           $tempTitle=$_POST[$temp];
                           $temp="pastDes".$i;
                           echo "<br>".$_POST[$temp];
                           $tempDes=$_POST[$temp];
                         }
   ?>
  </form>
</body>
</html>
                         

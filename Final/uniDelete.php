<!DOCTYPE html>
<html>

<head>
        <!--<link rel="stylesheet" href="style.css?v=<?php //echo time();
                                                        ?>" type="text/css"/>-->
        <link rel="stylesheet" href="style.css" />
        <meta name="viewport" content="width=device-width, initial scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
                .alert-fixed {
                        position: fixed;
                        top: 0px;
                        left: 0px;
                        width: 100%;
                        z-index: 9999;
                        border-radius: 0px;
                }

                .my-custom-scrollbar {
                        position: relative;
                        height: 300px;
                        overflow: auto;
                }

                .table-wrapper-scroll-y {
                        display: block;
                }
        </style>
        <!-- <style>
.button{
  background-color:#910101;
  color: #ffffff;
  padding: 15px 15px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  border-radius: 17%;
}
.button:hover{
        color=#ffffff;
        background-color: #b00000;
}
</style> -->
</head>

<body>
        <div class="header">
                <h1><b>Admin Remove</b></h1>
                <!--<button class="button" onclick="history.go(-1)">Back </button>-->
                <form action="tempTableMenu.php">
                        <input type="submit" value="Back" class="btn btn-outline-secondary mb-2 ">
                </form>

        </div>
        <center>
                <?php
                session_start();
                //echo "<button class=\"button\" onclick=\"history.go(-1)\">Back </button>";//goes back to the table selection page
                require_once("config.php");

                if (isset($_SESSION['table'])) {
                        $tableName = $_SESSION['table']; //gets the table from the previous page or this page
                }
                $query1 = "SELECT * FROM $tableName"; //to display the table
                $columnNames = array(); //gets the names of the columns
                $count = 0;
                if ($r = $connect->query($query1)) {
                        echo "<div class=\"container-fluid\">";
                        echo "<div class=\"row-fluid\">";
                        echo "<div class=\"table-wrapper-scroll-y my-custom-scrollbar\">";
                        echo "<table class=\"table\">";
                        echo "<thead>";
                        echo "<tr>";
                        while ($hold = $r->fetch_field()) {
                                echo "<th scope=\"col\">" . $hold->name . "</th>";
                        }
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        while ($row = mysqli_fetch_array($r)) {
                                echo "<tr>";
                                for ($i = 0; $i < sizeof($row) / 2; $i++) {
                                        echo "<td>" . $row[$i] . "</td>";
                                }
                                echo "</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                }
                // if($r = mysqli_query($connect, $query1)){
                //         while($row=mysqli_fetch_array($r)){
                //                 echo "<tr>";
                //                 for($i=0; $i<sizeof($row)/2; $i++){
                //                         echo "<td>" . $row[$i] . "</td>";
                //                 }
                //                 echo "</tr>";
                //         }
                //         echo "</table>";
                // }
                // else{
                //         echo "if statement did not work for r";
                // }
                if ($r = $connect->query($query1)) {
                        while ($hold = $r->fetch_field()) {
                                $columnNames[$count] = $hold->name;
                                $count++;
                        }
                }
                // echo "<form name=\"getInfo\" action=\"\" method=\"post\">
                //         <input type=\"hidden\" name=\"table\" id=\"table\" value=\"$tableName\">
                //         <input type=\"text\" name=\"attribute\" id=\"attribute\" placeholder=\"Enter the name of the attribute you would like to change\" style=\"width:300px;\"><br>
                //         <input type=\"text\" name=\"key\" id=\"key\" placeholder=\"Enter the key for the attribute you entered\" style=\"width:300px;\"><br>
                //         <input type=\"submit\" value=\"submit\" class=\"button\">
                //         </form>";
                echo "<div class=\"container \">";
                echo "<div class=\"row\">";
                echo "<div class=\"col-sm-4 mx-auto mt-2\">";
                echo "<form name=\"mainForm\" method=\"post\">";
                if ($tableName == "Professor") {
                        echo "<div class=\"input-group mb-3 mx-sm-3 mb-2\" >
<input type=\"text\" class=\"form-control\" name=\"key\" id=\"key\" placeholder=\"Enter the name\" aria-label=\"key\" aria-describedby=\"basic-addon2\">
<input type=\"text\" class=\"form-control\" name=\"user\" id=\"user\" placeholder=\"Enter the username\" aria-label=\"user\" aria-describedby=\"basic-addon2\">
<button class=\"btn btn-outline-secondary\" value=\"submit\" type=\"submit\">Submit</button>
</div>
</form>";

                        $k = $_POST['key'];
                        $_SESSION['key'] = $key;
                        $u = $_POST['user'];
                        $_SESSION['user'] = $user;
                        echo "Username= $u\n";

                        $query1 = "DELETE FROM $tableName WHERE Name=\"$k\";";
                        if ($d = $connect->query($query1)) {
                                echo "<br>d query succeeded";
                                echo "$user";
                        } else {
                                echo "<br>The query failed";
                        }
                        $query2 = "DELETE FROM Research WHERE ID IN
           (SELECT ID FROM Has WHERE researchID GROUP BY COUNT(researchID) = 1)";
                        if ($e = $connect->query($query2)) {
                                echo "<br>e query succ";
                                echo $info;
                        } else {
                                echo "<br>The query failed";
                        }
                        $query3 = "DELETE FROM Has WHERE Username=\"$u\"";
                        if ($c = $connect->query($query3)) {
                                echo "<br>c query succ";
                                echo "$info";
                        } else {
                                echo "<br>The query failed";
                        }
                } else {
                        echo "<div class=\"input-group mb-3 mx-sm-3 mb-2\" >
                                <input type=\"text\" class=\"form-control\" name=\"attribute\" id=\"attribute\" placeholder=\"Enter the attribute\" aria-label=\"attribute\" aria-describedby=\"basic-addon2\">
                                </div>
                                <div class=\"input-group mb-3 mx-sm-3 mb-2 \" >
                                <input type=\"text\" class=\"form-control\" name=\"key\" id=\"key\" placeholder=\"Enter the key\" aria-label=\"key\" aria-describedby=\"basic-addon2\">
                                <button class=\"btn btn-outline-secondary\" value=\"submit\" type=\"submit\">Submit</button>
                                </div>
                                </form>";

                        $attribute = $_POST['attribute'];
                        $k = $_POST['key'];
                        $_SESSION['key'] = $key;
                        //echo "value= $k\n";
                        //echo "table name=$tableName";
                        //echo "Attribute=$att";
                        //echo "key=$k";
                        $query2 = "DELETE FROM $tableName WHERE $attribute=\"$k\";";
                        if ($test = $connect->query($query2)) {
                                //echo"<br>update query success";
                        } else {
                                //echo"<br>update query fail";
                        }
                }
                

                #echo "<br> Size of columnNames= " . sizeof($columnNames);

                //echo "<br>Query=$query<br>";



                echo "</div>";
                echo "</div>";
                echo "</div>";
                if ($_REQUEST['submit'] == 'Submit') {
                        if ($d) {
                                echo "<div class=\"alert alert-success alert-fixed alert-dismissible fade show\" role=\"alert\">
                                        Success! 
                                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                        <span aria-hidden=\"true\">&times;</span>
                                        </button>
                                </div>";
                        } else {
                                echo "<div class=\"alert alert-danger alert-fixed alert-dismissible fade show\" role=\"alert\">
                                        Failed!
                                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                        <span aria-hidden=\"true\">&times;</span>
                                        </button>
                                </div>";
                        }
                }
                mysqli_close($conneciton);
                ?>
                <form method="post" action="tempShowUpdate.php">
                        <input type="hidden" name="table" id="table" value="<?php echo $tableName; ?>">
                        <button class="btn btn-outline-secondary" type="submit">View Updated Table</button>
                </form>
        </center>
</body>

</html>

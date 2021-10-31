<html>

<body>
    <?php
    if ($connection = @mysqli_connect('localhost', 'bmason3', 'bmason3', 'SUResearchProjDB')) {
        print '<p>Successfully connected to MySQL.</p>';
    }
    $query = "SELECT * FROM Ships";
    $r = mysqli_query($connection, $query);
    echo "<table border=’1’>
<thead>
<tr>
<th> name </th>
<th> classes </th>
<th> launched </th>
</tr>
</thead>";
    while ($row = mysqli_fetch_array($r)) {
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['class'] . "</td>";
        echo "<td>" . $row['launched'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    mysqli_close($connection);
    ?>
</body>

</html>
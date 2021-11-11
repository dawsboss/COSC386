<!-- JOe mOMa -->

<?php

if (isset($_POST['Submit'])) {
    $research_title = $_POST['rtitle'];
    $research_desc = $_POST['rdesc'];
    $research_abstract = $_POST['rabstract'];

    $query = "INSERT INTO Research
              VALUES($research_desc, $research_abstract, 'NA', $research_title, 0)";
}

?>
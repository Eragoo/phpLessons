<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('error_reporting', E_ALL);


require "/Applications/MAMP/htdocs/webpra/2/model/Model.php";
require "/Applications/MAMP/htdocs/webpra/2/view/Notes.php";

$notes = new Notes($params["db_data"], $params["per_page"], $params['notes_count']);
$notes->genereteHTML();

header("Location: index.html");
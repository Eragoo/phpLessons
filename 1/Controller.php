<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('error_reporting', E_ALL);

require "/Applications/MAMP/htdocs/webpra/1/view/Notes.php";
require "/Applications/MAMP/htdocs/webpra/1/model/Model.php";

$notes = new Notes($db_data);
$notes->viewNotes();

header("Location: index.html");
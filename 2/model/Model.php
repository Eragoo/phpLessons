<?php

require "/Applications/MAMP/htdocs/webpra/2/model/database/dbClass.php";
require "/Applications/MAMP/htdocs/webpra/2/model/FormData.php";

$params = [];

$form = new FormData($_POST);
$form->validateForm();
$form_data = $form->getData();

$current_page = 1;
$params['per_page'] = 3;

if(isset($_GET['page']) && $_GET['page'] > 0)
{
    $current_page = $_GET['page'];
}
$start = ($current_page -1) * $params['per_page'];

$db = new dbClass();
$db->write($form_data);
$params["notes_count"] = $db->getCount();
$params["db_data"] = $db->selectNotes($start, $params['per_page']);


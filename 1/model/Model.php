<?php

require "/Applications/MAMP/htdocs/webpra/1/model/database/dbClass.php";
require "/Applications/MAMP/htdocs/webpra/1/model/FormData.php";

$form = new FormData($_POST);
$form->validateForm();
$form_data = $form->getData();

$db = new dbClass();
$db->write($form_data);
$db_data = $db->selectAll();

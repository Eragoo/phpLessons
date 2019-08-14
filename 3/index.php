<?php
error_reporting(E_ALL);
ini_set("display_errors");

$host = "localhost";
$user = "root";
$password = "root";
$dbName = "test";

$link = mysqli_connect($host, $user, $password, $dbName);
mysqli_query($link, "SET NAMES 'utf8'");

if(isset($_GET['page']))
{
    $page = $_GET['page'];
}else{
    $page = '/webpra/3/';
}

$query = "SELECT * FROM pages WHERE url='$page'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
$page = mysqli_fetch_assoc($result);

if (!$page)
{
    $query = "SELECT * FROM pages WHERE url='404'";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    $page = mysqli_fetch_assoc($result);
    header("HTTP/1.0 404 Not Found");
}
$content = $page['text'];
$title = $page['title'];


include "layout.php";




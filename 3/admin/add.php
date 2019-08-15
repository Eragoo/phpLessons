<?php
error_reporting(E_ALL);
ini_set("display_errors");

$host = "localhost";
$user = "root";
$password = "root";
$dbName = "test";

$link = mysqli_connect($host, $user, $password, $dbName);
mysqli_query($link, "SET NAMES 'utf8'");

function getPage($info = "")
{
    if(isset($_POST['title']) && isset($_POST['url']) && isset($_POST['text'])) {
        $title = $_POST['title'];
        $url = $_POST['url'];
        $text = $_POST['text'];
    }else{
        $title = '';
        $url = '';
        $text = '';
    }

    ob_start();
    include "elems/form.php";
    $content = ob_get_clean();

    include "layout.php";
}

function addPage($link)
{
    if(isset($_POST['title']) && isset($_POST['url']) && isset($_POST['text'])){
        $title = $_POST['title'];
        $url = $_POST['url'];
        $text = $_POST['text'];

        $query = "SELECT COUNT(*) as count FROM pages WHERE url='$url'";
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        $isPage = mysqli_fetch_assoc($result)['count'];

        if ($isPage) {
            return ["text"=>"Page with this url exists", "status"=>"error"];
        }else{
            $query = "INSERT INTO pages (title, url, text) VALUES ('$title', '$url', '$text')";
            mysqli_query($link, $query) or die (mysqli_error($link));

            header('Location: /webpra/3/admin/?added=true');
        }
    }else{
        return '';
    }
}

$info = addPage($link);
getPage($info);


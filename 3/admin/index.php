<?php
error_reporting(E_ALL);
ini_set("display_errors");

$host = "localhost";
$user = "root";
$password = "root";
$dbName = "test";

$link = mysqli_connect($host, $user, $password, $dbName);
mysqli_query($link, "SET NAMES 'utf8'");

function showPageTable($link, $info = '')
{

    $query = "SELECT id, title, url FROM pages WHERE url!='404'";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    for ($data=[]; $row = mysqli_fetch_assoc($result); $data[] = $row);//когда в $result попадает FALSE цикл останавливается
    $content =
        "<table><tr>
        <th>TITLE</th>
        <th>URL</th>
        <th>EDIT</th>
        <th>DELETE</th>
    </tr>";
    foreach ($data as $page) {
        $content .=
            "<tr>
        <td>{$page['title']}</td>
        <td>{$page['url']}</td>
        <td><a href=\"/webpra/3/admin/edit.php?id={$page['id']}\">edit</a></td>
        <td><a href=\"?delete={$page['id']}\">delete</a></td>
    </tr>";
    }
    $content .= "</table>" ;

    $title = "admin main page";


    include "layout.php";

}

function deletePage($link)
{
    if(isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $query = "DELETE FROM pages WHERE id={$id}";//лучше использовать prepare & execute т.к. есть опасность что через адресную строку будет виполнена sql injection
        $result = mysqli_query($link, $query) or die(mysqli_error($link));

        return ['text'=>'Page added successfully', 'status'=>'success'];
    }else{
        return '';
    }

}

if (isset($_GET['added']) && boolval($_GET['added'])){
    $info = ['text'=>'Page added successfully', 'status'=>'success'];
}else{
    $info = deletePage($link);
}
showPageTable($link, $info);




?>




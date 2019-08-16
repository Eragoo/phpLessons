<?php
include "../elems/init.php";

function getPage($link, $info = "")
{
    $title = 'admin add new page';
    if (isset($_GET['id'])){
        $id = mysqli_real_escape_string($link, $_GET['id']);
        $query = "SELECT * FROM pages WHERE id='{$id}'";
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        $page = mysqli_fetch_assoc($result);

        if ($page){

            if(isset($_POST['title']) && isset($_POST['url']) && isset($_POST['text'])) {
                $title = $_POST['title'];
                $url = $_POST['url'];
                $text = $_POST['text'];
            }else{
                $title = $page['title'];
                $url = $page['url'];
                $text = $page['text'];
            }
            ob_start();
            include "elems/form.php";
            $content = ob_get_clean();
        }else{
            $content = 'Page with this id not fount!';

        }
    }else{
        $content = 'Page with this id not fount!';
    }
    include "layout.php";
}
//есть три ситуации обновления : 1)отредактировали урл и созраняем и все нормально 2)отредактировали урл но такой уже есть в базе 3)не редактируем
function addPage($link)
{
    if(isset($_POST['title']) && isset($_POST['url']) && isset($_POST['text'])){
        $title = $_POST['title'];
        $url = $_POST['url'];
        $text = $_POST['text'];

        if ( isset($_GET['id'])){
            $id = $_GET['id'];

            $query = "SELECT * FROM pages WHERE id='{$id}'";
            $result = mysqli_query($link, $query) or die(mysqli_error($link));
            $page = mysqli_fetch_assoc($result);

            //проверяем менялся ли урл
            if ($page['url'] !== $url ){
                $query = "SELECT COUNT(*) as count FROM pages WHERE url='$url'";
                $result = mysqli_query($link, $query) or die(mysqli_error($link));
                $isPage = mysqli_fetch_assoc($result)['count'];
                if(boolval($isPage)){
                    return ['text'=>'Page with this url exists', 'status'=>'error'];
                }
            }
            $query = "UPDATE pages SET title='$title', url='$url', text='$text' WHERE id='$id'  ";
            mysqli_query($link, $query) or die (mysqli_error($link));

            return ['text'=>'Page edited successfully', 'status'=>'success'];
        }

    }else{
        return '';
    }
}

$info = addPage($link);
getPage($link, $info);
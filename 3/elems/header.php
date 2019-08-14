<?php

    function createLink($href, $title)
    {
        if ((!isset($_GET['page']) and $href == '/webpra/3/') or (isset($_GET['page']) and $_GET['page'] == $href)) {
            $class = ' class="active"';
        } else {
            $class = '';
        }

        if ($href != '/webpra/3/') {
            $hrefPart = '?page=';
        } else {
            $hrefPart = '';
        }
        echo "<a href=\"{$hrefPart}{$href}\"{$class}>{$title}</a>";

    }

    $query = "SELECT * FROM pages WHERE url!='404'";

    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    for ($data=[]; $row = mysqli_fetch_assoc($result); $data[] = $row);//когда в $result попадает FALSE цикл останавливается

    foreach ($data as $page) {
        createLink($page['url'], $page['title']);
    }







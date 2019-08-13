<?php

class Notes
{
    private $db_res;
    private $countOnPage;
    private $notesCount;
    public function __construct($arr_res, $countOnPage, $notesCount)
    {
        $this->db_res = $arr_res;
        $this->countOnPage = $countOnPage;
        $this->notesCount = $notesCount;
    }

    private function genereteNotes()
    {
        $msg = "";
        foreach ($this->db_res as $key=>$value)
        {
            $msg .= "<div class='note'>
				<p>
					<span class='date'>{$value['datetime']}</span>
					<span class='name'>{$value['username']}</span>
				</p>
				<p>
					{$value['content']}
				</p>
			</div>";
        }
        return $msg;
    }

    private function genereteNAV()
    {
        $countPages = ceil($this->notesCount / $this->countOnPage);
        $msg = "<div>
				<nav>
				  <ul class=\"pagination\">";

        for($i = 1; $i<=$countPages; $i++)
        {
            $msg .= "<li><a href=\"Controller.php?page={$i}\">{$i}</a></li>";//class="active"
        }

        $msg .= " </ul>
				</nav>
			</div>";

        return $msg;
    }

    public function genereteHTML()
    {
        $html = "<!DOCTYPE html>
<html lang=\"ru\">
	<head>
		<meta charset=\"utf-8\">  
		<title>Блог</title>
		<link rel=\"stylesheet\" href=\"css/bootstrap/css/bootstrap.css\">
		<link rel=\"stylesheet\" href=\"css/styles.css\">
	</head>
	<body>
		<div id=\"wrapper\">
			<h1>Блог</h1>
			{$this->genereteNAV()}
			{$this->genereteNotes()}
			<div id=\"form\">
				<form action=\"Controller.php\" method=\"POST\">
					<p><input class=\"form-control\" placeholder=\"Ваше имя\" name=\"username\"></p>
					<p><textarea class=\"form-control\" placeholder=\"Ваш отзыв\" name=\"content\"></textarea></p>
					<p><input type=\"submit\" class=\"btn btn-info btn-block\" value=\"Сохранить\"></p>
				</form>
			</div>
		</div>
	</body>
</html>

";


    file_put_contents("/Applications/MAMP/htdocs/webpra/2/index.html", $html);
    }

}



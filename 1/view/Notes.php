<?php

class Notes
{
    private $db_res;
    public function __construct($arr_res)
    {
        $this->db_res = $arr_res;
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

    public function viewNotes()
    {
        $html = "<!DOCTYPE html>
<html lang=\"ru\">
	<head>
		<meta charset=\"utf-8\">  
		<title>Гостевая книга</title>
		<link rel=\"stylesheet\" href=\"css/bootstrap/css/bootstrap.css\">
		<link rel=\"stylesheet\" href=\"css/styles.css\">
	</head>
	<body>
		<div id=\"wrapper\">
			<h1>Гостевая книга</h1>
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


    file_put_contents("/Applications/MAMP/htdocs/webpra/1/index.html", $html);
    }

}



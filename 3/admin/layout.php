<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css?pafg=3j">
    <title><?= $title ?></title>
</head>
<body>
<header>
    <a href="/webpra/3/admin/add.php">Add page</a>
</header>
<main>
    <?php include "elems/info.php" ?>
    <?= $content ?>
</main>
<footer>
    footer
</footer>
</body>
</html>
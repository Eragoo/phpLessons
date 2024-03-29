
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title><?= $title ?></title>
</head>
<body>
<header>
    <?php include "elems/header.php";?>
</header>
<main>
    <?= $content ?>
</main>
<footer>
    <?php include "elems/footer.php";?>
</footer>
</body>
</html>
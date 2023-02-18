<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <title><?= esc($title) ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel="stylesheet" href="<?= esc($css_href) ?>">
</head>
<body>
    <main>
        <?= $page_content ?>
    </main>

    <script src="./js/script.js"></script>
</body>
</html>

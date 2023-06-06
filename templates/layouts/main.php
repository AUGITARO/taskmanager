<?php

/** @var string $title */
/** @var string $css_href */
/** @var string $page_content */

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title) ?></title>
    <link rel="stylesheet" href="<?= esc($css_href) ?>">
</head>
<body>

    <main>
        <?= $page_content ?>
    </main>

    <script src="./assets/js/script.js"></script>
</body>
</html>

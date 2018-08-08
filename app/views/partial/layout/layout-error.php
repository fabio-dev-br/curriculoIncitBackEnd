<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php require_once 'app/views/partial/layout-header-config.php'; ?>

    <link type="text/css" rel="stylesheet" href="/css/app.min.css" />
    <?php foreach ($this->stylesheets as $href): ?>
    <link href="<?php echo $href; ?>" rel="stylesheet" type="text/css">
    <?php endforeach; ?>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab|PT+Sans|Fira+Mono" rel="stylesheet">
</head>

<body>
    <div id="wrapper">

        <div id="page-container-wrapper">
            <?php require_once 'app/views/template/' . $page . '.php'; ?>
            <div id="page-content-wrapper-backdrop"></div>
        </div>

        <script type='text/javascript' src="/js/app.min.js"></script>
        <?php foreach ($this->scripts as $path): ?>
                <script type='text/javascript' src="<?php echo $path; ?>"></script>
            <?php endforeach; ?>
</body>

</html>

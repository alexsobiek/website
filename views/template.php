<?php
/** @var Page $page */
$p = $page; // Simply so my IDE stops complaining about an unknown variable
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Website</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="<?php echo $page->getBaseURL() ?>">
    <link rel="stylesheet" type="text/css" href="/static/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/static/css/page.css">
    <?php foreach($page->css as $stylesheet) { ?>
    <link rel="stylesheet" type="text/css" href="/static/css/<?php echo $stylesheet; ?>">
    <?php } ?>
</head>
<body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Alex Sobiek</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="terminal-about-selector" aria-current="page" href="#">About</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- BEGIN PAGE CONTENT -->
    <?php $page->getContent(); ?>
    <!-- END PAGE CONTENT -->

    <script type="text/javascript" src="/static/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://kit.fontawesome.com/d30a29881e.js" crossorigin="anonymous"></script>
    <?php foreach($page->javascript as $script) { ?>
    <script type="text/javascript" src="/static/js/<?php echo $script; ?>"></script>
    <?php } ?>
</body>
</html>
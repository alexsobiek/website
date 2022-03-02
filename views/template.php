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
</head>
<body>

    <?php
    /** @var Page $page */
    $page->getContent();
    ?>
    <script type="text/javascript" src="/static/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/d30a29881e.js" crossorigin="anonymous"></script>
</body>
</html>
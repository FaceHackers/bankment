<meta charset="utf-8" />
<title><?= $config->projectName ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script>
    var root = '<?= $config->root ?>';
    var imgRoot = '<?= $config->imgRoot ?>';
</script>
<link rel="shortcut icon" href="http://static.tmimgcdn.com/img/favicon.ico">
<link rel="icon" href="http://static.tmimgcdn.com/img/favicon.ico">
<link rel="stylesheet" type="text/css" media="all" href="<?= $config->cssRoot ?>form.css">
<link rel="stylesheet" type="text/css" media="all" href="<?= $config->cssRoot ?>switchery.min.css">
<script type="text/javascript" src="<?= $config->jsRoot ?>switchery.min.js"></script>
<link href="<?= $config->cssRoot ?>layout.css" rel="stylesheet" type="text/css" />
<link href="<?= $config->cssRoot ?>menu2.css" rel="stylesheet" type="text/css" />
<link href="<?= $config->cssRoot ?>table.css" rel="stylesheet" type="text/css" />
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="<?= $config->jsRoot ?>jquery.countdown.js"></script>
<script src="<?= $config->jsRoot ?>resetCssUrl.js"></script>
<?php
    if(isset($_SESSION['alert'])) {
    echo "<script>alert('" .$_SESSION['alert'] . "');</script>";
    unset($_SESSION['alert']);
    }
?> 	  
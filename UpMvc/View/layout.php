<?php
/**
 * Layout för dokumentation och felmeddelanden i Up MVC
 *
 * @author Ola Waljefors
 * @package UpMVC
 * @version 2013.1.1
 * @link https://github.com/saurid/Up-MVC
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */
?>
<!DOCTYPE HTML>
<html>
<head>
    <title><?php echo $title ?></title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <link type="text/css" rel="stylesheet" href="<?php echo UpMvc\Container::get()->site_path ?>/UpMvc/View/css/format.css" media="all" />
    <link type="text/css" rel="stylesheet" href="<?php echo UpMvc\Container::get()->site_path ?>/UpMvc/View/css/printformat.css" media="print" />
</head>
<body>

<h1 id="upp">
    <a href="<?php echo UpMvc\Container::get()->site_path ?>/UpMvc/Manual">
        <img src="<?php echo UpMvc\Container::get()->site_path ?>/UpMvc/View/img/UpMVC.png" width="206" height="96" alt="<?php echo $title ?>" />
    </a>
</h1>

<?php echo $content ?>

</body>
</html>

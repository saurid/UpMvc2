<?php
/**
 * Layout för dokumentation och felmeddelanden i Up MVC.
 *
 * @package UpMvc2\Documentation
 * @author  Ola Waljefors
 * @version 2013.12.1
 * @link    https://github.com/saurid/UpMvc2
 * @link    http://www.phpportalen.net/viewtopic.php?t=116968
 */

namespace UpMvc\View;

use UpMvc;
use UpMvc\Container as Up;

?>
<!DOCTYPE HTML>
<html>
<head>
    <title><?php echo $title ?></title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?php echo Up::site_path() ?>/Documentation/View/css/format.css" media="all" />
    <link rel="stylesheet" href="<?php echo Up::site_path() ?>/Documentation/View/css/printformat.css" media="print" />
</head>
<body>

<nav>
    <ul>
        <li><h2>om up mvc</h2></li>
        <li><a href="<?php echo Up::site_path() ?>/Documentation/Index/visa/inledning">Inledning</a></li>
        <li><a href="<?php echo Up::site_path() ?>/Documentation/Index/visa/filstruktur">Filstruktur</a></li>
    </ul>
    <ul>
        <li><h2>ramverkets lager</h2></li>
        <li><a href="<?php echo Up::site_path() ?>/Documentation/Index/visa/controllers">Controllers / Actions</a></li>
        <li><a href="<?php echo Up::site_path() ?>/Documentation/Index/visa/view">Views</a></li>
        <li><a href="<?php echo Up::site_path() ?>/Documentation/Index/visa/model">Models</a></li>
    </ul>
    <ul>
        <li><h2>övrigt</h2></li>
        <li><a href="<?php echo Up::site_path() ?>/Documentation/Index/visa/container">Servicecontainern</a></li>
        <li><a href="<?php echo Up::site_path() ?>/Documentation/Index/visa/moduler">Moduler</a></li>
        <li><a href="<?php echo Up::site_path() ?>/Documentation/Index/visa/request">Requestobjektet</a></li>
        <li><a href="<?php echo Up::site_path() ?>/Documentation/Index/visa/cache">Cachning</a></li>
        <li><a href="<?php echo Up::site_path() ?>/Documentation/Index/visa/siduppdelning">Siduppdelning / Pagination</a></li>
        <li><a href="<?php echo Up::site_path() ?>/Documentation/Index/visa/rattigheter">Rättigheter</a></li>
    </ul>
    <ul>
        <li><h2>detaljerat</h2></li>
        <li><a href="<?php echo Up::site_path() ?>/Documentation/Index/visa/detaljer">UML-diagram och tidslinje</a></li>
        <li><h2>under utveckling</h2></li>
        <li><a href="<?php echo Up::site_path() ?>/Documentation/WebForm">Webbformulär</a></li>
    </ul>

    <br />
</nav>

<article>
    <header>
        <a href="<?php echo Up::site_path() ?>/Documentation/Index/visa">
            <img src="<?php echo Up::site_path() ?>/Documentation/View/img/UpMVC.png" width="230" height="99" alt="<?php echo $title ?>" />
        </a>
        <h2>dokumentation</h2>
    </header>

    <?php echo $content ?>
</article>

</body>
</html>

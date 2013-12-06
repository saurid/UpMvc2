<?php
/**
 * /App/Controller/index.php
 * 
 * @package App
 */

namespace App\Controller;

use UpMvc;
use UpMvc\Container as Up;

/**
 * Standardcontroller.
 *
 * Byt ut till din egen, nu vidarebefodras anropet till manualen.
 *
 * @package App
 * @author  Ola Waljefors
 * @version 2013.1.1
 * @link    https://github.com/saurid/UpMvc2
 * @link    http://www.phpportalen.net/viewtopic.php?t=116968
 */
class Index
{
    /** Ersätt för att skapa din egen webbsida. */
    public function index()
    {
        // Vidarebefodra direkt till dokumentationen
        $c = UpMvc\Container::get();
        header('Location: '.$c->site_path.'/Documentation/Index');
    }
}

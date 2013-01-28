<?php
/**
 * /UpMvc/App/Controller/index.php
 * @package UpMvc2
 * @filesource
 */

namespace App\Controller;

use UpMvc;

/**
 * Standardcontroller
 *
 * Byt ut till din egen, nu vidarebefodras anropet till manualen!
 *
 * @author Ola Waljefors
 * @package UpMvc2
 * @version 2013.1.1
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */
class Index
{
    /**
     * Ersätt för att skapa din egen webbsida
     */
    public function index()
    {
        // Vidarebefodra direkt till dokumentationen
        $c = UpMvc\Container::get();
        header('Location: '.$c->site_path.'/UpMvc/Manual');
    }
}

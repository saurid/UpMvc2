<?php
/**
 * /UpMvc/Controller/Manual.php
 * @package UpMvc2
 */

namespace UpMvc\Controller;

use UpMvc;

/**
 * Controller för Up MVC's dokumentation
 *
 * @author Ola Waljefors
 * @package UpMvc2
 * @version 2013.1.1
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */
class Manual
{
    public function index()
    {
        $c = UpMvc\Container::get();
        $c->lipsum = new \UpMVC\Model\Lipsum();

        // Fyll view med variabler och data och rendrera
        echo $c->view
            ->set('title', 'Up MVC')
            ->set('lipsum', $c->lipsum->get())
            ->set('content', $c->view->render('UpMvc/View/manual.php'))
            ->render('UpMvc/View/layout.php');
    }
}

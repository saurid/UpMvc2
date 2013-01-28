<?php
/**
 * /UpMvc/Controller/Exception.php
 * @package UpMVC
 */

namespace UpMvc\Controller;

use UpMvc;

/**
 * Controller för ramverkets interna felhantering
 *
 * @author Ola Waljefors
 * @package UpMVC
 * @version 2013.1.1
 * @link https://github.com/saurid/Up-MVC
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */
class Exception
{
    public function index($e)
    {
        $c = UpMvc\Container::get();

        $trace = $e->getTrace();
        foreach ($trace as $key => $stack) {
            $trace[$key]['args'] = array_map('gettype', $trace[$key]['args']);
        }
        echo $c->view
            ->set('title', 'Up MVC-fel!')
            ->set('exception', $e)
            ->set('router', $c->router)
            ->set('trace', $trace)
            ->set('content', $c->view->render('UpMvc/View/exception.php'))
            ->render('UpMvc/View/layout.php');
    }
}

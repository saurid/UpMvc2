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
    /**
     * Vidarebefodra till att visa manual som default
     */
    public function index()
    {
        $this->visa();
    }

    /**
     * Visa vald del av manualen
     * Om inget kapitel är valt, sätts "inledning" som standard
     *
     * @param string Sträng med namnet på kapitel
     */
    public function visa($page = 'inledning')
    {
        $c = UpMvc\Container::get();
        $c->lipsum = new \UpMVC\Model\Lipsum();
        $c->view->set('site_path', UpMvc\Container::get()->site_path);

        switch ($page)
        {
            case 'filstruktur':
                $c->view
                    ->set('title', 'Up MVC - filstruktur')
                    ->set('content', $c->view->render('UpMvc/View/filstruktur.php'));
                break;

            case 'controllers':
                $c->view
                    ->set('title', 'Up MVC - controllers & actions')
                    ->set('content', $c->view->render('UpMvc/View/controllers.php'));
                break;

            case 'view':
                $c->view
                    ->set('title', 'Up MVC - view')
                    ->set('content', $c->view->render('UpMvc/View/view.php'));
                break;

            case 'model':
                $c->view
                    ->set('title', 'Up MVC - modeller')
                    ->set('lipsum', $c->lipsum->get())
                    ->set('content', $c->view->render('UpMvc/View/model.php'));
                break;

            case 'container':
                $c->view
                    ->set('title', 'Up MVC - container')
                    ->set('content', $c->view->render('UpMvc/View/container.php'));
                break;

            case 'moduler':
                $c->view
                    ->set('title', 'Up MVC - moduler')
                    ->set('content', $c->view->render('UpMvc/View/moduler.php'));
                break;

            case 'request':
                $c->view
                    ->set('title', 'Up MVC - request')
                    ->set('content', $c->view->render('UpMvc/View/request.php'));
                break;

            case 'detaljer':
                $c->view
                    ->set('title', 'Up MVC - detaljer')
                    ->set('content', $c->view->render('UpMvc/View/detaljer.php'));
                break;

            default:
                $c->view
                    ->set('title', 'Up MVC - inledning')
                    ->set('content', $c->view->render('UpMvc/View/inledning.php'));
                break;
        }

        echo $c->view->render('UpMvc/View/layout.php');
    }
}

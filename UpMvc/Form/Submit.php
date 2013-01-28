<?php
/**
 * /UpMvc/Form/Submit.php
 * @package UpMVC
 */

namespace UpMvc\Form;

/**
 * Rendrerar en submitknapp
 * 
 * @author Ola Waljefors
 * @package UpMVC
 * @subpackage Form
 * @version 2013.1.1
 * @link https://github.com/saurid/Up-MVC
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */
class Submit extends Base
{
    /**
     * Skapa HTML-uppmärkning
     * @return string submitknapp
     */
    public function render()
    {
        $this->view->set('field', $this);
        
        return $this->view->render('UpMvc/Form/View/submit.php');
    }
}

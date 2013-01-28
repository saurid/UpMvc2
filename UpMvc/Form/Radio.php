<?php
/**
 * /UpMvc/Form/Radio.php
 * @package UpMVC
 */

namespace UpMvc\Form;

/**
 * Rendrerar radioknappar
 * 
 * @author Ola Waljefors
 * @package UpMVC
 * @subpackage Form
 * @version 2013.1.1
 * @link https://github.com/saurid/Up-MVC
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */
class Radio extends Base
{
    /**
     * Skapa HTML-uppmärkning
     * @return string radioknappar
     */
    public function render()
    {
        $this->view->set('field', $this);
        
        return $this->view->render('UpMvc/Form/View/radio.php');
    }
}

<?php
/**
 * /UpMvc/Form/Text.php
 * @package UpMVC
 */

namespace UpMvc\Form;

/**
 * Rendrerar ett textfält
 * 
 * @author Ola Waljefors
 * @package UpMVC
 * @subpackage Form
 * @version 2013.1.1
 * @link https://github.com/saurid/Up-MVC
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */
class Text extends Base
{
    /**
     * Skapa HTML-uppmärkning
     * @return string textfält
     */
    public function render()
    {
        $this->view->set('field', $this);
        
        return $this->view->render('UpMvc/Form/View/text.php');
    }
}

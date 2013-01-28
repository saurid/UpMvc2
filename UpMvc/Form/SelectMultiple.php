<?php
/**
 * /UpMvc/Form/SelectMultiple.php
 * @package UpMVC
 */

namespace UpMvc\Form;

/**
 * Rendrerar ett selectfält med multipla val
 * 
 * @author Ola Waljefors
 * @package UpMVC
 * @subpackage Form
 * @version 2013.1.1
 * @link https://github.com/saurid/Up-MVC
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */
class SelectMultiple extends Base
{
    /**
     * Skapa HTML-uppmärkning
     * @return string multiple select
     */
    public function render()
    {
        $this->view->set('field', $this);
        
        return $this->view->render('UpMvc/Form/View/selectmultiple.php');
    }
}

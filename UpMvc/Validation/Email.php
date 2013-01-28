<?php
/**
 * /UpMvc/Validation/Email.php
 * @package UpMVC
 */

namespace UpMvc\Validation;

/**
 * @author Ola Waljefors
 * @package UpMVC
 * @subpackage Validation
 * @version 2013.1.1
 * @link https://github.com/saurid/Up-MVC
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */
class Email implements Base
{
    /**
     * Validera data
     * @param mixed $data Data som ska valideras
     * @return bool true om data uppfyller krav
     */
    public function validate($data)
    {
        return filter_var($data, FILTER_VALIDATE_EMAIL);
    }
}

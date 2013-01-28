<?php
/**
 * /UpMvc/Validation/Numeric.php
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
class Numeric implements Base
{
    /**
     * Validera data
     * @param mixed $data Data som ska valideras
     * @return bool true om data uppfyller krav
     */
    public function validate($data)
    {
        return is_numeric($data);
    }
}

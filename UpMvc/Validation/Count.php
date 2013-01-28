<?php
/**
 * /UpMvc/Validation/Count.php
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
class Count implements Base
{
    /**
     * Konstruktor
     * @param integer $min Minimum
     * @param integer $max Maximum
     * @throws Exception Om $min inte är en siffra
     * @throws Exception Om $max inte är en siffra
     * @throws Exception Om $max inte är större eller lika med $min
     */
    public function __construct($min, $max = null)
    {    
        if (!is_integer($min)) {
            throw new Exception(sprintf(
                '%s: Första argumentet måste vara en siffra (min)',
                __METHOD__
            ));
        }
        if ($max === null) {
            $max = $min;
        }
        if (!is_integer($max)) {
            throw new Exception(sprintf(
                '%s: Andra argumentet måste vara en siffra (max)',
                __METHOD__
            ));
        }
        if ($min > $max) {
            throw new Exception(sprintf(
                '%s: Andra argumentet (max) måste vara större än, '.
                'eller lika med första (min)',
                __METHOD__
            ));
        }
        $this->min = $min;
        $this->max = $max;
    }
    
    /**
     * Validera data
     * @param mixed $data Data som ska valideras
     * @return boolean true om data uppfyller krav
     */
    public function validate($data)
    {
        if (count($data) < $this->min OR count($data) > $this->max) {
            return false;
        }
        
        return true;
    }
}

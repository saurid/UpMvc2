<?php
/**
 * /UpMvc/ErrorHandler.php
 * @package UpMVC
 */

namespace UpMvc;

/**
 * Felhantering
 *
 * Felhantering av PHP-funktioner som normalt inte har exceptions. Konverterar
 * vanliga felmeddelanden till exceptions där det är möjligt. Startas i
 * index.php med:
 * <code>set_error_handler(array('UpMvc_ErrorHandler', 'handle'));</code>
 *
 * @author Ola Waljefors
 * @package UpMVC
 * @version 2013.1.1
 * @link https://github.com/saurid/Up-MVC
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */
class ErrorHandler
{
    /**
     * Kör PHP's interna felhantering som exceptions
     * @static
     * @param integer $errno
     * @param string $errstr
     * @param string $errfile
     * @param integer $errline
     * @return boolean true
     */
    public static function handle($errno, $errstr, $errfile, $errline)
    {
        if (!(error_reporting() & $errno)) {
            // Felkoden existerar inte i error_reporting
            return;
        }
        throw new \ErrorException($errstr, 0, $errno, $errfile, $errline);
        
        // Kör inte PHP's interna felhantering
        return true;
    }

    /**
     * Starta/Registrera errorhandlern
     */
    public function register()
    {
        set_error_handler(array($this, 'handle'));
    }
}

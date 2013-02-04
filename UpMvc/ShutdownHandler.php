<?php
/**
 * /UpMvc/ExceptionHandler.php
 * @package UpMvc2
 */

namespace UpMvc;

/**
 * Hantering av PHP shutdown errors
 *
 * Startas i index.php med:
 * <code>$shutdownhandler = new ShutdownHandler();
 * $shutdownhandler->register();</code>
 *
 * @author Ola Waljefors
 * @package UpMvc2
 * @version 2013.1.1
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */
class ShutdownHandler
{
    /**
     * Hantera shutdown errors
     * @static
     */
    public static function handle()
    {
        $error = error_get_last();

        if ($error !== NULL) {
            if ($error['type'] === E_ERROR) {
                ob_clean();
                require('View/shutdown.php');
            }
        }
    }

    /**
     * Starta/Registrera shutdown error handlern
     */
    public function register()
    {
        register_shutdown_function(array($this, 'handle'));
    }
}

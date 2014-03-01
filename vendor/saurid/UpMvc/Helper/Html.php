<?php
/**
 * /UpMvc/Helper/Html.php
 *
 * @package UpMvc2
 */

namespace UpMvc\Helper;

use UpMvc;
use UpMvc\Container as Up;

/**
 * HTML Helper.
 *
 * @package UpMvc2
 * @author  Ola Waljefors
 * @version 2014.2.1
 * @link    https://github.com/saurid/UpMvc2
 * @link    http://www.phpportalen.net/viewtopic.php?t=116968
 */
class Html
{
    /**
     * Skapa HTML länk till stylesheet.
     *
     * @param string  $stylesheet Länk till stylesheet.
     * @param string  $media      Media.
     * @param boolean $return     Ska resultat returneras (true) eller skrivas ut (false)?
     *
     * @return string HTML-uppmärkning
     */
    public static function style($stylesheet, $media = 'all', $return = false)
    {
        $html = "<link rel=\"stylesheet\" type=\"text/css\" href=\"$stylesheet\" media=\"$media\">\n";

        if (!$return) {
            echo $html;
        } else {
            return $html;
        }
    }

    /**
     * Skapa HTML länk till skript.
     *
     * @param string  $script Länk till skript.
     * @param boolean $return Ska resultat returneras (true) eller skrivas ut (false)?
     *
     * @return string HTML-uppmärkning
     */
    public static function script($script, $return = false)
    {
        $html = "<script src=\"$script\"></script>\n";

        if (!$return) {
            echo $html;
        } else {
            return $html;
        }
    }
}

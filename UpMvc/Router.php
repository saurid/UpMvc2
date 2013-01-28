<?php
/**
 * /UpMvc/Router.php
 * @package UpMvc2
 */

namespace UpMvc;

/**
 * Tolkar och översätter en router-sträng
 * 
 * Avgör vilken modul, controller och action som ska köras i ramverket, och även
 * vilka parametrar finns som argument. Front controllern använder sig av
 * objektet för att skapa och köra rätt controllers.
 * Strängen ska se ut enligt "modul/Controller/action/parameter1/parameter2/..."
 *
 * @author Ola Waljefors
 * @package UpMvc2
 * @version 2013.1.1
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */
class Router
{
    /**
     * @var string Standardmodul
     * @access private
     */
    private $module = 'App';
    
    /**
     * @var string Standardcontroller
     * @access private
     */
    private $controller = 'Index';
    
    /**
     * @var string Standardaction/metod
     * @access private
     */
    private $action = 'index';
    
    /**
     * @var array Parametrar
     * @access private
     */
    private $parameters;
    
    /**
     * Konstruktor
     * @param string $route Sträng där delarna har / som skiljetecken
     * @throws Exception Om argumentet inte är en sträng
     */
    public function __construct($route = '')
    {
        if (!is_string($route)) {
            throw new Exception(sprintf(
                '%s: Routen måste vara en sträng där varje '.
                'del har / som skiljetecken',
                __METHOD__
            ));
        }
        
        // Dela upp routen i sina beståndsdelar
        $route = explode('/', $route);
        
        // Om första delen är en mapp anses den vara en modul,
        // annars är det en controller (nedan)
        if (is_dir($route[0])) {
            $this->module = array_shift($route);
        }
        
        // Om nästa del finns är den en controller
        if (!empty($route[0])) {
            $this->controller = array_shift($route);
        }
        
        // Nästa del är en action/metod
        if (!empty($route[0])) {
            $this->action = array_shift($route);
        }
        
        // Resterande delar i routen är parametrar som skickas
        // med till controllern som argument
        $this->parameters = $route;
    }
    
    /**
     * Hämta modul
     * @return string
     */
    public function getModule()
    {
        return $this->module;
    }
    
    /**
     * Hämta controller
     * @return string
     */
    public function getController()
    {
        return $this->controller;
    }
    
    /**
     * Hämta action
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }
    
    /**
     * Hämta parametrar
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }
}

<?php
/**
 * /UpMvc/FrontController.php
 * @package UpMvc2
 */

namespace UpMvc;

/**
 * Laddar in och kör Controller/action
 * 
 * Klassen följer designmönstret "front controller" som innebär att hela
 * webbplatsen har en enda ingångspunkt till ramverket. Alla sidanrop går genom
 * frontcontrollern.
 * 
 * Startas i index.php med:
 * <code>
 * $container = UpMvc\Container::get();
 * $container->frontcontroller->dispatch();
 * </code>
 * eller:
 * <code>UpMvc\Container::get()->frontController->dispatch();</code>
 * 
 * @author Ola Waljefors
 * @package UpMvc2
 * @version 2013.1.1
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */
class FrontController
{
    /**
     * @var string Format för controllers klassnamn
     * @access private
     */
    private $classname = '%s\Controller\%s';
    
    /**
     * @var object UpMvc_Router-objekt
     * @access private
     */
    private $router;
    
    /**
     * Konstruktor
     *
     * Tar ett UpMvc_Router-objekt som argument och lagrar det i en egenskap
     *
     * @param object $router UpMvc\Router-objekt
     * @throws Exception Om argumentet inte är ett UpMvc\Router-objekt
     */
    public function __construct($router)
    {
        if (!$router instanceof Router) {
            throw new \Exception(sprintf(
                '%s: Första argumentet måste vara ett objekt '.
                'av typen UpMvc\Router',
                __METHOD__
            ));
        }
        $this->router = $router;
    }
    
    /**
     * Kör controller och action
     *
     * Hämtar modul, controller, action och eventuella parametrar (argument)
     * från router-objektet och skapar därefter en instans av controllern
     * och kör dess action/metod.
     *
     * @throws Exception Om controllern inte finns
     * @throws Exception Om action-metod inte finns
     */
    public function dispatch()
    {
        // Skapar controllernamn
        $controller = sprintf(
            $this->classname,
            $this->router->getModule(),
            $this->router->getController()
        );
        
        // Kontrollera att controller går att instansiera
        if (!class_exists($controller, true)) {
            throw new \Exception(sprintf(
                '%s: Controllern &quot;%s&quot; finns inte, '.
                'eller kan inte anropas',
                __METHOD__,
                $controller
            ));
        }
        
        // Instansiera vald controller
        $controller = new $controller();
        
        // Kontrollera att action går att kalla
        if (!method_exists($controller, $this->router->getAction())) {
            throw new \Exception(sprintf(
                '%s: Action &quot;%s&quot; finns inte, '.
                'eller kan inte anropas',
                __METHOD__,
                $this->router->getAction()
            ));
        }
        
        // Kalla vald action/metod i controllern och skicka med
        // eventuella parametrar som argument
        call_user_func_array(
            array($controller, $this->router->getAction()),
            $this->router->getParameters()
        );
    }
}

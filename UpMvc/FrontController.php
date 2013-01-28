<?php
/**
 * /UpMvc/FrontController.php
 * @package UpMVC
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
 * @package UpMVC
 * @version 2013.1.1
 * @link https://github.com/saurid/Up-MVC
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
        // Testa den körda koden mot tänkbara exceptions (fel)
        try {
            if (!$router instanceof Router) {
                throw new \Exception(sprintf(
                    '%s: Första argumentet måste vara ett objekt '.
                    'av typen UpMvc_Router',
                    __METHOD__
                ));
            }
            $this->router = $router;
        } catch (\Exception $e) {
            $this->catchException($e);
        }
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
        // Testa den körda koden mot tänkbara exceptions (fel)
        try {
            // Skapar controllernamn
            $controller = sprintf(
                $this->classname,
                $this->router->getModule(),
                $this->router->getController()
            );
            
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
        } catch (\Exception $e) {
            $this->catchException($e);
        }
    }
    
    /**
     * Skickar vidare fångade exceptions (fel) till en speciell
     * controller som visar felmeddelandet
     *
     * @param object $e Exception-objekt
     * @access protected
     */
    protected function catchException($e)
    {
        ob_clean();
        $output = new Controller\Exception($e);
        echo $output->index($e);
    }
}

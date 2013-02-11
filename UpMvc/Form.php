<?php
/**
 * /UpMvc/Form.php
 * @package UpMvc2
 */

namespace UpMvc;

/**
 * Skapa kompletta HTML-formulär
 * 
 * @author Ola Waljefors
 * @package UpMvc2
 * @version 2013.1.1
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 * 
 * @todo Klassen och dess ingående komponenter är under utveckling!
 */
class Form
{
    /**
     * @var string Formulärets id
     * @access private
     */
    private $id = 'UpMvc_Form';
    
    /**
     * @var string Formulärets postmethod
     * @access private
     */
    private $method;
    
    /**
     * @var string Formulärets action
     * @access private
     */
    private $action;
    
    /**
     * @var array Formulärets fält
     * @access private
     */
    private $fields;
    
    /**
     * @var object UpMvc\View-objekt
     * @access private
     */
    private $view;
    
    /**
     * TODO:
     * Typkontrollera andra argumentet
     * Ev. skicka in view som argument till controllern
     *
     * Konstruktor
     * @param string $method post|get
     * @param string $action
     * @throws \Exception Om $method inte är 'post' eller 'get'
     */
    public function __construct($method = 'post', $action = '')
    {
        if (strtolower ($method) != 'post' AND strtolower($method) != 'get') {
            throw new \Exception(sprintf(
                '%s: Första argumentet måste vara antingen '.
                '&quot;post&quot; eller &quot;get&quot;',
                __METHOD__
            ));
        }
        $this->method = $method;
        $this->action = ($action) ? $action : $_SERVER['PHP_SELF'];    
        $this->view = Container::get()->view;
    }
    
    /**
     * Skapa ett formulärfält och lagra i $fields
     * @param string $name Fältets namn
     * @param UpMvc\Form\Base $object Eller barn till
     * @throws \Exception Om $name inte är ett giltigt variabelnamn
     * @throws \Exception Om $object inte är ett UpMvc\Form\Base-objekt
     */
    public function __set($name, $object)
    {
        if (!preg_match('{^[a-zA-Z_\x7f-\xff][a-zA-Z0-9\x7f-\xff]}', $name)) {
            throw new \Exception(sprintf(
                '%s: Första argumentet måste vara ett giltigt variabelnamn',
                __METHOD__
            ));
        }
        if (!$object instanceof Form\Base) {
            throw new \Exception(sprintf(
                '%s: Andra argumentet måste vara ett objekt '.
                'av typen UpMvc\Form\Base',
                __METHOD__
            ));
        }
        $this->fields[$name] = $object;
    }
    
    /**
     * Sätt id på formuläret
     * @param string $id Formulärets id
     * @throws \Exception Om argumentet inte är ett giltigt variabelnamn
     */
    public function setId($id)
    {
        if (!preg_match('{^[a-zA-Z_\x7f-\xff][a-zA-Z0-9\x7f-\xff]}', $id)) {
            throw new \Exception(sprintf(
                '%s: Första argumentet måste vara ett giltigt variabelnamn',
                __METHOD__
            ));
        }
        $this->id = $id;
    }
    
    /**
     * Hämta fält
     * @param string $name Fältets namn
     * @return UpMvc\Form\Base
     */
    public function __get($name)
    {
        return $this->fields[$name];
    }
    
    /**
     * Hämta id
     * @return string id
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Hämta method
     * @return string method
     */
    public function getMethod()
    {
        return $this->method;
    }
    
    /**
     * Hämta action
     * @return string action
     */
    public function getAction()
    {
        return $this->action;
    }
    
    /**
     * Hämta formulärfält
     * @return array fields
     */
    public function getFields()
    {
        return $this->fields;
    }
    
    /**
     * Skapa det kompletta formuläret
     * @return string HTML-kod
     */
    public function render()
    {
        $this->view->set('form', $this);
        
        return $this->view->render('UpMvc/Form/View/base.php');
    }
}

<?php
/**
 * /UpMvc/Container.php
 *
 * @package UpMvc2
 */

namespace UpMvc;

/**
 * En DI-container för att hantera alla objekt i ramverket.
 *
 * Klassen följer designmönstret "singleton" som gör att bara ett objekt av
 * samma typ kan finnas i systemet. Dessutom använder den sig av "dependency
 * injection"-mönstret (DI) och sk. lazy loading (objekten skapas upp först när
 * de används).
 *
 * @package UpMvc2
 * @author  Ola Waljefors
 * @version 2014.2.2
 * @link    https://github.com/saurid/UpMvc2
 * @link    http://www.phpportalen.net/viewtopic.php?t=116968
 */
class Container
{
    /** @var UpMvc\Container Lagrar instans av klassen. */
    private static $instance;

    /** @var StdClass Lagrad data. */
    private $data;

    /**
     * Skapa och returnera en instans.
     *
     * Om klassen inte är instansierad så görs det, sedan returneras instansen.
     * Detta gör att endast ett objekt av typen kan finnas i systemet.
     *
     * @return UpMvc\Container
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
            self::$instance->data = new \StdClass();
        }

        return self::$instance;
    }

    /**
     * Vidarebefodra metodanrop
     *
     * @param string $name      Namn
     * @param array  $arguments Argument
     *
     * @return mixed
     */
    public function __call($name, $arguments = false)
    {
        return self::getInstance()->logic($name, $arguments);
    }

    /**
     * Vidarebefodra statiska metodanrop
     *
     * @param string $name      Namn
     * @param array  $arguments Argument
     *
     * @return mixed
     */
    public static function __callStatic($name, $arguments = false)
    {
        return self::getInstance()->logic($name, $arguments);
    }

    /**
     * Lagra eller returnera en egenskap.
     *
     * Om $name är en metod anropas den.
     * Om $name inte finns lagras datan.
     * Om $name är en lagrad closure, anropas den och ev returnerad data lagras.
     * Om $name är lagrad, returneras datan.
     *
     * @param string $name      Namn
     * @param array  $arguments Argument
     *
     * @throws \LogicException           Om en closure inte returnerade någon data.
     * @throws \InvalidArgumentException Om argument saknas när data ska lagras.
     * @return mixed
     */
    private function logic($name, $arguments = false)
    {
        // Om namn är en befintlig metod
        if (method_exists(self::$instance, $name)) {
            self::$instance->$name();
        } else {
            // Annars lagra eller returnera
            if (isset($this->data->$name)) {
                // Closure
                if (is_a($this->data->$name, 'Closure')) {
                    $this->data->$name = call_user_func_array($this->data->$name, $arguments);
                }
                if (!$this->data->$name) {
                    throw new \LogicException(sprintf('%s: Lagrad closure &quot;%s&quot; returnerade ingen data', __METHOD__, $name));
                }
                return $this->data->$name;
            } else {
                // Lagra
                if (!$arguments) {
                    throw new \InvalidArgumentException(sprintf('%s: Första argumentet får inte vara tomt', __METHOD__));
                }
                $this->data->$name = $arguments[0];
            }
        }

        // Om inget redan är returnerat
        return self::$instance;
    }

    /**
     * Lagra egenskap i containern.
     *
     * @param string $name  Namn
     * @param mixed  $value Värde
     *
     * @throws \InvalidArgumentException Om nyckeln inte är ett giltigt variabelnamn
     */
    public static function set($name, $value)
    {
        if (!preg_match('{^[a-zA-Z_\x7f-\xff][a-zA-Z0-9\x7f-\xff]}', $name)) {
            throw new \InvalidArgumentException(sprintf('%s: Första argumentet måste vara ett giltigt variabelnamn', __METHOD__));
        }
        self::getInstance()->data->$name = $value;
    }

    /** Tillåt inte instansiering med new eftersom construct är privat. */
    final private function __construct()
    {
    }

    /** Tillåt inte kloning av objektet eftersom clone är privat. */
    final private function __clone()
    {
    }
}

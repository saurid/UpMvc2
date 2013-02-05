<?php
/**
 * /UpMvc/Database.php
 * @package UpMvc2
 */

namespace UpMvc;

/**
 * Pagination
 *
 * Skapa en klickbar lista med länkar till sidor när du
 * behöver visa stora mängder data en bit i taget.
 *
 * @author Ola Waljefors
 * @package UpMvc2
 * @version 2013.1.1
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */
class Pagination
{
    /**
     * @var Totalt antal poster
     * @access private
     */
    private $total;
    
    /**
     * @var Aktuell sida
     * @access private
     */
    private $current;

    /**
     * @var Antal poster per sida
     * @access private
     */
    private $per;

    /**
     * Konstruktor
     * @param integer $total Totalt antal poster
     * @param integer $per Antal poster per sida
     * @param integer $current Aktuell sida
     * @param integer $adjacent Antal sidor vid sidan om aktuell
     */
    public function __construct($total, $current, $per = 10)
    {
        if (!is_numeric($total)) {
            throw new \Exception(sprintf(
                '%s: Första argumentet (totalantal) måste vara ett heltal',
                __METHOD__
            ));
        }
        if (!is_numeric($current)) {
            throw new \Exception(sprintf(
                '%s: Andra argumentet (aktuell sida) måste vara ett heltal',
                __METHOD__
            ));
        }
        if (!is_numeric($per)) {
            throw new \Exception(sprintf(
                '%s: Tredje argumentet (antal per sida) måste vara ett heltal',
                __METHOD__
            ));
        }

        $this->total    = $total;
        $this->current  = $current;
        $this->per      = $per;
    }

    /**
     * Hämta totalt antal poster
     * @return integer
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Hämta aktuell sida
     * @return integer
     */
    public function getCurrent()
    {
        return $this->current;
    }

    /**
     * Hämta antal poster per sida
     * (alias för metoden getLimit())
     * @return integer
     */
    public function getPer()
    {
        return $this->per;
    }

    /**
     * Hämta limit för användning i SQL-fråga
     * (alias för metoden getPer())
     * @return integer
     */
    public function getLimit()
    {
        return $this->per;
    }

    /**
     * Hämta offset för användning i SQL-fråga
     * @return integer
     */
    public function getOffset()
    {
        return ($this->current - 1) * $this->per;
    }

    /**
     * Hämta färdig SQL LIMIT/OFFSET-sträng
     * @return string
     */
    public function getSqlLimit()
    {
        return sprintf(
            'LIMIT %d OFFSET %d',
            $this->getLimit(),
            $this->getOffset()
        );
    }

    /**
     * Generera HTML-kod med länkar till sidor
     * @return string Sträng med länkar
     */
    public function getNav()
    {
        $pages  = $this->getArray();
        $output = '';

        foreach($pages as $page)
        {
            if ($page != $this->current) {
                $output .= "<a href=\"?page=$page\">$page</a>\n";
            }
            else {
                $output .= "[{$page}]\n";
            }
        }

        return $output;
    }

    /**
     * Hämta en array med de sidor som ska visas
     * @access private
     * @return array
     */
    private function getArray()
    {
        return range(1, ceil($this->total / $this->per));
    }
}

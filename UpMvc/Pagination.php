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
     * @var Antal sidor vid sidan om aktuell
     * @access private
     */
    private $adjacent;

    /**
     * Konstruktor
     * @param integer $total Totalt antal poster
     * @param integer $per Antal poster per sida
     * @param integer $current Aktuell sida
     * @param integer $adjacent Antal sidor vid sidan om aktuell
     */
    public function __construct($total, $current, $per = 10, $adjacent = false)
    {
        $this->total    = $total;
        $this->current  = $current;
        $this->per      = $per;
        $this->adjacent = $adjacent;
    }

    /**
     * Hämta limit för användning i SQL-fråga
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
     * Generera HTML-kod med länkar till sidor
     * @return string Sträng med länkar
     */
    public function getLinks()
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

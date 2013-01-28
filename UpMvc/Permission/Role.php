<?php
/**
 * /UpMvc/Permission/Role.php
 * @package UpMvc2
 */
/**
 * Sätt rättigheter i ramverket
 * 
 * Under utveckling!
 *
 * @author Ola Waljefors
 * @package UpMvc2
 * @subpackage Permission
 * @version 2013.1.1
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */
class UpMvc_Permission_Role
{
    /**
     * @var string Id-sträng för noden
     * @access private
     */
    private $id;
    
    /**
     * @var array Array med noder
     * @access private
     */
    private $nodes = array();
    
    /**
     * Konstruktor
     * @param string $id Id-sträng för noden
     * @param object $node UpMvc_auth_node
     */
    public function __construct($id, $node = null)
    {
        $this->id = $id;
        if ($node) $this->add($node);
    }
    
    /**
     * Lägg till nya noder
     * @param array|object $node UpMvc_auth_node-objekt, eller en array med UpMvc_auth_node-objekt
     * @return object $this
     */
    public function add($node)
    {
        if (is_object($node)) {
            $this->nodes[] = $node;
        }
        if (is_array($node)) {
            $this->nodes = array_merge($this->nodes, $node);
        }

        return $this;
    }
    
    /**
     * Autenticera
     * @param string $id Id-sträng som testas
     * @return bool Sant om noden finns, falskt om noden inte finns
     */
    public function role($id)
    {
        return $this->check($id);
    }
    
    /**
     * Testa nod för id-sträng
     * @param string $id
     * @return bool
     */
    public function check($id)
    {
        if ($this->id == $id) {
            return true;
        }
        foreach ($this->nodes as $node) {
            if ($node->check($id) || $node->id == $id) {
                return true;
            }
        }
        
        return false;
    }
}

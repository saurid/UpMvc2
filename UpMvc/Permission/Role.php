<?php
/**
 * /UpMvc/Permission/Role.php
 * @package UpMvc2
 */

namespace UpMvc\Permission;

/**
 * Sätt rättigheter i ramverket
 * 
 * @todo Under utveckling!
 *
 * @author Ola Waljefors
 * @package UpMvc2
 * @subpackage Permission
 * @version 2013.1.1
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */
class Role
{
    /**
     * @var string Id-sträng för rollen
     * @access private
     */
    private $id;
    
    /**
     * @var array Array med roller
     * @access private
     */
    private $roles = array();
    
    /**
     * Konstruktor
     * @param string $id Id-sträng för rollen
     * @param UpMvc\Permission\Role $role
     */
    public function __construct($id, $role = null)
    {
        $this->id = $id;
        if ($role) $this->add($role);
    }
    
    /**
     * Lägg till nya roller
     * @param array|object $role UpMvc\Permission\Role-objekt, eller en array med UpMvc\Permission\Role-objekt
     * @return UpMvc\Permission
     */
    public function add($role)
    {
        if (is_object($role)) {
            $this->roles[] = $role;
        }
        if (is_array($role)) {
            $this->roles = array_merge($this->roles, $role);
        }

        return $this;
    }
    
    /**
     * Autenticera
     * @param string $id Id-sträng som testas
     * @return bool Sant om rollen finns, falskt om rollen inte finns
     */
    public function role($id)
    {
        return $this->check($id);
    }
    
    /**
     * Testa roll för id-sträng
     * @param string $id
     * @return bool
     */
    public function check($id)
    {
        if ($this->id == $id) {
            return true;
        }
        foreach ($this->roles as $role) {
            if ($role->check($id) || $role->id == $id) {
                return true;
            }
        }
        
        return false;
    }
}

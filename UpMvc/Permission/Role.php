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
 * @version 2013.2.4
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
    protected $roles = array();
    
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
     * Testa roll för id-sträng
     * @param string $id
     * @access private
     * @return bool
     */
    private function has($id)
    {
        foreach ($this->roles as $role) {
            if ($role->id == $id OR $role->has($id)) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * Testa rättighet
     * @param string $id Roll att testa mot
     * @param string $role Rättighet att testa
     * @return bool Sant om rollen har rättigheten, annars falskt
     */
    public function check($id, $role)
    {
        return $this->roles[$id]->has($role);
    }
}

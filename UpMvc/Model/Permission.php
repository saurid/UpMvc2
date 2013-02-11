<?php
/**
 * /UpMvc/Model/Permission.php
 * @package UpMvc2
 */

namespace UpMvc\Model;

use UpMvc;

/**
 * Testmodell för rättighets-klasserna
 *
 * @todo Under utveckling!
 *
 * @author Ola Waljefors
 * @package UpMvc2
 * @version 2013.1.1
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */
class Permission
{
    /**
     * @var array Roller lagrade i en array
     * @access private
     */
    private $roles = array();
    
    /**
     * Konstruktor
     * Sätt upp roller och rättigheter
     */
    public function __construct()
    {
        // Besökare
        $this->roles['visitor'] =
            new UpMvc\Permission\Role('visitor');
            
        $this->roles['visitor']->add(array(
            new UpMvc\Permission\Role('create topic'),
            new UpMvc\Permission\Role('create post'),
            new UpMvc\Permission\Role('read forum'),
            new UpMvc\Permission\Role('read topic'),
            new UpMvc\Permission\Role('read post')
        ));
        
        // Redigerare, ärver besökare
        $this->roles['editor'] =
            new UpMvc\Permission\Role('editor');
            
        $this->roles['editor']->add(array(
            new UpMvc\Permission\Role('update forum'),
            new UpMvc\Permission\Role('update topic'),
            new UpMvc\Permission\Role('update post'),
            $this->roles['visitor'] // ärver besökare
        ));
        
        // Administratör, ärver redigerare (editor)
        $this->roles['admin'] =
            new UpMvc\Permission\Role('admin');
            
        $this->roles['admin']->add(array(
            new UpMvc\Permission\Role('delete forum'),
            new UpMvc\Permission\Role('delete topic'),
            new UpMvc\Permission\Role('delete post'),
            $this->roles['editor'] // ärver redigerare (editor)
        ));
    }
    
    /**
     * Testa rättighet
     * @param string Roll att testa mot
     * @param string Rättighet att testa
     * @return bool Sant om rollen har rättigheten, annars falskt
     */
    public function check($role, $permission)
    {
        return $this->roles[$role]->check($permission);
    }
}

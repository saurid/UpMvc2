<?php
/**
 * /UpMvc/Model/Permission.php
 * @package UpMvc2
 */

namespace UpMvc\Model;

use UpMvc;

/**
 * Exempelmodell för rättighets-klass
 *
 * Sätter upp grupper (i detta fallet visitor, editor och administrator).
 * Roller sätts till var och en av grupperna, och grupperna ärvs uppåt
 * från visitor till editor och från editor till administrator. 
 * 
 * Exempel på användning:
 * <code>
 * $userrole = 'administrator';
 * $permission = new Model\Permission();
 * 
 * if ($permission->check($userrole, 'administrator')) {
 *     echo 'Användaren är en administratör';
 * }
 *
 * if ($permission->check($userrole, 'create category')) {
 *     echo 'Användaren får skapa nya kategorier';
 * }
 * </code>
 * 
 * @author Ola Waljefors
 * @package UpMvc2
 * @version 2013.2.5
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */
class Permission
{
    /**
     * @var Lagrade grupper
     * @access private
     */
    private $group;

    /**
     * Konstruktor
     * Sätt upp grupper och roller
     */
    public function __construct()
    {
        // Sätt upp grupperna visitor, editor och administrator
        $this->group['visitor']       = new UpMvc\Role('visitor');
        $this->group['editor']        = new UpMvc\Role('editor');
        $this->group['administrator'] = new UpMvc\Role('administrator');

        // Sätt rättigheter/roller för gruppen visistor
        $this->group['visitor']
            ->add(new UpMvc\Role('read public'))
            ->add(new UpMvc\Role('create topic'))
            ->add(new UpMvc\Role('create user'));

        // editor, ärver visitor genom att lägga till gruppen visitor med add()
        $this->group['editor']
            ->add(new UpMvc\Role('read private'))
            ->add(new UpMvc\Role('create category'))
            ->add(new UpMvc\Role('change user'))
            ->add($this->group['visitor']); // ärver visitor

        // administrator, ärver editor och därmed även visitor
        $this->group['administrator']
            ->add(new UpMvc\Role('delete user'))
            ->add(new UpMvc\Role('delete category'))
            ->add($this->group['editor']); // ärver editor
    }

    /**
     * Kontrollera om en grupp innehåller en roll
     * @param string $group Grupp att testa mot
     * @param string $role Roll att testa
     * @return bool True om rollen finns, false om den inte finns
     */
    public function check($group, $role)
    {
        return $this->group[$group]->has($role);
    }
}

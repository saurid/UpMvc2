<?php
/**
 * Konfiguration för Applikationen i mappen App
 *
 * @author Ola Waljefors
 * @package UpMVC
 * @version 2013.1.1
 * @link https://github.com/saurid/Up-MVC
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */

$c = UpMvc\Container::get();

/**
 * Databasuppgifter
 */
$c->db_engine   = 'mysql';
$c->db_host     = 'localhost';
$c->db_user     = 'root';
$c->db_password = '';
$c->db_name     = '';

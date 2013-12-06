<?php
/**
 * Konfiguration för Applikationen i mappen App.
 *
 * @package App
 * @author  Ola Waljefors
 * @version 2013.12.1
 * @link    https://github.com/saurid/UpMvc2
 * @link    http://www.phpportalen.net/viewtopic.php?t=116968
 */

namespace App;

use UpMvc\Container as Up;

/** Databasuppgifter */
Up::set('db_engine',   'mysql');
Up::set('db_host',     'localhost');
Up::set('db_user',     'root');
Up::set('db_password', '');
Up::set('db_name',     '');

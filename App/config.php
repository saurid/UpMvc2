<?php
/**
 * Konfiguration för Applikationen i mappen App.
 *
 * @package App
 * @author  Ola Waljefors
 * @version 2014.2.2
 * @link    https://github.com/saurid/UpMvc2
 * @link    http://www.phpportalen.net/viewtopic.php?t=116968
 */

namespace App;

use UpMvc\Container as Up;

/** Databasuppgifter */
Up::app_db_engine('mysql')
  ->app_db_host('localhost')
  ->app_db_user('root')
  ->app_db_password('')
  ->app_db_name('');

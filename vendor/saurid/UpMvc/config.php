<?php
/**
 * Konfiguration av Up MVC's kärna.
 *
 * Sätter upp objektberoenden genom closures och lagrar dem i servicecontainern.
 * OBS: Ändra inte om du inte vet vad du gör!
 *
 * @package UpMvc2
 * @author  Ola Waljefors
 * @version 2014.2.2
 * @link    https://github.com/saurid/UpMvc2
 * @link    http://www.phpportalen.net/viewtopic.php?t=116968
 */

namespace UpMvc;

use UpMvc\Container as Up;

/** Variabler */
Up::site_path(rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\'));

/** Closure som returnerar en instans av UpMvc\Database. */
Up::database(function () {
        return new Database(Up::pdo());
});

/** Returnera instans av PDO. */
Up::pdo(function () {
    $dsn = sprintf(
        '%s:dbname=%s;host=%s',
        Up::app_db_engine(),
        Up::app_db_name(),
        Up::app_db_host()
    );
    return new \PDO(
        $dsn,
        Up::app_db_user(),
        Up::app_db_password(),
        array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
    );
});

/** Returnera instans av UpMvc\Request. */
Up::request(function () {
    return new Request();
});

/** Returnera instans av UpMvc\View. */
Up::view(function () {
    return new View();
});

/**
 * Returnera instans av UpMvc\Pagination.
 *
 * @param integer $total   Totalt antal sidor.
 * @param integer $current Aktuell sida.
 * @param integer $per     Antal poster per sida.
 */
Up::pagination(function ($total, $current, $per = 10) {
    return new Pagination($total, $current, $per);
});

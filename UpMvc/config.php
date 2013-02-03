<?php
/**
 * Konfiguration av Up MVC's kärna
 *
 * Sätter upp objektberoenden genom closures och lagrar dem i servicecontainern.
 * OBS: Ändra inte om du inte vet vad du gör!
 *
 * @author Ola Waljefors
 * @package UpMvc2
 * @version 2013.1.1
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */

namespace UpMvc;

$c = Container::get();

/**
 * Variabler
 */
$c->site_path = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

/**
 * Closure som returnerar en instans av UpMvc\Database
 */
$c->database = function () use ($c) {
    return new Database($c->pdo);
};

/**
 * Closure som returnerar en instans av UpMvc\Database
 */
$c->form = function () use ($c) {
    return new Form();
};

/**
 * Closure som returnerar en instans av UpMvc\FrontController
 */
$c->frontcontroller = function () use ($c) {
    return new FrontController($c->router);
};

/**
 * Closure som returnerar en instans av PDO
 */
$c->pdo = function () use ($c) {
    $dsn = sprintf(
    	'%s:dbname=%s;host=%s',
    	$c->db_engine,
    	$c->db_name,
    	$c->db_host
    );
    return new \PDO(
    	$dsn,
    	$c->db_user,
    	$c->db_password,
    	array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
    );
};

/**
 * Closure som returnerar en instans av UpMvc\Request
 */
$c->request = function () use ($c) {
    return new Request();
};

/**
 * Closure som returnerar en instans av UpMvc\Router
 */
$c->router = function () use ($c) {
    return new Router($c->request->get('r'));
};

/**
 * Closure som returnerar en instans av UpMvc\View
 */
$c->view = function () use ($c) {
    return new View();
};

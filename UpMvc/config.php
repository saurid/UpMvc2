<?php
/**
 * Konfiguration för ramverket.
 *
 * @author Ola Waljefors
 * @package UpMvc2
 * @version 2013.1.1
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */
/**
 * Konfiguration av Up MVC's kärna
 * OBS: Ändra inte om du inte vet vad du gör!
 */
$c = UpMvc\Container::get();

$c->site_path = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
$c->route = isset($_GET['r']) ? $_GET['r'] : '';

$c->database = function() use ($c) {
    return new UpMvc\Database($c->pdo);
};

$c->frontcontroller = function() use ($c) {
    return new UpMvc\FrontController($c->router);
};

$c->pdo = function() use ($c) {
    $dsn = sprintf(
    	'%s:dbname=%s;host=%s',
    	$c->db_engine,
    	$c->db_name,
    	$c->db_host
    );
    return new PDO(
    	$dsn,
    	$c->db_user,
    	$c->db_password,
    	array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
    );
};

$c->request = function() use ($c) {
    return new UpMvc\Request();
};

$c->router = function() use ($c) {
    return new UpMvc\Router($c->route);
};

$c->view = function() use ($c) {
    return new UpMvc\View();
};

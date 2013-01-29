<?php
/**
 * Första anhalten i ramverket
 * 
 * Hämtar konfiguration och startar upp alla nödvändiga objekt som behövs.
 * Autoloader som automatiskt laddar in klasser (include behöver inte användas).
 * Error handler som möjliggör snyggare och mer funktionsrika felmeddelanden.
 * Till sist körs front controllern som delegerar vidare körningen av sidan till
 * rätt Controller/action.
 *
 * @author Ola Waljefors
 * @package UpMvc2
 * @version 2013.1.1
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */

namespace UpMvc;

/**
 * Starta automatisk laddning av klasser
 */
require 'UpMvc/Autoload.php';
$autoloader = new Autoload();
$autoloader->register();

/**
 * Starta felhantering av php-funktioner utan exceptions
 */
$errorhandler = new ErrorHandler();
$errorhandler->register();

/**
 * Ladda konfigurationer och starta session
 */
require 'UpMvc/config.php';
require 'App/config.php';
session_start();

/**
 * Kör frontcontroller från servicecontainern
 */
Container::get()->frontcontroller->dispatch();

<?php
/**
 * Första anhalten i ramverket.
 * 
 * Hämtar konfiguration och startar upp alla nödvändiga objekt som behövs.
 * Autoloader som automatiskt laddar in klasser (include behöver inte användas).
 * Error handler som möjliggör snyggare och mer funktionsrika felmeddelanden.
 * Till sist körs routern som delegerar vidare körningen av sidan till
 * rätt Controller/action.
 *
 * @package UpMvc2
 * @author  Ola Waljefors
 * @version 2013.12.1
 * @link    https://github.com/saurid/UpMvc2
 * @link    http://www.phpportalen.net/viewtopic.php?t=116968
 */

namespace UpMvc;

/** Starta automatisk laddning av klasser. */
require 'vendor/UpMvc/Autoloader.php';
$autoloader = new Autoloader();
$autoloader->addNamespace('App', __DIR__ . '/App');
$autoloader->addNamespace('UpMvc', __DIR__ . '/vendor/UpMvc');
$autoloader->addNamespace('Documentation', __DIR__ . '/Documentation');
$autoloader->register();

/** Ladda intern konfiguration. */
require 'vendor/UpMvc/config.php';

/**
 * Starta hantering av shutdown errors (php Fatal errors),
 * php-funktioner utan exceptions samt vanliga exceptions.
 */
$shutdownhandler = new ShutdownHandler();
$shutdownhandler->register();
$errorhandler = new ErrorHandler();
$errorhandler->register();
$exceptionhandler = new ExceptionHandler();
$exceptionhandler->register();

/** Ladda applikationens konfiguration och starta session. */
require 'App/config.php';
session_start();

/** Kör aktuell route från URL. */
Route::execute();

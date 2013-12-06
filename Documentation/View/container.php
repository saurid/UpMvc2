<?php
/**
 * HTML-dokumentationen för Up MVC.
 *
 * @package UpMvc2\Documentation
 * @author  Ola Waljefors
 * @version 2013.12.1
 * @link    https://github.com/saurid/UpMvc2
 * @link    http://www.phpportalen.net/viewtopic.php?t=116968
 */

namespace UpMvc\View;

use UpMvc;
use UpMvc\Container as Up;

?>

<h3>Servicecontainern</h3>

<p>Du har redan sett flera exempel på hur containern används i Up MVC och den är en viktig
del av ramverket. En Dependency Injection Container gör att alla klasser och objekt kan
optimeras efter best practice, samtidigt som skapandet (instansieringen) av dem kan
göras enkel. Du skapar och hämtar dem genom ett enkelt metodanrop, men du behöver inte veta
hur de skapas (beroenden av andra objekt eller variabler t.ex.), det håller containern reda på.</p>

<p>Objekten skapas bara upp när de först anropas, så inga objekt laddas/skapas upp i onödan
(s.k. lazy loading). Containern lagrar dessutom instanser av varje objekt, vilket gör att endast
ett objekt av varje typ finns aktivt i systemet samtidigt. Varje gång du använder ett objekt som
är lagrad i containern så är det exakt samma oavsett varifrån du anropar den.</p>

<pre>
<span class="comment">// Glöm inte att sätta ett alias till containern!</span>
use UpMvc\Container as Up;

<span class="comment">// Lagra eller skriv över egna variabler</span>
Up::set(&apos;nyckel&apos;, &apos;värde&apos;;
Up::set(&apos;nyckel2&apos; &apos;ett annat värde&apos;;

<span class="comment">// Använd egna variabler</span>
echo Up::nyckel();  <span class="comment">// Skriver ut &quot;värde&quot;</span>
echo Up::nyckel2(); <span class="comment">// Skriver ut &quot;ett annat värde&quot;</span>
</pre>


<p>Det finns ett gäng fördefinierade metoder som används för att nå delar av
ramverkets kärna. De är:</p>

<pre>
<span class="comment">// Fördefinerade variabler för Up MVC</span>
Up::site_path();  <span class="comment">// Sökväg till ramverket</span>
Up::database();   <span class="comment">// UpMvc\Database object</span>
Up::pagination(); <span class="comment">// UpMvc\Pagination object</span>
Up::request();    <span class="comment">// UpMvc\Request object</span>
Up::view();       <span class="comment">// UpMvc\View object</span>

<span class="comment">// Fördefinerade för App (från filen App/config.php)</span>
Up::db_engine();   <span class="comment">// Databasmotor (vanligtvis mysql)</span>
Up::db_host();     <span class="comment">// Servernamn</span>
Up::db_user();     <span class="comment">// Användarnamn för databas</span>
Up::db_password(); <span class="comment">// Lösenord för databas</span>
Up::db_name();     <span class="comment">// Databasens namn</span>
</pre>

<div class="note">
    <p>Var försiktig med de fördefinerade variablerna - Det finns i skrivande
    stund inget som hindrar att du skriver över dem med annat. Det kan därför 
    vara en bra idé att använda ett prefix till dina egna variabler som du
    lagrar i containern.</p>
</div>

<p>Du kan lagra allt från enkla siffror eller strängar, till stora arrays eller
komplicerade objekt. Nyckeln måste vara ett giltigt variabelnamn, om inte så kommer Up MVC
att generera ett felmeddelande.</p>

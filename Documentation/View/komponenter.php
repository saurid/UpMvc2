<?php
/**
 * HTML-dokumentationen för Up MVC.
 *
 * @package UpMvc2\Documentation
 * @author  Ola Waljefors
 * @version 2013.12.2
 * @link    https://github.com/saurid/UpMvc2
 * @link    http://www.phpportalen.net/viewtopic.php?t=116968
 */

namespace UpMvc\View;

use UpMvc;
use UpMvc\Container as Up;

?>

<h3>Använda tredjepartskomponenter</h3>

<p>Genom sin standardiserade layout, användandet av namespaces och automatisk
inladdning av klasser, så är ramverket förberedd för att kunna använda tredjeparts-
komponenter från andra utvecklare.</p>

<p>Komponenter eller paket som också är standardiserade och följer reglerna uppsatta i
<a href="https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md">PSR-0</a>
(Proposed Standards Recommendation utvecklad av PHP Framework Interoperability Group)
går därför att lägga till Up MVC utan några stora ingrepp.</p>

<p>Tänk dig att du behöver ett sätt att handskas med flera olika språk på din webbplats
och du har hittat att det finns ett bra verktyg i
<a href="https://github.com/symfony/Translation">symfonys Translation Component</a>.</p>

<p>Jag ska i denna dokumentationen inte förklara hur man hämtar paket från GitHub
utan där får jag hänvisa till sökningar på nätet. Men det är inte särskilt
komplicerat, speciellt inte om du nöjer dig med att ladda ner den som zip-fil.</p>

<p>Alla komponenter läggs in i mappen <code>vendor/</code> i systemet. Translation-
paketet har en namespace som ser ut som följande: <code>Symfony\Component\Translation</code>,
så mappstrukturen ska sedan följa samma mönster som detta. Paketet läggs således i
följande mapp: <code>vendor/Symfony/Component/Translation</code>.</p>

<p>För att sedan kunna börja använda komponenten behöver du registrera dess namespace
i Up MVC&apos;s autoloader. Om du tar en titt i ramverkets index-fil så bör du snabbt
se hur det ska göras. Så här ser raderna ut i index-filen som rör autoloading:</p>

<pre>
<span class="comment">// Fil: index.php</span>

<span class="comment">/** Starta automatisk laddning av klasser. */</span>
require 'vendor/UpMvc/Autoloader.php';
$autoloader = new Autoloader();
$autoloader->addNamespace('App', __DIR__ . '/App');
$autoloader->addNamespace('UpMvc', __DIR__ . '/vendor/UpMvc');
$autoloader->addNamespace('Documentation', __DIR__ . '/Documentation');
$autoloader->register();
</pre>

<p>Det vi gör här är alltså att först ladda in autoloadern sedan skapa en instans av
klassen (skapa ett objekt). Efter det lägger vi till de namespace vi behöver använda oss
av och slutligen registrerar (startar) vi autoloadern i systemet. Metoden
<code>addNamespace()</code> tar två argument. Den första är det namespace du refererar till
och det andra argumentet är sökvägen där filerna i namespacet ligger.</p>

<p>Så för att lägga till vårt nya paket skriver du:</p>

<pre>
<span class="comment">// Registrera namespace till symfony Translator i index.php</span>
$autoloader-&gt;addNamespace('Symfony\Component\Translation', __DIR__ . '/vendor/Symfony/Component/Translation');
</pre>

Nu är det generellt sett inte en smart idé att ändra i Up MVC's interna
kod (uppdateringar blir svårare då), så bättre är kanske att lägga in raden i
filen <code>App/config.php</code> istället. Då blir sökvägen lite annorlunda,
men annars är det samma sak:

<pre>
<span class="comment">// Registrera namespace till symfony Translatori App/config.php</span>
$autoloader-&gt;addNamespace('Symfony\Component\Translation', __DIR__ . '../../vendor/Symfony/Component/Translation');
</pre>

<p>Hepp! Nu är det fritt fram att använda symfonys Translator i ditt egna projekt!</p>

<p>Läs mer på <a href="https://github.com/symfony/Translation">GitHub</a>, och följ länkarna om hur du använder den</p>

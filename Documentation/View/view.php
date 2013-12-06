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

<h3>View-objekt och mallar</h3>

<p>View-lagret i Up MVC består av två delar; Ett view-objekt, som du har direkt åtkomst till i
dina controllers, och mallar (templates på engelska). Oftast kommer
dina mallar att innehålla all HTML-uppmärkning på webbplatsen och PHP-variabler inskjutet i
HTML-koden. Dina mallar sparar du i mappen <code>App/View/</code> som vanliga PHP-filer med
ändelsen <code>.php</code></p>

<p>En enkel layout till din hemsida kan tex. se ut som nedan:</p>

<pre>
<span class="comment">&lt;!-- Fil: App/View/layout.php --&gt;</span>
&lt;!DOCTYPE HTML&gt;
&lt;html&gt;
&lt;head&gt;
<span class="comment">&lt;!-- HTML-titel --&gt;</span>
&lt;title&gt;&lt;?php echo $title; ?&gt;&lt;/title&gt;
&lt;/head&gt;
&lt;body&gt;

<span class="comment">&lt;!-- Överskrift --&gt;</span>
&lt;?php echo $header; ?&gt;

<span class="comment">&lt;!-- Brödtext / Innehåll --&gt;</span>
&lt;?php echo $content; ?&gt;

&lt;/body&gt;
&lt;/html&gt;
</pre>

<p>Som du ser innehåller mallen allt en HTML-sida behöver. I layouten kan du sedan byta ut
valda delar mot andra; HTML-titlen, överskriften och själva brödtexten i tre olika namngivna
PHP-variabler.</p>

<p>Så hur gör du då för att använda dig av denna layouten?</p>

<p>Tänk dig att du med hjälp av URL-routen <code>/Visa/omsidan</code> vill visa en sida om
vad din webbplats handlar om och vem du är. Genom den URL&apos;en vet du att du behöver en
controller, <code>visa</code>, och i den en action som heter <code>omsidan()</code>.</p>

<p>I metoden/action <code>omsidan()</code> behöver du fylla i variablerna för HTML-titeln,
överskriften och innehållet och slutligen använda layouten vi definerat för att skapa upp
och visa sjäva sidan för besökaren. Vi behöver inga extra parametrar för att visa sidan.</p>

<p>Exempel:</p>

<pre>
&lt;?php
<span class="comment">// Fil: App/Controller/Visa.php</span>
namespace App\Controller;

use UpMvc;
use UpMvc\Container as Up;

class Visa
{
    public function omsidan()
    {
        <span class="comment">// Lagra strängar i variabler samt skapa</span>
        <span class="comment">// upp och skriv ut sidan med vår layout</span>
        Up::view()
            -&gt;set(&apos;title&apos;,   &apos;Om webbplatsen&apos;)
            -&gt;set(&apos;header&apos;,  &apos;Om denna webbplatsen&apos;)
            -&gt;set(&apos;content&apos;, &apos;... Brödtext ...&apos;)
            -&gt;render(&apos;App/View/layout.php&apos;);
    }
}
</pre>

<p>Du når view-objektet (<code>UpMvc\View</code>) genom att använda Up MVC&apos;s inbyggda
service container (eller dependency injection container) genom:</p>

<p><code>Up::view()</code></p>

<p>Det skrivs egentligen <code>UpMvc\Container::view()</code>, men varför inte använda namespaces
för att förenkla saker och ting? Genom att vi använder <code>use UpMvc\Container as Up;</code>
i toppen av filen så förkortar vi det hela avsevärt.</p>

<p>Containern gör att du kan komma åt de flesta av ramverkets systemobjekt varsomhelst
i dina controllers.</p>

<div class="note">
    <p>Service containern kan lagra vilken variabel som helst. Du kan antingen
    lägga till variabler med data i App/config.php, eller göra det i kontroller eller
    modeller. Allt beroende på vilka behov du har. Mer om detta i kapitlet om
    servicecontainern.</p>
</div>

<p>View-objektet har bara två metoder:</p>

<p><code>set(string $key, mixed $value)</code> använder du för att sätta variabler
som du sedan nyttjar i dina mallar. Metoden tar två argument. Första argumentet är en nyckel
som identifierar din variabel. Nyckeln omvandlas sedan av view-objektet till variabler, så
namnet måste följa samma regler som generella variabelnamn i PHP. Andra argumentet är själva
innehållet för din variabel.</p>

<p>Du kan skicka alla typer av innehåll vidare till din view. Strängar, arrays, objekt eller
resurser tex. i Vårt exempel skickar vi bara strängar vidare till layouten. </p>

<p><code>render(string $view)</code> använder du för att rendrera, dvs. generera en
(ofta ganska stor) sträng med innehållet i angiven mall. Det enda argumentet är sökvägen till
din mall. Den rendrerade strängen returneras, så du kan välja att
lagra den i en variabel, eller att skriva ut den med <code>echo</code> direkt.</p>

<p>Om du kör denna koden genom Up MVC, så borde du se en mycket enkel HTML-sida med
en överskrift och en mycket kort dummy-brödtext!</p>

<p>Här har vi nästa uppgift att ta hand om. Det är inte särskilt praktiskt, faktiskt ganska
dumt, att sätta en hel brödtext i controllern. Mer logiskt hade varit att hämta innehållet
från en databas kanske. Men i vårt fall där innehållet kan antas vara helt statiskt, så
kan vi använda ytterligare en HTML-mall.</p>

<p>Begrunda följande minimalistiska mall, med brödtexten till din om-sida:</p>

<pre>
<span class="comment">&lt;!-- Fil: App/View/omsidan.php --&gt;</span>
&lt;p&gt;
Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
enim ad minim veniam, quis nostrud exercitation ullamco laboris
nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
in reprehenderit in voluptate velit esse cillum dolore eu fugiat
nulla pariatur. Excepteur sint occaecat cupidatat non proident,
sunt in culpa qui officia deserunt mollit anim id est laborum
&lt;/p&gt;
</pre>

<p>Nu vill vi rendrera den mallen och lagra i <code>$content</code>
med hjälp av <code>$c-&gt;view-&gt;render()</code> istället för den korta strängen vi
använde oss av tidigare.</p>

<pre>
&lt;?php
<span class="comment">// Fil: App/Controller/Visa.php</span>
namespace App\Controller;

use UpMvc;
use UpMvc\Container as Up;

class Visa
{
    public function omsidan()
    {
        <span class="comment">// Lagra strängar i variabler</span>
        Up::view
            -&gt;set(&apos;title&apos;,  &apos;Om webbplatsen&apos;)
            -&gt;view-&gt;set(&apos;header&apos;, &apos;Om denna webbplatsen&apos;);
        
        <span class="comment">// Rendrera brödtexten från mallen omsidan och lagra i $content</span>
        $om = Up::view-&gt;render(&apos;App/View/omsidan.php&apos;);
        Up::view-&gt;set(&apos;content&apos;, $om);
        
        <span class="comment">// Skapa och skriv ut hela sidan</span>
        echo Up::view-&gt;render(&apos;App/View/layout.php&apos;);
    }
}
</pre>

<p>Med hjälp av <code>$om = Up::view-&gt;render(&apos;App/View/omsidan.php&apos;);</code> rendrerar och lagrar
vi så den nya mallen i en variabel och med <code>Up::view-&gt;set(&apos;content&apos;, $om);</code>
ser vi till att vi kan använda den i layouten.</p>

<p>Solklart, eller hur? På samma sätt kan vi lägga upp alla statiska sidor av en webbplats om vi
vill. Vi får en snygg URL och kan återanvända samma layout-mall på varje sida utan några problem.
De största fördelarna når vi dock när sidan blir lite mer komplicerad och börjar bli mer
dynamisk och interaktiv.</p>





<h4>Använda &quot;method chaining&quot; med view-objektet</h4>

<p>På en hyffsat stor webbplats så kommer du att behöva sätta ganska många variabler
i view-objektet. Förutom de enklaste strängarna så kan det vara resultat och data
från databaser, andra objekt m.m.</p>

<p>Views <code>set()</code> tillåter därför method chaining så att du kan sätta flera variabler till
vy-objektet en efter en istället för att skriva ut variabeln <code>Up::view()</code> varje gång.
Det gör att det blir lite lättare att snabbt läsa av koden med ögonen, men det är
bara en rent estetiskt funktion och tillför inte mycket annat i Up MVC.
Se exempel utan och med method chaining nedan:</p>

<pre>
<span class="comment">// Utan method chaining:</span>
Up::view-&gt;set(&apos;title&apos;,         $item[0][&apos;name&apos;]);
Up::view-&gt;set(&apos;cart&apos;,          $this-&gt;cart);
Up::view-&gt;set(&apos;categories&apos;,    $categories);
Up::view-&gt;set(&apos;categorycount&apos;, count($categories));
Up::view-&gt;set(&apos;item&apos;,          $item[0]);
Up::view-&gt;set(&apos;content&apos;,       Up::view-&gt;render(&apos;App/View/item.php&apos;));
 
<span class="comment">// Med method chaining:</span>
Up::view
    -&gt;set(&apos;title&apos;,         $item[0][&apos;name&apos;])
    -&gt;set(&apos;cart&apos;,          $this-&gt;cart)
    -&gt;set(&apos;categories&apos;,    $categories)
    -&gt;set(&apos;categorycount&apos;, count($categories))
    -&gt;set(&apos;item&apos;,          $item[0])
    -&gt;set(&apos;content&apos;,       Up::view-&gt;render(&apos;App/View/item.php&apos;));
</pre>

<p>Notera att du inte använder semikolon efter de första raderna, utan endast efter sista raden.</p>


<h4>Använda standardsökväg till mallar</h4>

<p>View-objektet har funktionalitet för att sätta vilken mapp mallar ska hämtas ifrån genom
metoden <code>setPath()</code>. Metoden tar ett argument, en sträng/sökväg som läggs till som prefix
till din mall varje gång <code>render()</code> anropas.<p>

<div class="note">
    <p>Även om det ibland kan vara praktiskt med den funktionen så förutsätter den en
    viss försiktighet om View-objektet används genom containern (vilket man vanligtvis gör).
    Eftersom samma View-objekt alltid returneras gäller det att vara medveten om att samma path
    kommer att användas överallt!
    <br />
    <br />
    Av den anledningen finns ett andra argumentet i <code>render()</code>.
    Om andra argumentet sätts till true, så kringgår du den satta sökvägen tillfälligt och
    mallen hämtas som vanligt relativt roten i ramverket.</p>
</div>
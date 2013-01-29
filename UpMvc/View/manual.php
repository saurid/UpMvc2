<?php
/**
 * HTML-dokumentationen för Up MVC
 *
 * @author Ola Waljefors
 * @package UpMvc2
 * @version 2013.1.1
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */
?>

<h2>Up MVC dokumentation</h2>





<h3 id="vadarmvc">Vad är Up MVC?</h3>

<ul id="menu">
    <li><a href="#mappofil">Mapp- och filstruktur</a></li>
    <li><a href="#controllers">Controllers och routing</a></li>
    <li><a href="#parametrar">Skicka parametrar till din action</a></li>
    <li><a href="#view">View-objekt och mallar</a></li>
    <li><a href="#model">Model-lagret</a></li>
    <li><a href="#controlmodel">Använda modeller i dina controllers</a></li>
    <li><a href="#dic">Dependency Injection/Service Container</a></li>
    <li><a href="#moduler">Moduler</a></li>
    <li><a href="#request">Request-objektet</a></li>
    <li><a href="#hur">Hur fungerar Up MVC?</a></li>
    <li><a href="<?php echo UpMvc\Container::get()->site_path ?>/UpMvc/WebForm">Exempelformulär</a> (under utveckling)</li>
</ul>

<p>Up MVC är ett objektorienterat PHP-baserat minimalistiskt
less-is-more-MVC för undervisningssyfte. Det är inte direkt avsett att
användas i produktionsmiljöer även om det är möjligt att göra så. Använd med omdöme,
men framförallt - Lär så mycket ni kan!</p>





<h3 id="mvcvad">MVC, vad då för nå&apos;t?</h3>

<p>MVC är en förkortning för Model View Controller och är ett sk.
designmönster. MVC används för att separera datalager (model) och
presentationsager (view) från varandra, så att förändringar i den
ena lagret inte får så stor inverkan på det andra. Data från model
kan ändras utan att presentationen (ofta HTML) behöver ändras.</p>

<p>Controllerlagret ligger mellan view och model och är det lager som
handskas med interaktionen från användaren. Controllern kan tex hämta
data från model och skicka vidare till view som presenterar den.</p>

<p>Läs gärna mer på <a href="http://sv.wikipedia.org/wiki/Model-View-Controller">Wikipedia</a>
eller sök på MVC din sökmotor för att få mer information</p>





<h3 id="mappofil">Mapp- och filstruktur <a href="#upp" class="upp">upp</a></h3>

<p>I en standardinstallation av Up MVC så ligger alla filer i mappen <code>Up-MVC/</code>.
Fil- och mappstrukturen ser ut ungefär som följande (för tydlighetens skull visas den lite
förkortad):</p>

<ul>
    <li class="folder">Up-MVC/
        <ul>
            <li class="folder">App/
                <ul>
                    <li class="folder">Controller/</li>
                    <li class="folder">Model/</li>
                    <li class="folder">View/</li>
                    <li class="file">config.php</li>
                </ul>
            </li>
            <li class="folder">UpMvc/
                <ul>
                    <li class="folder">diverse systemmappar/</li>
                    <li class="file">diverse systemfiler i php</li>
                </ul>
            </li>
            <li class="file">.htaccess</li>
            <li class="file">index.php</li>
            <li class="file">README.md</li>
        </ul>
    </li>
</ul>

<p><code>App/</code> är den mappen du lägger dina egna filer till din kommande webbplats.
Det är fritt fram att lägga till egna mappar till den befintliga strukturen, men behåll
de som redan ligger där (<code>Controller/, Model/</code> och <code>View/</code>).</p>

<p><code>UpMvc/</code> är mappen där alla systemfiler ligger och de ska du vanligtvis inte röra. Om du ändrar
i dessa filerna kommer du inte att kunna uppdatera till kommande versioner enkelt. De flesta av dessa
systemfilerna kommer vi att stöta på senare i manualen.</p>

<p><code>index.php</code> startar upp Up MVC. Det är den fil som alltid körs först och alla anrop till sidor
i ramverket går genom den. Det är filen <code>htaccess</code> som genom sk. rewrite rules ser till att det blir just
så.</p>

<p><code>App/Controller/</code> är inte helt oväntat den mappen där du sparar dina egna controller-filer som hör
till webbplatsen.</p>

<p><code>App/Model/</code> är mappen där du sparar dina model-filer till webbplatsen.</p>

<p> Och slutligen är <code>App/View/</code> den mapp där du sparar dina mallar och statiska delar av
webbplatsen. Ofta filer med html-uppmärkning, men kan också vara tex. formatmallar (css).</p>





<h3 id="controllers">Controllers och routing <a href="#upp" class="upp">upp</a></h3>

<p>En controller är egentligen en vanlig klass som du definerar upp själv. Men vad ska den
användas till? Controller-lagret är oftast det som är svårast att greppa med ett MVC-mönster
och därför också svårast att förklara. För att göra ett försök känner jag att jag måste blanda in
ytterligare ett begrepp - Routing.</p>

<p>Routing används för att beskriva det sätt som ett MVC öppnar och kör dina
controllers och routingen i Up MVC bestäms enbart med hjälp av adressen i din webbläsare.
Om vi förutsätter att du använder standardinstallationen av Up MVC i din lokala webbserver och läser
detta, så står det förmodligen följande adress i din webbläsare:</p>

<p><code>http//localhost/Up-MVC/</code></p>

<p>Skulle du lägga en route till adressen kan den se ut på detta viset:</p>

<p><code>http//localhost/Up-MVC/Post</code></p>

<p>Om du kör denna adressen i Up MVC kommer systemet att försöka öppna motsvarande controller-fil
(Post) och skapa en instans av klassen. Ramverket använder namespaces, som följer namnet på den mapp
som klasserna ligger i. Så du sparar filen med namn <code>Post.php</code> i mappen
<code>App/Controller/</code>. Klassnamnet blir <code>Post</code> och namespace blir
samma som mappen <code>App\Controller</code>

<p>Så den controller som körs vid URL&apos; ovan
ska se ut på detta viset:</p>

<pre>
&lt;?php
<span class="comment">// post-controller, fil: App/Controller/Post.php</span>
namespace App\Controller;
use UpMvc;

class Post
{
    <span class="comment">// Actions</span>
}
</pre>

<p>Om du sparar den controllern och öppnar URL&apos;n så kommer du att märka att
det fortfarande saknas något, eftersom ett felmeddelande kommer att visas. Det som
saknas är en action i din controller. En action är den metod som kommer att köras
baserat på URL&apos;en.<p>

<p>Default-action har namnet <code>index()</code>. Om du inte anger något efter post i routen,
så är det den metoden som kommer att köras. Exempel:</p>

<pre>
&lt;?php
<span class="comment">// post-controller, fil: App/Controller/Post.php</span>
namespace App\Controller;
use UpMvc;

class Post
{
    <span class="comment">// Default-action</span>
    public function index()
    {
        echo &apos;Utskrift från post-controllerns default-action&apos;;
    }
}
</pre>

<p>Om du återigen sparar och uppdaterar webbläsaren så borde felmeddelandet försvinna
och meddelandet i koden ovan kommer att skrivas ut.</p>

<p>Även controllers har ett default-värde, precis som den action som körs i controllern.
Default-kontrollern har samma namn som default-action - <code>index</code>. Controllern/action som körs
när denna dokumentationen visas, är således:</p>

<pre>
&lt;?php
<span class="comment">// Default-controller (index), fil: App/Controller/index.php</span>
namespace App\Controller;
use UpMvc;

class Index
{
    <span class="comment">// Default-action</span>
    public function index() {}
}
</pre>

<p>En controller innehåller vanligtvis flera än en action, så hur anropar du olika actions i
samma kontroller? Återigen riktar vi vår uppmärksamhet till routingen i webbläsarens URL. För
att anropa controllern post och action show så skriver du in följande URL:</p>

<p><code>http//localhost/Up-MVC/Post/show</code></p>

<p>Och controllern ska se ut på detta viset:</p>

<pre>
&lt;?php
<span class="comment">// post-controller, fil: App/Controller/Post.php</span>
namespace App\Controller;
use UpMvc;

class Post
{
    <span class="comment">// show-action</span>
    public function show() {}
}
</pre>

<p>Genom URL&apos;n kan du alltså välja vilken kod som ska köras och du organiserar den koden
i olika controllers och actions. Tänk på dem som olika kommandon som du använder för att 
uppnå olika resultat på din webbplats.</p>

<p>Genom att använda följade URL:</p>

<p><code>http//localhost/Up-MVC/Post/delete</code></p>

<p>Så kommer samma controller att köras, men med en annan action. Controllern kan då se ut
som följande:</p>

<pre>
&lt;?php
<span class="comment">// post-controller, fil: App/Controller/Post.php</span>
namespace App\Controller;
use UpMvc;

class Post
{
    <span class="comment">// show-action</span>
    public function show()
    {
        <span class="comment">// Kod för att visa något</span>
    }
    
    <span class="comment">// delete-action</span>
    public function delete()
    {
        <span class="comment">// Kod för att radera något</span>
    }
}
</pre>





<h3 id="parametrar">Skicka parametrar till din action <a href="#upp" class="upp">upp</a></h3>

<p>För att dina controllers/actions ska bli riktigt användbara och flexibla, så krävs det att
du har möjligheten att skicka med parametrar till dem. Du kan i teorin skicka med hur många
parametrar som helst genom att återigen helt enkelt använda routingen i URL&apos;n:</p>

<p><code>http//localhost/Up-MVC/Post/show/10</code></p>

<p>Här skickar vi alltså med värdet 10 med URL&apos;n. För att sedan fånga upp detta värdet
som argument till din action gör du som följande:</p>

<pre>
&lt;?php
namespace App\Controller;
use UpMvc;

class Post
{
    <span class="comment">// Ta emot parametern som argumentet $id</span>
    public function show($id)
    {
        <span class="comment">// Skriv ut argumentet, dvs 10:</span>
        echo $id;
    }
}
</pre>

<p>Parametrarna i din URL skickas alltså in i din action som ett argument. Här kommer ett annat exempel:</p>

<p><code>http//localhost/Up-MVC/Post/show/2011/10/01</code></p>

<p>I routen ovan så kan du alltså nå parametrarna i din action genom följande:</p>

<pre>
&lt;?php
namespace App\Controller;
use UpMvc;

class Post
{
    <span class="comment">// Ta emot parametrarna som argument</span>
    public function show($year, $month, $date)
    {
        <span class="comment">// Skriver ut det kompletta datumet (2011-10-01) från argumenten</span>
        echo &quot;$year-$month-$date&quot;; 
    }
}
</pre>

<p>Om du utelämnar en parameter i URL&apos;n så kommer du att sakna ett argument i metodanropet och
PHP kommer att generera ett fel, precis som vanligt. Så om du vill ha den möjligheten så behöver du
ange standard-värden till argumenten:</p>

<pre>
    <span class="comment">// Sätt defaultvärden för att kunna utelämna paramerar i URL&apos;n</span>
    public function show($year = '2012', $month = '01', $date = '14')
</pre>

<p>Inte så logiskt att använda defaultvärden med datum kanske, men man kan tänka sig att sätta dem
till false och ge mer kontrollerade felmeddelanden i controllern som visar att argumenten
inte får utelämnas. Detta för att undvika ett PHP fatal error.</p>

<div class="note">
    <p>Lägg märke till att du inte kan utelämna defaultcontroller, eller defaultaction
    i routen om du har behov av att använda parametrar. I såfall skulle Up MVC misstolka
    dina parametrar som en Controller/action. Men i praktiken brukar det inte vara svårt att
    undvika parametrar i defaultactions.</p>
</div>

<p>Nu har du förhoppningsvis lärt dig hur routingen fungerar och hur den används för att styra
vilken controller och action som körs, samt hur du skickar med parametrar.</p>

<p>Up MVC använder en sk. front controller tillsammans med en .htacess-fil och rewrite rules
för att uppnå denna funktionaliteten. Lek helst runt lite med olika URL&apos;er och se så att
Up MVC gör vad du förväntar att den ska göra, så att du är helt bekväm med hur det fungerar
innan du fortsätter.</p>





<h3 id="view">View-objekt och mallar <a href="#upp" class="upp">upp</a></h3>

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

class Visa
{
    public function omsidan()
    {
        <span class="comment">// Hämta ramverkets inbyggda objekt-container</span>
        $c = UpMvc\Container::get();
        
        <span class="comment">// Lagra strängar i variabler</span>
        $c-&gt;view-&gt;set(&apos;title&apos;,   &apos;Om webbplatsen&apos;);
        $c-&gt;view-&gt;set(&apos;header&apos;,  &apos;Om denna webbplatsen&apos;);
        $c-&gt;view-&gt;set(&apos;content&apos;, &apos;... Brödtext ...&apos;);
        
        <span class="comment">// Skapa upp och skriv ut sidan med vår layout</span>
        $html = $c-&gt;view-&gt;render(&apos;App/View/layout.php&apos;);
        echo $html;
    }
}
</pre>

<p>Du når view-objektet (<code>UpMvc\View</code>) genom att först starta upp Up MVC&apos; inbyggda
service container (eller dependency injection container) genom:</p>

<p><code>$c = UpMvc\Container::get();</code></p>

<p>Denna containern gör att du kan komma åt de flesta av ramverkets systemobjekt varsomhelst
i dina controllers. Du använder sedan view-objektet genom <code>$c-&gt;view</code>.</p>

<div class="note">
    <p>Service containern kan såklart lagra i vilken variabel som helst. Med många actions
    i din controller kan det vara en idé att lagra containern som en medlemsvariabel. Eller
    namnge den till något kort, tex bara $c.</p>
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

class Visa
{
    public function omsidan()
    {
        <span class="comment">// Hämta ramverkets inbyggda objekt-container</span>
        $c = UpMvc\Container::get();
        
        <span class="comment">// Lagra strängar i variabler</span>
        $c-&gt;view-&gt;set(&apos;title&apos;,  &apos;Om webbplatsen&apos;);
        $c-&gt;view-&gt;set(&apos;header&apos;, &apos;Om denna webbplatsen&apos;);
        
        <span class="comment">// Rendrera brödtexten från mallen omsidan och lagra i $content</span>
        $om = $c-&gt;view-&gt;render(&apos;App/View/omsidan.php&apos;);
        $c-&gt;view-&gt;set(&apos;content&apos;, $om);
        
        <span class="comment">// Skapa och skriv ut hela sidan</span>
        echo $c-&gt;view-&gt;render(&apos;App/View/layout.php&apos;);
    }
}
</pre>

<p>Med hjälp av <code>$om = $this-&gt;View-&gt;render(&apos;App/View/omsidan.php&apos;);</code> rendrerar och lagrar
vi så den nya mallen i en variabel och med <code>$this-&gt;View-&gt;set(&apos;content&apos;, $om);</code>
ser vi till att vi kan använda den i layouten.</p>

<p>Solklart, eller hur? På samma sätt kan vi lägga upp alla statiska sidor av en webbplats om vi
vill. Vi får en snygg URL och kan återanvända samma layout-mall på varje sida utan några problem.
De största fördelarna når vi dock när sidan blir lite mer komplicerad och börjar bli mer
dynamisk och interaktiv.</p>





<h4>Använda &quot;method chaining&quot; med view-objektet <a href="#upp" class="upp">upp</a></h4>

<p>På en hyffsat stor webbplats så kommer du att behöva sätta ganska många variabler
i view-objektet. Förutom de enklaste strängarna så kan det vara resultat och data
från databaser, andra objekt m.m.</p>

<p>Views <code>set()</code> tillåter därför method chaining så att du kan sätta flera variabler till
vy-objektet en efter en istället för att skriva ut variabeln <code>$c-&gt;view</code> varje gång.
Det gör att det blir lite lättare att snabbt läsa av koden med ögonen, men det är
bara en rent estetiskt funktion och tillför inte mycket annat i Up MVC.
Se exempel utan och med method chaining nedan:</p>

<pre>
<span class="comment">// Utan method chaining:</span>
$c-&gt;view-&gt;set(&apos;title&apos;, $item[0][&apos;name&apos;]);
$c-&gt;view-&gt;set(&apos;cart&apos;, $this-&gt;cart);
$c-&gt;view-&gt;set(&apos;categories&apos;, $categories);
$c-&gt;view-&gt;set(&apos;categorycount&apos;, count($categories));
$c-&gt;view-&gt;set(&apos;item&apos;, $item[0]);
$c-&gt;view-&gt;set(&apos;content&apos;, $c-&gt;view-&gt;render(&apos;App/View/item.php&apos;));
 
<span class="comment">// Med method chaining:</span>
$c-&gt;view
    -&gt;set(&apos;title&apos;, $item[0][&apos;name&apos;])
    -&gt;set(&apos;cart&apos;, $this-&gt;cart)
    -&gt;set(&apos;categories&apos;, $categories)
    -&gt;set(&apos;categorycount&apos;, count($categories))
    -&gt;set(&apos;item&apos;, $item[0])
    -&gt;set(&apos;content&apos;, $c-&gt;view-&gt;render(&apos;App/View/item.php&apos;));
</pre>

<p>Notera att du inte använder semikolon efter de första raderna, utan endast efter sista raden.</p>





<h3 id="model">Model-lagret <a href="#upp" class="upp">upp</a></h3>

<p>Modellerna utgör ditt data-lager, där du uppdaterar och hämtar data från exempelvis en databas,
sessionsvariabler, xml, textfiler. Du anropar din model från controllern och använder den som vilket
objekt som helst. Det viktiga i din model är gränssnittet, hur du använder den. Det som sker bakom
kulisserna i model ska vara dolt för controllern.</p>

<p>Dina modeller ska framförallt syssla med ren data. Hur du använder datan behöver inte modellen
veta, den ska bara leverera relevant data som controllern ber om, eller manipulera och uppdatera
data om controllern ber om det. Controllern i sin tur behöver inte veta hur datan lagras eller
uppdateras, den är bara intresserad av hur du ber om den, dvs. gränssnittet.</p>

<p>Se modellen som ett gränssnitt mot din
data, en byrå med olika lådor och fack för olika typer av data och modellen är den som öppnar,
sorterar, lägger nya saker och ger dig information om vad som finns där.</p>

<p>En controller är precis som dina controllers en vanlig klass som du definerar upp själv.
Klassnamnet i din model sätter du själv till ett passande namn, du sparar filen med samma namn
plus filändelse i mappen <code>App/Model/</code>. Namespace blir samma som mappen, dvs
<code>App\Model.</code>

<p>En model för att hantera poster i en databas, tex i en gästbok, kan se ut på detta viset:</p>

<pre>
&lt;?php
<span class="comment">// Fil: App/Model/Post.php</span>
namespace App\Model;
use UpMvc;

class Post
{
    <span class="comment">// Metod för att hämta alla inlägg</span>
    public function getAll() {}

    <span class="comment">// Metod för att hämta ett inlägg</span>
    public function get() {}

    <span class="comment">// Metod för att spara ett nytt inlägg</span>
    public function insert() {}

    <span class="comment">// Metod för att uppdatera ett inlägg</span>
    public function update() {}
}
</pre>

<p>I modellen definerar du upp de metoder du har nytta av för att hämta och spara
data i ex. en databas. Det är upp till dig att avgöra vad du behöver och inte behöver,
Up MVC drar inga slutsatser själv.</p>

<p>I vårt lilla exempel har jag definerat upp metoder<br />
för att hämta alla inlägg - <code>getAll()</code><br />
för att hämta ett enskilt inlägg - <code>get()</code><br />
för att spara ett nytt inlägg - <code>insert()</code> och <br />
för att uppdatera ett redan befintligt - <code>update()</code>.</p>

<p>Om vi skulle titta närmare på den första av dessa metoderna. <code>getAll()</code> är den enklaste
av de fyra och skulle kunna se ut så här:</p>

<pre>
    <span class="comment">// Metod för att hämta alla inlägg</span>
    public function getAll()
    {    
        <span class="comment">// Hämta service-containern</span>
        $c = UpMvc\Container::get();
        
        <span class="comment">// Förbered SQL-satsen</span>
        $c-&gt;database-&gt;prepare(&apos;
            SELECT id, date, message, author
            FROM guestbook
            ORDER BY date ASC
        &apos;);
        
        <span class="comment">// Utför SQL-frågan</span>
        $c-&gt;database-&gt;execute();
        
        <span class="comment">// Returnera resultatet av SQL-frågan</span>
        return $c-&gt;database-&gt;fetchAll();
    }
</pre>

<p>I dina modeller har du åtkomst till databasen via ett gränssnitt mot PDO genom
service containern och <code>$c-&gt;database</code> och metoderna <code>prepare(), execute(), fetchAll</code>
och <code>lastInsertId()</code>. Läs mer på php.net om PDO&apos;s funktioner med samma namn
för att förstå hur Up MVC&apos;s databas-funktioner fungerar.</p>

<p><code>$c-&gt;database-&gt;prepare()</code> tar ett argument, en sträng med din SQL-sats. Vid en enkel
select som denna är det inte svårare än sådär, men om du behöver använda variabler så
kommer du att utnyttja sk. placeholders. Vi kommer in på det i nästa metod.</p>

<p><code>$c-&gt;database-&gt;execute()</code> tar ett argument, en array med placeholders.
Eftersom vi inte använder placeholders i denna SQL-satsen, så utelämnar vi bara argumentet.
När <code>execute()</code> anropas så körs frågan mot databasen.</p>

<p><code>$c-&gt;database-&gt;fetchAll()</code> använder vi till sist för att returnera
resultatet av databasfrågan i form av en associativ array.</p>

<p>Ska vi ta och titta på en metod till? För att kunna returnera ett enskilt inlägg måste vi
ställa ett villkor i SQL-satsen. Alltså dags att introducera placeholders. Se nedan:</p>

<pre>
    <span class="comment">// Metod för att hämta ett inlägg med id som argument</span>
    public function get($id)
    {    
        <span class="comment">// Hämta service-containern</span>
        $c = UpMvc\Container::get();

        <span class="comment">// Förbered SQL-satsen med :id som placeholder</span>
        $c-&gt;database-&gt;prepare(&apos;
            SELECT id, date, message, author
            FROM guestbook
            WHERE id = :id
            ORDER BY date ASC
        &apos;);
        
        <span class="comment">// Utför SQL-frågan och sätt värdet på placeholdern</span>
        $c-&gt;database-&gt;execute(array(&apos;:id&apos; => $id));
        
        <span class="comment">// Returnera resultatet av SQL-frågan</span>
        return $c-&gt;database-&gt;fetchAll();
    }
</pre>

<p>Metoden <code>get()</code> tar ett argument, id&apos;t på inlägget i databasen.
I SQL-satsen skriver vi <code>:id</code> som placeholder där variabeln ska föras in. Och slutligen,
när <code>execute()</code> kallas, så för vi in variabeln <code>$id</code> i
placeholderns ställe.</p>

<p>För att spara saker i databasen använder man också placeholders, fast då med flera än en såklart.
Låt oss ta ett sista exempel med metoden <code>insert()</code>:</p>

<pre>
    <span class="comment">// Metod för att hämta ett inlägg med id som argument</span>
    public function insert($message, $author)
    {    
        <span class="comment">// Hämta service-containern</span>
        $c = UpMvc\Container::get();
        
        <span class="comment">// Förbered SQL-satsen</span>
        $c-&gt;database-&gt;prepare(&apos;
            INSERT
            INTO guestbook (message, author, date)
            VALUES (:message, :author, :date)
        &apos;);
        
        $date = date(&apos;Y-m-d&apos;); <span class="comment">// Hämta datum</span>
        
        <span class="comment">// Utför SQL-frågan</span>
        $c-&gt;database-&gt;execute(array(
            &apos;:date&apos;    =&gt; $date,
            &apos;:message&apos; =&gt; $message,
            &apos;:author&apos;  =&gt; $author
        ));
        
        <span class="comment">// Returnera resultatet av SQL-frågan</span>
        return $c-&gt;database-&gt;fetchAll();
    }
</pre>





<h4 id="chaining">Använda &quot;method chaining&quot; med model-objekt <a href="#upp" class="upp">upp</a></h4>

<p>Precis som view-objektet så tillåter model-objekt method chaining, vilket gör att du kan
få koden ett litet snäpp mer läsbar om du vill. Skillnaden med och utan ser du i exemplet nedan:</p>

<pre>
<span class="comment">// Utan method chaining</span>
$c = UpMvc\Container::get();
$c-&gt;database-&gt;prepare(&apos;SELECT * FROM post&apos;);
$c-&gt;database-&gt;execute();
return $c-&gt;database-&gt;fetchAll();
    
<span class="comment">// Med method chaining</span>
return UpMvc\Container::get()
    -&gt;database
    -&gt;prepare(&apos;SELECT * FROM post&apos;)
    -&gt;execute()
    -&gt;fetchAll();
</pre>





<h3 id="controlmodel">Använda modeller i dina controllers <a href="#upp" class="upp">upp</a></h3>

<p>Så nu när du skapat dina modeller, hur ska du använda dem i dina controllers? Det hela
är mycket enkelt.</p>

<pre>
&lt;?php
<span class="comment">// Fil: App/Controller/Guestbook.php</span>
namespace App\Controller;
use UpMvc;

class Guestbook
{
    <span class="comment">// Show-action med id som argument</span>
    public function show($param)
    {
        <span class="comment">// Hämta service-containern</span>
        $c = UpMvc\Container::get();

        <span class="comment">// Skapa en instans av din model</span>
        $postmodel = new App\Model\Post();

        <span class="comment">// Hämta posten med ett givet id</span>
        $post = $postmodel-&gt;get($params[0]);

        <span class="comment">// Lagra post-array som variabel i view</span>
        $c-&gt;view-&gt;set(&apos;post&apos;, $post);
        
        <span class="comment">// ... Sätt ytterligare variabler och rendrera layout ...</span>
    }
}
</pre>

<p>För att visa denna posten så skulle du använda följade route i 
din URL: <code>/Post/show/10</code>, där <code>10</code> såklart är id på den posten
du vill visa.</p>





<h3>Exempelmodel - &quot;Lipsum&quot; <a href="#upp" class="upp">upp</a></h3>

<p>Stycket efter detta (en lorem ipsum-text), kommer direkt från datalagret:</p>

<p><?php echo $lipsum ?></p>

<p>För att hämta data (i detta fallet en sträng) i en controller, från modellen och lagra i view,
så skriver du:</p>

<pre>
<span class="comment">// Skapa objekt, hämta data och lagra till view</span>
$lipsum = new UpMvc\Model\Lipsum();
$c-&gt;view-&gt;set(&apos;lipsum&apos;, $lipsum-&gt;get());
</pre>

<p>Och för att sedan skriva ut i mallen använder du så:</p>

<pre>
&lt;?php echo $lipsum ?&gt;
</pre>

<p>Modellen ser ut på detta viset:</p>

<pre>
&lt;?php
<span class="comment">// Fil: UpMvc/Model/Lipsum.php</span>
namespace UpMvc\Model;

class Lipsum
{
    public function get()
    {
        $output = "
            Lorem ipsum dolor sit amet, consectetur adipisicing elit,
            sed do eiusmod tempor incididunt ut labore et dolore magna
            aliqua. Ut enim ad minim veniam, quis nostrud exercitation
            ullamco laboris nisi ut aliquip ex ea commodo consequat.
            Duis aute irure dolor in reprehenderit in voluptate velit
            esse cillum dolore eu fugiat nulla pariatur. Excepteur sint
            occaecat cupidatat non proident, sunt in culpa qui officia
            deserunt mollit anim id est laborum.
        ";
        return $output;
    }
}
</pre>

<p>Observera att denna exempelmodellen (och denna manual) ligger i mappen <code>UpMvc/Model</code> och inte
<code>App/Model</code> som är brukligt för användare. Den får därför också en namespace som återspeglar
det faktum. Detta är ju bara ett exempel för användning i manualen. Du skulle sparat din model som
i <code>App/Model/Lipsum.php</code> och använt namespace <code>App\Model</code>.
</p>

<p>Solklart! Inte sant? :)</p>

<div class="note">
    <p>Tänk på att det kan vara en potentiell säkerhetsrisk att skriva ut data direkt från modellen
    i din mall. Där kan ju finnas kod (JavaScript, HTML, m.m.) i strängen som skrivs ut fast du inte
    alls menar det. Risken är uppenbar ifall det inte är du själv som lagrar den (tex. en gästbok). Det
    är ditt ansvar att se till att strängen är säker för utskrift. Up MVC kan inte hjälpa till,
    för den vet inte om du har för avsikt att skriva ut ex. HTML-kod eller inte.</p>
</div>





<h3 id="dic">Dependency Injection/Service Container <a href="#upp" class="upp">upp</a></h3>

<p>Du har redan sett flera exempel på hur containern används i Up MVC och den är en viktig
del av ramverket. En Dependency Injection Container gör att alla klasser och objekt kan
optimeras efter best practice, samtidigt som skapandet (instansieringen) av dem kan
göras enkel. Du skapar och hämtar dem genom ett enkelt metodanrop, men du behöver inte veta
hur de skapas (beroenden av andra objekt eller variabler t.ex.), det håller containern reda på.</p>

<p>Objekten skapas bara upp när de först anropas, så inga objekt laddas/skapas upp i onödan
(s.k. lazy loading). Containern lagrar dessutom instanser av varje objekt, vilket gör att endast
ett objekt av varje typ finns aktivt i systemet samtidigt. Varje gång du använder ett objekt som
är lagrad i containern så är det exakt samma oavsett varifrån du anropar den.</p>

<p>Det finns ett gäng fördefinierade metoder som används för att nå ramverkets kärna. De är:</p>

<pre>
<span class="comment">// Hämta en instans av containern</span>
$c = UpMvc\Container::get();

<span class="comment">// Lagra eller skriv över egna variabler</span>
<span class="comment">// (Använder den magiska metoden __set())</span>
$c-&gt;nyckel  = &apos;värde&apos;;
$c-&gt;nyckel2 = &apos;ett annat värde&apos;;

<span class="comment">// Använd egna variabler</span>
<span class="comment">// (Använder den magiska metoden __get())</span>
echo($c-&gt;nyckel);    <span class="comment">// Skriver ut &quot;värde&quot;</span>
echo($c-&gt;nyckel2);   <span class="comment">// Skriver ut &quot;ett annat värde&quot;</span>

<span class="comment">// Fördefinerade variabler</span>
$c-&gt;site_path;       <span class="comment">// Sökväg till ramverket</span>
$c-&gt;route;           <span class="comment">// UpMvc\Route object</span>
$c-&gt;database;        <span class="comment">// UpMvc\Database object</span>
$c-&gt;form;            <span class="comment">// UpMvc\Form object</span>
$c-&gt;frontcontroller; <span class="comment">// UpMvc\FrontController object</span>
$c-&gt;pdo;             <span class="comment">// PDO object</span>
$c-&gt;request;         <span class="comment">// UpMvc\Request object</span>
$c-&gt;router;          <span class="comment">// UpMvc\Router object</span>
$c-&gt;view;            <span class="comment">// UpMvc\View object</span>
</pre>

<p>Du kan lagra allt från enkla siffror eller strängar, till stora arrays eller
komplicerade objekt. Nyckeln måste vara ett giltigt variabelnamn, om inte så kommer Up MVC
att generera ett felmeddelande.</p>

<p>Nästan alla dessa variabler använder du för att hämta objekt från ramverkets kärna.
Av dem är <code>pdo</code> lite annorlunda, eftersom den innehåller en instans av ett
standardobjekt i PHP och <code>site_path</code> som är en vanlig enkel sträng.
Det är sällan du behöver använda pdo-objektet dock, oftast kommer du att använda
den genom database-objektet som använder pdo internt.</p>

<p>Du har kanske lagt märke till i tidigare exempel att du inte behövt använda paranteserna
när du använder metoderna (som om du istället hämtar en publik objektegenskap)?
Det beror på att containern implementerat en lösning med den magiska
php-metoden <code>__get()</code>.</p>





<h3 id="moduler">Moduler <a href="#upp" class="upp">upp</a></h3>

<p>Det är möjligt att använda Up MVC som ett modulbaserat ramverk om man så önskar. Det kräver
inte så väldigt mycket för att det ska fungera, men det finns en del saker att tänka på.</p>

<p>För att lägga till en modul skapar du en mapp med önskat namn i roten, bredvid de
befintliga mapparna <code>UpMvc/</code> och <code>App/</code>. App är faktiskt en modul även den,
men eftersom den är standardmodulen så har den ett litet annat beteende, tex behöver du aldrig ange den i
URL&apos;ens route. Den nya mappen/modulen ska precis som app innehålla mapparna <code>Controller/,
Model/</code> och <code>View/</code> (om du har behov av dem).</p>

<p>För att skapa modulen <code>Guestbook</code> ska det mao. se ut så här:</p>

<ul>
    <li class="folder">App/</li>
    <li class="folder">Guestbook/
        <ul>
            <li class="folder">Controller/</li>
            <li class="folder">Model/</li>
            <li class="folder">View/</li>
        </ul>
    </li>
    <li class="folder">UpMvc/</li>
</ul>

<p>Med controller och modeller gör du precis som du brukar, lägg dem i respektive
mapp och sätt namespace efter mappstrukturen.</p>

<p>En post-controller får i modulen klassnamnet <code>Post</code> och
namespace <code>Guestbook\Controller</code>. Modeller namnges likadant, tex.
<code>DinModell</code> respektive namespace <code>Guestbook\Model</code>.</p>

<p>Såklart sparar du dina mallar/vyer i modulens view-mapp och hämtar in dem enligt ordinarie
sökvägar, tex <code>$c-&gt;view-&gt;render(&apos;Guestbook/View/Post.php&apos;);</code>.</p>

<p>För att använda en modul i URL&apos;en, lägger du till modulens namn först i routen.
Denna dokumentationen ligger i en modul som också tjänstgör som Up MVC&apos;s systemmapp,
så genom att skriva <code>UpMvc/</code> först så hämtas standardcontroller och action i
modulen <code>UpMvc</code>. Sökvägen till manualen är i en standardinstallation således:</p>

<p><code>http://localhost/Up-MVC/UpMvc/Manual</code></p>

<p>Eller utskrivet i sin helhet:</p>

<p><code>http://localhost/Up-MVC/UpMvc/Manual/index</code></p>

<p>Alltså modul: <code>UpMvc/</code>, controller: <code>UpMvc\Controller\Manual</code> och action: <code>index()</code></p>

<div class="note">
    <p>Up MVC ser om första delen i routen är en modul genom att kontrollera om
    namnet är en mapp eller ej. Om det är en mapp, antas det vara en modul, annars antas
    det vara en controller (i app). Detta medför att du inte kan namnge en controller i app
    med samma namn som en modul, om du vill kunna köra controllern.</p>
</div>

<p>När du hämtar modeller skriver du alltid hela modellens klassnamn:</p>

<pre>
$c = UpMvc\Container::get();

<span class="comment">// Använd en model från modulen Guestbook</span>
$postmodel = new Guestbook\Model\Post();
$post = $postmodel-&gt;getPost();

<span class="comment">// Använd en model från App</span>
$postmodel = new App\Model\Post();
$post = $postmodel-&gt;getPost();
</pre>

<p>När du hämtar och redrerar mallar (vyer) använder du även där sökvägen till modulen:</p>

<pre>
$c = UpMvc\Container::get();

<span class="comment">// Rendrera en mall från modulen Guestbook</span>
$post = $c-&gt;view-&gt;render(&apos;Guestbook/View/Post.php&apos;);

<span class="comment">// Rendrera en mall från App</span>
$post = $c-&gt;view-&gt;render(&apos;App/View/Post.php&apos;);
</pre>





<h3 id="request">Request-objektet <a href="#upp" class="upp">upp</a></h3>

<p><code>UpMvc\Request</code> är en klass som är en enkel wrapper runt PHP&apos;s globala variabel
$_REQUEST. <code>UpMvc\Request</code> kan vara bra att använda istället för $_REQUEST då
den alltid returnerar något. Om variabeln inte finns i $_REQUEST så genererar PHP ett felmeddelande,
men <code>UpMvc\Request</code> returnerar en tom sträng.</p>

<p>Så varför är detta bra? Jo, det kan vara ett bra sätt att tex. återpopulera formulärfält
med POST-, eller GET-data. Om formuläret ännu inte är postat, så behöver man inte ställa
några villkor för att kontrollera om variablerna finns för att använda dem.</p>

<p>Du når objektet som vanligt genom service containern. Objektet har en enda metod,
<code>get()</code>, som du använder för att returnera dina REQUEST-variabler:</p>

<pre>
$c = UpMvc\Container::get();

<span class="comment">// Skriver ut värdet i $_REQUEST[&apos;variabel&apos;]
// Om variabeln inte är satt returneras en tom sträng</span>
echo $c-&gt;request-&gt;get(&apos;variabel&apos;);
</pre>

<p>Om du inte nöjer dig med en tom sträng om nyckeln inte finns, utan
har behov av att något annat returneras, så kan du utnyttja get-metodens andra argument:</p>

<pre>
<span class="comment">// Om variabeln inte är satt returneras strängen i andra argumentet: &quot;Defaultsträng&quot;</span>
echo $c-&gt;request-&gt;get(&apos;variabel&apos;, &apos;Defaultsträng&apos;);
</pre>



<h3 id="hur">Hur fungerar Up MVC? <a href="#upp" class="upp">upp</a></h3>

<p>För att djupare förstå hur kärnan av Up MVC fungerar kan det nog vara lämpligt att använda sig
av lite bilder. Ta en titt nedan, förklaring följer efteråt.</p>





<h4>Ramverket som ett UML-diagram<a href="#upp" class="upp">upp</a></h4>

<img src="<?php echo UpMvc\Container::get()->site_path ?>/UpMvc/View/img/UpMvc_uml.png" class="center" width="534" height="541" alt="UML-diagram över Up MVC&apos;s kärna" />

<p>Här ser vi att det är service containern (UpMvc\Container) som är ramverkets hjärta. Containern
kan skapa upp och lagra instanser av alla de viktigaste objekten som du och systemet behöver.</p>

<p>Frontcontrollern (UpMvc\FrontController) till höger håller en referens till ett router-objekt (UpMvc\Router)
som tolkar URL&apos;en. När routern har gjort sitt startar frontcontrollern rätt controller (i detta exemplet
visat som App_Controller_...).</p>

<p>Controllern har nu möjlighet att via containern hämta in ett view-objekt (UpMvc\View) och fylla det
objektet med data som behövs för den aktuella sidan. Bland annat används säkert en eller flera
modeller (visat som App_Controller_...) för att hämta data fråm modell-lagret. Det kan vara databaser,
filer eller sessionsvariabler m.m. I fallet med databaserna så används ett databas-objekt (UpMvc\Database)
som håller en referens av ett PDO-objekt som sköter kommunikationen med servern.</p>

<p>Alla dessa relationer mellan objekten i Up MVC håller service containern reda på, utan att man behöver lägga någon
energi på det.</p>

<p>Genom view-objektet tolkas (rendreras) slutligen dina mallar/templates i viewmappen, ersätter de
satta variablerna och skapar det slutliga dokumentet.</p>





<h4>Ramverkets manual visad i en tidlinje<a href="#upp" class="upp">upp</a></h4>

<p>För att förstå vad som händer när kan vi titta på vad som egentligen sker bakom kulisserna
när till exempel denna manualen visas. Uppifrån och ner visas de filer/objekt som används i samma ordning som 
de laddas/skapas. Från vänster till höger visas livslängden för objekten. När den gula stapeln
visas så skapas objektet upp och när den avslutas så har objektet spelat ut sin roll (fast den ligger kvar
i service containern tills sidan är klar).</p>

<img src="<?php echo UpMvc\Container::get()->site_path ?>/UpMvc/View/img/upmvc_lifeline.png" class="center" width="515" height="253" alt="En sidas livslinje" />
<ol>
    <li>Här registrerar index-sidan autoloadern som ser till att alla klasser laddas in av systemet automatiskt.</li>
    <li>Sedan hämtar index upp en instans av service containern</li>
    <li>Till sist anropar index frontcontrollern via containern, som samtigt skapar upp routern som frontcontrollern är beroende av</li>
    <li>Nu har indexsidan lämnat över körningen helt till router/frontcontroller som läser in rätt controller baserat på din URL. En referens till samtliga objekt finns hela tiden i service containern</li>
    <li>Controllern hämtar in det viktiga viewobjektet</li>
    <li>Och så hämtas även modellen model_Lipsum in (som innehåller lite exempeldata som visats här i dokumentationen)</li>
    <li>Controllern hämtar data från modellen och lagrar den i view-objektet</li>
    <li>Controllern säger till view att rendrera själva innehållet på sidan, denna manualen</li>
    <li>Och så rendrerar controllern layouten och därmed är den kompletta sidan klar</li>
    <li>Och till sist så skrivs det kompletta dokumentet ut och visas i webbläsaren</li>
</ol>

<p>Det är inget som kan förklara ett system som lite bilder. Det stämmer verkligen som man säger 
att en bild kan säga mer än tusen ord.</p>

<h3>Du har du nått dokumentationens slut!<a href="#upp" class="upp">upp</a></h3>

<p>Tänka sig...</p>

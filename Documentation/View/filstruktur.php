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

<h3>Mapp- och filstruktur</h3>

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
            <li class="folder">Documentation/
                <ul>
                    <li class="folder">Controller/</li>
                    <li class="folder">Model/</li>
                    <li class="folder">View/</li>
                </ul>
            </li>
            <li class="folder">vendor/
                <ul>
                    <li class="folder">UpMvc/</li>
                </ul>
            </li>
            <li class="file">.gitattributes</li>
            <li class="file">.gitignore</li>
            <li class="file">.htaccess</li>
            <li class="file">index.php</li>
            <li class="file">README.md</li>
        </ul>
    </li>
</ul>

<p><code>App/</code> är den mappen du lägger dina egna filer till din kommande webbplats.
Det är fritt fram att lägga till egna mappar till den befintliga strukturen, men behåll
de som redan ligger där (<code>Controller/, Model/</code> och <code>View/</code>).
Det är med andra ord här du kommer att lägga ner mest tid på att skapa filer till
ditt blivande superprojekt!</p>

<p><code>App/Controller/</code> är inte helt oväntat den mappen där du sparar dina egna controller-filer som hör
till webbplatsen. Vid en nyinstallation ligger där en enda standardkontroller som skickar dig vidare till denna manualen.</p>

<p><code>App/Model/</code> är mappen där du sparar dina model-filer till webbplatsen.</p>

<p> Och <code>App/View/</code> den mapp där du sparar dina mallar och statiska delar av
webbplatsen. Ofta filer med html-uppmärkning, men kan också vara tex. formatmallar (css).</p>

<p>I <code>Documentation/</code> ligger denna manualen och är uppbyggd likadant som ett vanligt
projekt skulle vara uppbyggt. Dvs. med den vanliga strukturen med modeller, vyer och kontroller.
Titta gärna igenom för att få lite snabba uppslag på hur ramverket fungerar.</p>

<p><code>vendor/UpMvc/</code> är mappen där ramverkets alla systemfiler ligger och de ska du vanligtvis inte röra. Om du ändrar
i dessa filerna kommer du inte att kunna uppdatera till kommande versioner enkelt. De flesta av dessa
systemfilerna kommer vi att stöta på senare i manualen.</p>

<p><code>index.php</code> startar upp Up MVC. Det är den fil som alltid körs först och alla anrop till sidor
i ramverket går genom den. Det är filen <code>htaccess</code> som genom sk. rewrite rules ser till att det blir just
så.</p>

<p><code>.gitattributes</code> och <code>.gitignore</code> är kopplat till GitHub och pakethanteringen och
vanligtvis inget du behöver fundera över</p>
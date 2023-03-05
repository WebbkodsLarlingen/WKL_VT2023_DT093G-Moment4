<h2 id="specialh2">Moment 2 - Frågor</h2>
<ul id="special1">
<li class="questions">
<strong>Har du tidigare erfarenhet av utveckling med PHP?</strong>
<br><p>Nej, inte i denna utsträckning. Jag har för länge sedan kikat på det men förvirrats av dess sätt att användas på som exempelvis att skriva den direkt inuti HTML-kod. För säkert 10 år sedan öppnade jag upp diverse Wordpress-php-filer och förstod så klart ingenting.<br><br>Det blir roligt att öppna om samma Wordpress-filer efter CMS-kursen som då fokuserar på just Wordpress om jag minns rätt</p>
</li>
<li class="questions">
<strong>Beskriv kortfattat vad du upplever är fördelarna med att använda PHP för att skapa webbplatser.</strong>
<br><p>Två starka fördelar:<br><br>1) Den första är att kunna skapa mer dynamiska webbplatser snabbare tack vare det modulära tänket vilket jag älskar. Jag hoppas vi aldrig går tillbaka till "vanilla HTML" på det viset utan får hålla på med både modulär php, javascript, och så vidare. C# är ju objektorienterat och OOP anammar ju delvis det där modulära tänket som jag rent av älskar!<br><br>2) Den andra stora fördelen är att kunna skapa säkra webbplatser tack vare att php-koden döljs undan. Jag upptäckte även att kommentarer inuti php döljs men om man skriver HTML-kommentarer precis utanför php-koden så syns de slags kommentarerna.</p>
</li>

<li class="questions">
<strong>Hur har du valt att strukturera upp dina filer och kataloger?</strong>
<br><p>Jag har <i>index.php</i> i "webbserverns" rotkatalog. I mappen <i>include</i> så finns filer med prefix i filnamnen för att lättare veta vad som syftar på vad: "c" = component/komponent till en viss sida, "f" = funktion till en viss sida.<br><br>Notera således att funktionerna i <i>config.php</i> är medvetet globala då den filen ändå inkluderas på alla sidor. En första tanke var dock katalogerna <i>page</i> för sidorna (det vill säga, "p" = page/sida) och <i>function</i> för funktionerna.<br><br>Men det skippade jag då jag har haft problem med att länka rätt mellan filer som ligger i olika nivåer i olika kataloger än så länge.</p>
</li>

<li class="questions">
<strong>Har du följt guiden, eller skapat på egen hand?</strong>
<br><p>Jag har delvis följt guiden för den grundläggande strukturen sedd i <i>index.php</i>. Då var det bara att kopiera och klistra in för alla undersidor och inkludera nödvändig php-kod där för att lösa respektive uppgift.</p>
</li>

<li class="questions">
<strong>Har du gjort några förbättringar eller vidareutvecklingar av guiden (om du följt denna)?</strong>
<br><p>Vad som kan tolkas som förbättringar jag har gjort är i form av funktioner som kan anropas. 
    <br><br>Exempelvis så sätts ett värde för vilken sida man är på vilket sedan anropas i
     <i>c-header.php</i> för att markera vilken nuvarande sida är. Detta syns <i>$currentBtn</i>-variabeln i början av undersidorna.
     <br><br>Annan funktion är den som anropas inuti varje <i>title</i>-element för att skriva ut undersidans namn efter webbplatsens namn.
     <br><br>En ytterligare funktion är den som anropas i slutet på varje uppgift: <i>nextPage</i> som returnar länknamn (ej filändelse) och strängen inom parentesen. Medför snabbare navigering. 
     <br><br>Funktionerna finns i <i>config.php</i> då de används på varje webbsida, exklusive <i>nextPage</i> på denna sida.</p>
</li>

<li class="questions">
<strong>Vilken utvecklingsmiljö har du använt för att genomföra uppgiften (editor, webbserver-paket (Xampp, Lamp, Wamp eller liknande)?</strong>
<br><p>Jag har använt mig av VSCode som huvudsaklig utvecklingsmiljö. Jag har använt mig av XAMPP som webbserver för PHP.<br><br>Installerade även <i>Apache</i> direkt som Service i Windows 10 för att slippa behöva starta XAMPP manuellt varje gång jag startar datorn.</p>
</li>

<li class="questions">
<strong>Har något varit svårt med denna uppgift?</strong>
<br><p>Ja, CSS som vanligt. En sak jag inte förstod var varför jag fick felmeddelande när jag valde att inkludera typsnitt lokalt, alltså med <i>@font-face</i>.<br><br>Då stod det i <i>Console</i> att <i>"download failed font"</i> (trots att jag såg att sökvägen till filen var rätt med kataloger och filnamn).<br><br>Så jag fick använda direktlänk till Google Fonts för det futuristiska typsnittet på denna webbplats. Jag vet inte om jag hade valt fel slags varianter av typsnitten (det var .tff) eller om det är något php och typsnitt jag inte begriper mig ännu på.</p>
</li>

</ul>
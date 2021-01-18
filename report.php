<?php
    // Header
    include 'include/header.php';
?>

<!-- Page 1 --> 
<div class="paper">
    <button onclick="window.location.href='index.php'" class="home">Hem</button>
    <div class="cover">
        <h1 class="logo">Leegle</h1>
        <div class="ellips">
            <h4>Grupp 13 | Uppgift 1</h4>
            <p>🔍</p>
        </div>
        <div class="authors">
            <div class="name">
                <p>Filip Malm-Bägén</p>
                <p>Erik Dahlström</p>
                <p>Albin Kjellberg</p>
            </div>
            <div class="liuId">
                <p>filma379</p>
                <p>erida600</p>
                <p>albkj604</p>
            </div>
        </div>
    </div>
</div>

<!-- Page 2 --> 
<div class="paper">
    <p class="pageNum">2</p>
    <h1>Innehållsförteckning</h1>

    <!-- Table of contents --> 
    <a href="#section1">
        <div class="section">
            <h4>1. Projektmetod och arbetsfördelning</h4>
            <h4>3</h4>
        </div>
    </a>

    <a href="#section2">
        <div class="section">
            <h4>2. Layout</h4>
            <h4>4</h4>
        </div>
    </a>

    <a href="#section3">
        <div class="section">
            <h4>3. Tillgänglighet</h4>
            <h4>5</h4>
        </div>
    </a>

    <a href="#section4">
        <div class="section">
            <h4>4. Upphovsrätt</h4>
            <h4>6</h4>
        </div>
    </a>

    <a href="#section5">
        <div class="section">
            <h4>5. Självvärdering</h4>
            <h4>7</h4>
        </div>
    </a>

    <a href="#section6">
        <div class="section">
            <h4>6. Tidsåtgång</h4>
            <h4>8</h4>
        </div>
    </a>
</div>

<!-- Page 3 --> 
<div class="paper" id="section1">
    <p class="pageNum">3</p>
    <h1>1. Projektmetod och arbetsfördelning</h1>
    <p class="text">
        Tidigt delades projektet upp i olika områden och i olika prioriteringar för att underlätta arbetsprocessen då vi enkelt skulle veta vad som behöver göras och i vilken ordning. I början var vi noggranna med kontinuerliga möten för att förtydliga oklarheter och få en uppfattning om hur vi ligger till. Mötena användes även för att fördela arbetsuppgifterna vilket ledde till en mer effektiviserad arbetsprocess då vi parallellt behandlade olika områden. Under julledigheten hänvisades gruppen istället till fritt initiativtagande och enstaka meningar byttes i gruppchatten. För att undvika att ingen släpade efter var vi noga med att informera gruppen om vad vi gjort, hur vi gjort och vara öppen för frågor när en deluppgift blivit klar. 
        <br/>
        <br/>
        Arbetsfördelningen hade vi som mål att fördela så rättvist som möjligt utifrån tidigare erfarenheter. Albin hade tidigare läst webbutveckling. Detta ledde naturligt till att Albin fick ansvara för de experimentella delarna medan Filip och Erik arbetade mer med de områden som täcks under kursen och mer med det.
    </p>
</div>

<!-- Page 4 --> 
<div class="paper" id="section2">
    <p class="pageNum">4</p>
    <h1>2. Layout</h1>
    <h3>Wireframe</h3>
    <p class="text">
        Vår wireframe blev mer en simplifierad layout för hemsidan och visade inte särskilt väl hur man skulle interagera med de olika knapparna och elementen. Detta gjorde det dock lättare för oss att designa mockupen, då den huvudsakliga placeringen och storleken av objekten redan var avklarat.
    </p>
    <br/>
    <div class="imgSeq">
        <img src="assets/img/report_img/report_img_1.png" alt="Report img 1">
        <img src="assets/img/report_img/report_img_2.png" alt="Report img 2">
        <img src="assets/img/report_img/report_img_3.png" alt="Report img 3">
        <img src="assets/img/report_img/report_img_4.png" alt="Report img 4">
    </div>
    <h3>Mockup och mobilanpassning</h3>
    <p class="text">
        Det enkla och användarvänliga vi sökte speglas mycket i vår mockup Vi tyckte att det var viktigt att inte lägga till onödiga funktioner och sidor som inte hade något riktigt syfte, förutom att fylla ut hemsidans meny. Därför valde vi att endast ha 3 sidor: sök, resultat och set-sidan. Detta, tillsammans med den stilrena designen, ger ett elegant och modernt intryck som passar in perfekt bland trendiga hemsidor. 
    </p>
    <p class="text">
        <br/>
        Mobilanpassningen är alltid en utmaning. Tack vare enkelheten i vår layout samt avsaknaden av meny gick det dock relativt smärtfritt att komma på en passande design. För det mesta var det bara att minska bredden på elementen eller få dem att ligga vertikalt istället för horisontellt. 
        <br/>
    </p>
    <br/>
    <div class="imgSeq">
        <img src="assets/img/report_img/report_img_5.png" alt="Report img 5">
        <img src="assets/img/report_img/report_img_6.png" alt="Report img 6">
        <img src="assets/img/report_img/report_img_7.png" alt="Report img 7">
        <img src="assets/img/report_img/report_img_8.png" alt="Report img 8">
    </div>
</div>

<!-- Page 5 --> 
<div class="paper" id="section3">
    <p class="pageNum">5</p>
    <h1>3. Tillgänglighet</h1>
    <p class="text">
        Gruppens målsättning med hemsidan är att den ska förmedla en känsla av struktur, stilrenhet och tydlighet. Webbsidan strävar efter god tillgänglighet så att alla människor kan delta och uppleva webbsidan på samma sätt, oberoende av individens olika förutsättningar.
        <br/>
        <br/>
        Webbsidans stilrenhet och tydlighet baseras på inspiration från Googles egna webbsida. När besökaren söker runt på webbsidan är avsikten att uppleva en igenkänningsfaktor till något bekvämt sen tidigare. Detta gör det möjligt för samlaren att hitta sitt Lego-set på enklaste sättet. För att göra hemsidan så tillgänglig som möjligt för alla människor har vi använt oss av färger som är lättast för ögat att acceptera. Samtidigt ska färgerna framhäva de känslor som vi satte upp som målsättning i början av stycket. 
        <br/>
        <br/>
        En behövlig lösning som gjorts för att underlätta sökprocessen av olika Lego-set för användaren är sökfiltret. Filtret gör det möjligt för denne att kunna fylla i olika kategorier för att hitta det set användaren söker ifall man inte känner till dess ID-nummer eller namn. Filtret gör att man kan välja bland kategorier och utgivningsår. 
    </p>
</div>

<!-- Page 6 --> 
<div class="paper" id="section4">
    <p class="pageNum">6</p>
    <h1>4. Upphovsrätt</h1>
    <p class="text">
        Vår avsättning var tidigt att undvika användandet av sådant som vi inte får använda av upphovsrättsliga skäl. Bilden som dyker upp då det inte finns några resultat togs från en hemsida vars bilder var fria för användning. Loggan och faviconen har vi designat själva och alla ikonerna får tillsammans med fonten också användas fritt på vår hemsida. Av den anledningen fungerar vår hemsida bra av upphovsrättsliga skäl. 
        <br/>
        <br/>
        Däremot har vi inspirerats mycket av Google när vi tog fram designen för vår hemsida, liksom namnen på hemsidan. Detta skulle aldrig i praktiken skada oss. Vi gör enbart ett skolprojekt vars avsikt inte är att exponeras. Hemsidan kommer aldrig att skada Google och dess varumärke. Teoretiskt sätt är Googles varumärke och design är skyddat upphovsrättsligt. Det är inte tillåtet att rakt av kopiera någon annan hemsidas designspråk utan tillåtelse. Av den anledningen är det viktigt att tänka på det inför framtida projekt.
    </p>
</div>

<!-- Page 7 --> 
<div class="paper" id="section5">
    <p class="pageNum">7</p>
    <h1>5. Självvärdering</h1>
    <p class="text">
    Större delen av projektet så har vi kodat tillsammans inom gruppen. Vilket har varit givande för de medlemmar med mindre kunskap inom området och resulterat i att många problem i kodningen har lösts snabbt. Under julledigheten såg förhållandena lite annorlunda ut och vi jobbade mer enskilt. Positiva saker under den här perioden var att alla tog tag i de arbetsuppgifter som tilldelas innan julledigheten och tog egna initiativ till kvarvarande arbetspunkter för webbsidan. 
    <br/>
    <br/>
    Vi valde att sätta igång med den skriftliga rapporten under projektets gång vilket har lett till att vi har kunnat skriva ner arbetsprocessen under tidens gång. Något som resulterade i att vi aldrig behövde känna någon stress för rapporten mot projektets slut då den i princip var färdig när webbsidan blev klar. 
    <br/>
    <br/>
    Något som däremot gick mindre bra var problemet som uppstod med visual studio code på skoldatorerna under julledigheten. Alla inom gruppen borde ha laddat ner visual studio code på skoldatorerna innan julledigheten. Endast en i gruppen lyckades ladda ner det innan uppehållet. Vilket ledde till att de andra gruppmedlemmarna behövde fråga Filip om att göra en “live share” för att ta del av filerna och fortsätta att programmera.  Om vi hade kontaktat LIU-support tidigare så hade vi nog kunnat undvika dessa problem och undvikit bortkastad tid samt energi som lades på fel saker.
    </p>
</div>

<!-- Page 8 --> 
<div class="paper" id="section6">
    <p class="pageNum">8</p>
    <h1>6. Tidsåtgång</h1>
        <table class="text">
            <tr>
                <th>Design</th>
                <th>Moodboard, wireframe och mockup</th> 
                <th>Utveckling</th>
            </tr>
            <tr>
                <td>12h</td>
                <td>9h</td>
                <td>135h</td>
            </tr>
        </table>
</div>

</body>
</html>
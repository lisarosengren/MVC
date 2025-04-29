<?php

namespace App\Controller;

use App\Card\DeckOfCards;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ControllerTwig extends AbstractController
{
    #[Route("/lucky", name: "lucky")]
    public function number(): Response
    {
        $nameList = ["Chariman Meow", "Cindy Clawford", "Fidel Catstro", "Dolly Purrton", "Paw McCartney", "Cat Stevens", "Puma Thurman"];
        $number = random_int(0, 6);
        $name = $nameList[$number];

        $data = [
            'name' => $name,
            'number' => $number
        ];

        return $this->render('lucky.html.twig', $data);
    }

    #[Route("/", name: "home")]
    public function home(): Response
    {
        return $this->render('home.html.twig');
    }

    #[Route("/about", name: "about")]
    public function about(): Response
    {
        return $this->render('about.html.twig');
    }

    #[Route("/report", name: "report")]
    public function report(): Response
    {
        $kmom01 = "<p>Mina förkunskaper och tidigare erfarenheter kring objektorientering är enbart från OOPython-kursen. Där skapades en webbplats för att spela yahzee och en annan för att söka efter olika ord i ett prefix-träd (trie).</p><p>Ett objekt är en samling variabler och metoder (funktioner kallas metoder i objekt). Variablernas värde ändras med hjälp av objektets metoder. Metoderna kan också användas för att utföra en uppgift. För att skapa ett objekt använder man sig av en klass. Klassen är som en ritning eller mall för objekten. Den talar om vilka variabler och metoder som ska finnas. </p><p> I den här uppgiften ärvde templatefilerna från en basmall vilket gjorde att man inte behövde inkludera header och footer. Det tyckte jag var väldigt smidigt. Jag känner mig inte helt hemma i ramverk och att skriva php med olika taggar och så där, men jag hoppas att det ger sig så småningom. Jag tycker det är kul med router!</p><p> Jag har inte tittat på “PHP The Right Way” så mycket, men tänker att delen och testning och errors and exceptions nog kan vara intressanta. </p><p> Idag har jag lärt mig att överskugga borders i CSS! Det har jag varit sugen på sen starten av förra lärperioden. </p>";
        $kmom02 = "<p>Pust! Det här tog tid. Det var ganska kul, men tog alldeles för lång tid. Det var mycket frustration kring POST också. Jag återkommer till det.</p><p>Om man skapar en klass och vill att en annan klass ska ha samma attribut och metoder så kan man låta den andra klassen ärva. Sen är det enkelt att lägga till eventuella metoder eller helt enkelt skriva över den ärvda klassens befintliga. Det är smidigt och gör att koden går att återanvända. Komposition handlar om att klasser är relaterade till varandra. Om en klass är ett hus och en annan klass är ett rum som finns i huset är det komposition. Interface är lite som en abstrakt klass i Python. Det är lite som ett recept som talar om vad som ska finnas i klassen, men själva metodernas body är tom. Trait är moduler med kod som kan användas av flera klasser.</p><p>Jag löste uppgiften genom att skapa klasserna enligt kraven. Mitt CardGraphic skickar ut en sträng med <div>-tagg och UTF-8-kod i metoden getAsString. Tack vare UTF-8-koderna var det lätt att sortera korten i visningsuppgiften. Men det blev svårare i JSON. Eftersom kortleken blandas i objektet blev det svårt att sortera dem sen, eftersom deras “value” var strängar och inte siffror. Jag googlade lite och det verkade finnas lösningar, men jag hade inte riktigt tid att sätta mig in i hur de fungerade så jag valde till slut att göra en lista med korten i den ordningen jag ville ha dem och sen loopa igenom den listan och kontrollera om kortet finns kvar i leken, om det gör det läggs dess värde till i en lista som sen är den jag skickar ut. Ett annat problem var att få till POST api/deck/draw/:number. Just nu är det löst genom att man helt enkelt drar 2 kort när man trycker på den knappen. Då blir routen api/deck/draw/2. Från början försökte jag med rullmeny där man kunde välja antal kort upp till så många som finns kvar, men det blir inte rätt route då... Det går säkert att lösa med JS men jag var redan på övertid så jag har låtit det vara så. Det är ett litet konstigt krav eftersom man aldrig kan skicka in direkt via URL ändå pga POST? Eller hur är det tänkt? Jag gissar att det finns en tanke framåt och att jag kommer att ångra mina val, jag hade dock inte haft tid att lägga på att läsa in mig i förväg den här veckan. Trots att jag säkert hade tjänat på det i slutändan.<p><p>Jag tycker att MVC och Symfony är ett smidigt sätt att jobba. Jag uppskattar särskilt att ha olika filer för olika controllers, det blir lättare att få en överblick. Det är inte helt enkelt att förstå sig på Symfonys dokumentation och jag hade lite problem med att hitta hur man tömmer session. Jag googlade, men sen ville jag hitta i dokumentationen också och det var svårare. Det är något jag gärna hade velat få lite mer guidning i, hur läser jag dokumentationen för olika språk och verktyg? Vad ska jag leta efter? Hur ska jag tolka?</p><p>Min TIL för detta kmom är VILKA tecken jag ska använda när det gäller UTF8. Det gick lite extra tid åt att jag använde fel...</p>";
        $kmom03 = "<p>Den här uppgiften satt långt inne. Den hade inte behövt göra det, det var inte superkrångligt men jag drabbades av en blockering som gjorde det svårt för mig att börja. Det började med pseudokoden. Jag hakade upp mig på att den skulle vara utformad på ett särskilt sätt och med särskilda ord och konstruktioner vilket gjorde att jag drog mig för att börja och sen tyckte att det var krångligt. Jag tror absolut att det är något som blir enklare med tiden och jag kommer försöka fortsätta, även om jag kanske gör någon blandning av pseudokod och flödesschema. Steget från problemlösningsdelen till själva implementeringen var rätt långt, tidsmässigt. Jag har skjutit upp det, hittat grejer att fixa med i webapp istället och gruvat mig. Samtidigt har jag funderat över min pseudokod och mina klasser och skissat på lösningar i mitt huvud. Det hade säkert varit bättre att sitta vid skrivbordet och gjort det med papper och penna än att ägna annan tid åt det. Jag tycker att min lösning blev okej. Den hade definitivt kunnat vara mycket bättre och mer avancerad, men jag tror att den uppfyller kraven. Jag är lite orolig att den ska vara utformad på fel sätt för tester och så framåt, men det får jag ta då. Hade jag gjort om kortleken hade jag utformat den på ett annat sätt tror jag. Hade jag lagt in värdena där eller i korten hade det underlättat min sortering i förra kmom, men vill man se till fler möjligheter finns det ju spel som inte har samma poängsättning. Jag har löst uppgiften genom att skapa en klass för själva spelet, där har jag lagt in spelare och banks händer och totalpoäng. Phpstan bråkade med mig eftersom jag skapade min array med spelare och bank i konstruktorn och för att lösa det och fortfarande ha dependency injection fick jag lägga till en ny metod som skapar konstruktorn. Det känns lite avigt eftersom det innebär att jag behöver göra två grejer för att skapa ett spel. Problemet för phpstan var att jag inte använde mina CardHand-objekt direkt som properties utan via arrayen. Finns det något bättre knep? Från början hade jag tänkt att poängen inte skulle räknas om för varje gång utan enbart ess och nytt kort skulle räknas men jag kom fram till att det var så lite att räkna att det var bättre att inte krångla till det. För spelaren används en metod som drar kort och räknar ut summan, spelaren får sen välja att stanna eller dra fler kort. När det är bankens tur så anropas en metod som använder sig av samma metoder som spelaren fast den gör det tills banken uppnåt över 17. Därefter jämförs poängen och vinnaren utses. Det hade varit kul att göra så att bankens kort drogs och ritades ut med lite tidsförskjutning!</p><p>Jag har lite svårt att säga hur min känsla för att koda i ramverk är, jag har inte någon direkt uppfattning tror jag. Jag tycker att det är smidigt att kunna ha mallar man fyller med innehåll, även om jag ibland blir lite osäker på hur och vilket innehåll jag ska skicka.</p><p>Min TIL för de här veckorna är lite splittrad. Min första tanke var att det skulle vara att sluta vara rädd för uppgiften och sätta igång. Samtidigt så är det en del som fallit på plats av att jag har fått fundera lite i bakgrunden. </p> ";
        $data = [
            'kmom01' => $kmom01,
            'kmom02' => $kmom02,
            'kmom03' => $kmom03,
        ];


        return $this->render('report.html.twig', $data);
    }

    #[Route("/api", name: "api")]
    public function api(): Response
    {
        return $this->render('api.html.twig');
    }
}

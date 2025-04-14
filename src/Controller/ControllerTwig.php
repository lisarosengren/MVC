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
        $data = [
            'kmom01' => $kmom01,
            'kmom02' => $kmom02
        ];


        return $this->render('report.html.twig', $data);
    }

    #[Route("/api", name: "api")]
    public function api(): Response
    {
        return $this->render('api.html.twig');
    }
}

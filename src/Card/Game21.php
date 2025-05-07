<?php

namespace App\Card;

use Exception;
use App\Card\Player;
use App\Card\DeckOfCards;

// use App\Card\CardGraphic;
/**
 * The class Game21 represents the game 21.
 */
class Game21
{
    /**
     * @var array<string, int> $values
     */
    private array $values = [
        "Ace" => 1,
        "Two" => 2,
        "Three" => 3,
        "Four" => 4,
        "Five" => 5,
        "Six" => 6,
        "Seven" => 7,
        "Eight" => 8,
        "Nine" => 9,
        "Ten" => 10,
        "Jack" => 11,
        "Queen" => 12,
        "King" => 13,
    ];

    /**
     * @var array<string, array{hand: CardHand, total: int}>
     */
    private array $participants;

    private string $gameStatus = "Inte avgjort än!";

    public function __construct(private CardHand $player, private CardHand $bank, private DeckOfCards $deck)
    {
        $this->deck->shuffleDeck();
        $this->addParticipants();
    }

    public function addParticipants(): void
    {
        $this->participants = [
            "player" => [
                "hand" => $this->player,
                "total" => 0
            ],
            "bank" => [
                "hand" => $this->bank,
                "total" => 0
            ]
            ];
    }

    public function getTotal(string $who): int
    {
        if (array_key_exists($who, $this->participants)) {
            return $this->participants[$who]["total"];
        }
        throw new Exception("Spelaren existerar inte.");
    }

    public function getHand(string $who): CardHand
    {
        return $this->participants[$who]["hand"];
    }

    private function getValue(string $card): int
    {

        $value = $this->values[strtok($card, " ")];

        return $value;
    }

    public function firstDraw(string $who): void
    {
        $this->participants[$who]["hand"]->add($this->deck->drawCardGame());
        $this->participants[$who]["hand"]->add($this->deck->drawCardGame());
        $this->calculateSum($who);
    }

    public function draw(string $who): void
    {
        $this->participants[$who]["hand"]->add($this->deck->drawCardGame());
        $this->calculateSum($who);
    }

    public function calculateSum(string $who): void
    {
        $sum = 0;
        $aces = 0;
        foreach ($this->participants[$who]["hand"]->getValues() as $card) {
            $cardValue = $this->getValue($card);
            if ($cardValue === 1) {
                $aces += 1;
                continue;
            }
            $sum += $this->getValue($card);
        }
        if ($aces > 0) {
            if ($sum + $aces + 13 <= 21) {
                $sum += 13;
            }
            $sum += $aces;

        }
        $this->participants[$who]["total"] = $sum;

        if ($sum > 21) {
            $this->gameStatus = "$who förlorade!";
        }
    }

    public function banksTurn(): void
    {
        $this->firstDraw("bank");


        while ($this->participants["bank"]["total"] < 17) {
            $this->draw("bank");
            $this->calculateSum("bank");
        }
        if ($this->participants["bank"]["total"] === 21) {
            $this->gameStatus = "Banken vann!";
            return;
        }
        if ($this->participants["bank"]["total"] > 21) {
            $this->gameStatus = "Spelaren vann!";
            return;
        }
        $this->winner();
    }

    private function winner(): void
    {
        if ($this->participants["bank"]["total"] >= $this->participants["player"]["total"]) {
            $this->gameStatus = "Banken vann!";
            return;
        }
        $this->gameStatus = "Spelaren vann!";
    }

    public function getStatus(): string
    {
        return $this->gameStatus;
    }
}

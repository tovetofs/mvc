<?php

namespace App\Game;

use App\Card\Card;
use App\Card\CardGraphic;
use App\Card\CardHand;
use App\Card\DeckOfCards;

class GamePlan
{
    /**
     * @var array<string>
     */
    public static array $staticRows = array("row1", "row2", "row3", "row4", "row5");

    /**
     * @var array<string>
     */
    public static array $staticCols = array("col1", "col2", "col3", "col4", "col5");

    /**
     * @var array<mixed>
     */
    private array $gamePlan = [];

    private int $playedCards = 0;

    public function __construct()
    {
        foreach (self::$staticRows as $row) {
            foreach (self::$staticCols as $col) {
                $this->gamePlan[$row][$col] = '';
            }
        }
    }

    // Shows game plan as an array
    /**
    * @return array<mixed>
    */
    public function showGamePlan(): array
    {
        return $this->gamePlan;
    }

    // Places one card on the game plan
    public function placeCard(string $row, string $col, Card $card): void
    {
        $this->gamePlan[$row][$col] = $card;
        $this->playedCards += 1;
    }

    // Returns number of played cards
    public function playedCards(): int
    {
        return $this->playedCards;
    }

    /**
    * @return array<mixed>
    */
    public function showJsonBoard(): array
    {
        $resArray = [];
        foreach ($this->showGamePlan() as $row => $cols) {
            foreach ($cols as $col => $card) {
                $resArray[$row][$col] = "";
                if ($card) {
                    $resArray[$row][$col] = array($card->suit(), $card->rank());
                }
            }
        }
        return $resArray;
    }
}

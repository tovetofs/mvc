<?php

namespace App\Game;

use App\Card\Card;
use App\Card\CardGraphic;
use App\Card\CardHand;
use App\Card\DeckOfCards;

/**
 * Class representing a game plan
 */
class GamePlan
{
    /**
     * Array with the rows in a game plan
     * @var array<string>
     */
    public static array $staticRows = array("row1", "row2", "row3", "row4", "row5");

    /**
     * Array with the columns in a game plan
     * @var array<string>
     */
    public static array $staticCols = array("col1", "col2", "col3", "col4", "col5");

    /**
     * Multidimensional array holding the game plan
     * @var array<mixed>
     */
    private array $gamePlan = [];

    /**
     * Number of placed cards
     */
    private int $playedCards = 0;

    /**
     * Constructs a game plan using the arrays of rows and columns
     */
    public function __construct()
    {
        foreach (self::$staticRows as $row) {
            foreach (self::$staticCols as $col) {
                $this->gamePlan[$row][$col] = '';
            }
        }
    }

    /**
     * Shows game plan as an array
     * @return array<mixed>
     */
    public function showGamePlan(): array
    {
        return $this->gamePlan;
    }

    /**
     * Places one card on the game plan, takes rownumber, colnumber and card
     * as parameters
     */
    public function placeCard(string $row, string $col, Card $card): void
    {
        $this->gamePlan[$row][$col] = $card;
        $this->playedCards += 1;
    }

    /**
     * Returns number of played cards
     */
    public function playedCards(): int
    {
        return $this->playedCards;
    }

    /**
     * Returns the game plan as an array
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

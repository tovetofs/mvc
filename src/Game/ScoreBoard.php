<?php

namespace App\Game;

use App\Card\Card;
use App\Card\CardGraphic;
use App\Card\CardHand;
use App\Card\DeckOfCards;

class ScoreBoard
{
    /**
     * @var array<string>
     */
    public static array $staticGameCols = array("col1", "col2", "col3", "col4", "col5");

    // Rules sorted according to points - american system
    /**
     * @var array<string, int>
     */
    public static array $gamePointsAm = array("royalFlush"=>100, "straightFlush"=>75, "fourOfAKind"=>50,
        "fullHouse"=>25, "flush"=>20, "straight"=>15, "threeOfAKind"=>10, "twoPairs" =>5, "pair"=>2);

    // Rules sorted according to points - english system
    /**
     * @var array<string, int>
     */
    public static array $gamePointsEng = array("royalFlush"=>30, "straightFlush"=>30, "fourOfAKind"=>16,
        "fullHouse"=>10, "straight"=>12, "threeOfAKind"=>6, "flush"=>5, "twoPairs" =>3, "pair"=>1);

    private float $totalSum = 0;

    /**
     * @var array<int>
     */
    private array $rowSums = [];

    /**
     * @var array<int>
     */
    private array $colSums = [];

    // Sets the scores in each row as an array
    public function rowScore(GamePlan $gamePlan, GameRules $gameRules, string $pointSystem): void
    {
        $resArray = [];
        foreach ($gamePlan->showGamePlan() as $cards) {
            $resArray[] = $this->calculateScores($cards, $gameRules, $pointSystem);
        }
        $this->rowSums = $resArray;
        // return $resArray;
    }

    // Sets the scores in each column as an array
    public function colScore(GamePlan $gamePlan, GameRules $gameRules, string $pointSystem): void
    {
        $resArray = [];
        foreach (self::$staticGameCols as $col) {
            $cardArray = [];
            foreach ($gamePlan->showGamePlan() as $cards) {
                $cardArray[] = $cards[$col];
            }
            $resArray[] = $this->calculateScores($cardArray, $gameRules, $pointSystem);
        }
        $this->colSums = $resArray;
        // return $resArray;
    }

    // Calculate the score of an array of cards, loop through the set of rules
    /**
     * @param array<Card> $cards
     */
    public function calculateScores(array $cards, GameRules $gameRules, string $pointSystem): int
    {
        $score = 0;
        if ($pointSystem === 'Am') {
            foreach (self::$gamePointsAm as $rule => $points) {
                $result = $gameRules->$rule($cards);
                if ($result) {
                    $score = self::$gamePointsAm[$rule];
                    break;
                }
            }
        } else {
            foreach (self::$gamePointsEng as $rule => $points) {
                $result = $gameRules->$rule($cards);
                if ($result) {
                    $score = self::$gamePointsEng[$rule];
                    break;
                }
            }
        }

        return $score;
    }

    // Sets the total sum of all rows and columns
    public function setTotalSum(GamePlan $gamePlan, GameRules $gameRules, string $pointSystem): void
    {
        $this->rowScore($gamePlan, $gameRules, $pointSystem);
        $this->colScore($gamePlan, $gameRules, $pointSystem);
        $this->totalSum = array_sum($this->rowSums) + array_sum($this->colSums);
    }

    // Check if score is enough to win
    public function checkWin(string $pointSystem): bool
    {
        $win = false;
        if ($pointSystem === 'Am') {
            if ($this->totalSum >= 200) {
                $win = true;
            }
        } else {
            if ($this->totalSum >= 70) {
                $win = true;
            }
        }
        return $win;
    }

    // Returns array with score for each row
    /**
    * @return array<int>
    */
    public function rowSums(): array
    {
        return $this->rowSums;
    }

    // Returns array with score for each column
    /**
    * @return array<int>
    */
    public function colSums(): array
    {
        return $this->colSums;
    }

    // Returns total score
    public function totalSum(): float
    {
        return $this->totalSum;
    }
}

<?php

namespace App\Game;

// namespace App\Card;

use App\Card\Card;
use App\Card\CardGraphic;
use App\Card\CardHand;
use App\Card\DeckOfCards;

/**
 * Class representing the game rules nbr 2
 */
class GameRulesTwo
{
    /**
     * Saves the value of the cards in an array of cards in an array, then counts
     * how many cards of each value is found, returns array
     * @param array<mixed> $cards
     * @return array<int>
     */
    public function getRanks(array $cards): array
    {
        $test = [];
        // $result = 0;
        foreach ($cards as $card) {
            // $cards as Card
            if (!$card) {
                continue;
            }
            $test[] = $card->value();
        }
        $vals = array_count_values($test);
        return $vals;
    }

    /**
     * Tests if array of cards is a straight part 2
     * Checks if the cards are consecutive
     * @param array<int> $cardValues
     */
    public function straight2(array $cardValues): bool
    {
        $result = false;
        // Sort values
        sort($cardValues);
        $round = 0;
        $cardsInRow = 0;
        // Loop cardvalues, see if cardvalue equals next value - 1 four times in a row
        // Check aces for both 1 and 14
        foreach ($cardValues as $value) {
            // $cardValues as int
            if ($value === ($cardValues[$round + 1] - 1)) {
                $cardsInRow += 1;
                if ($cardsInRow === 4) {
                    $result = true;
                    break;
                }
                $round += 1;
            } elseif ($value === 1 && ($cardValues[$round + 1] === 10)) {
                $cardsInRow += 1;
                // if ($cardsInRow === 4) {
                //     $result = true;
                //     break;
                // }
                $round += 1;
            }
        }
        return $result;
    }
}

<?php

namespace App\Game;

// namespace App\Card;

use App\Card\Card;
use App\Card\CardGraphic;
use App\Card\CardHand;
use App\Card\DeckOfCards;

/**
 * Class representing the game rules
 */
class GameRules
{
    /**
     * Tests if array of cards is a royal flush
     * @param array<mixed> $cards
     */
    public function royalFlush(array $cards): bool
    {
        $result = false;
        $cardValues = [];
        foreach ($cards as $card) {
            if (!$card) {
                break;
            }
            $cardValues[] = $card->value();
        }
        if ($this->flush($cards)) {
            $royalFlush = array(10, 11, 12, 13, 1);
            if (!array_diff($royalFlush, $cardValues)) {
                $result = true;
            }
        }
        return $result;
    }

    /**
     * Tests if array of cards is a straight flush
     * @param array<Card> $cards
     */
    public function straightFlush(array $cards): bool
    {
        $result = false;
        if (($this->straight($cards)) && ($this->flush($cards))) {
            $result = true;
        }
        return $result;
    }

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
     * Tests if array of cards is a four of a kind
     * @param array<Card> $cards
     */
    public function fourOfAKind(array $cards): bool
    {
        $result = false;
        $vals = $this->getRanks($cards);
        if (in_array(4, array_values($vals))) {
            $result = true;
        }
        return $result;
    }

    /**
     * Tests if array of cards is a full house
     * @param array<Card> $cards
     */
    public function fullHouse(array $cards): bool
    {
        $result = false;
        $vals = $this->getRanks($cards);
        if (in_array(3, array_values($vals)) && in_array(2, array_values($vals))) {
            $result = true;
        }
        return $result;
    }

    /**
     * Tests if array of cards is a three of a kind
     * @param array<Card> $cards
     */
    public function threeOfAKind(array $cards): bool
    {
        $result = false;
        $vals = $this->getRanks($cards);
        if (in_array(3, array_values($vals))) {
            $result = true;
        }
        return $result;
    }

    /**
     * Tests if array of cards is two pairs
     * @param array<Card> $cards
     */
    public function twoPairs(array $cards): bool
    {
        $result = false;
        $vals = $this->getRanks($cards);
        $numbers = array_count_values($vals);
        if (array_key_exists(2, $numbers)) {
            if ($numbers[2] === 2) {
                $result = true;
            }
        }
        return $result;
    }

    /**
     * Tests if array of cards is a pair
     * @param array<Card> $cards
     */
    public function pair(array $cards): bool
    {
        $result = false;
        $vals = $this->getRanks($cards);
        if (in_array(2, array_values($vals))) {
            $result = true;
        }
        return $result;
    }

    /**
     * Tests if array of cards is a straight part 1
     * Checks if there are 5 different values in array of cards
     * @param array<mixed> $cards
     */
    public function straight(array $cards): bool
    {
        $result = false;
        $cardValues = [];
        // Loop cards, save value in array, break if card is missing
        foreach ($cards as $card) {
            if (!$card) {
                break;
            }
            $cardValues[] = $card->value();
        }
        // Check if five cards on row/col
        if (sizeof($cardValues) === 5) {
            $result = $this->straight2($cardValues);
        }
        return $result;
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

    /**
     * Tests if array of cards is a flush
     * @param array<mixed> $cards
     */
    public function flush(array $cards): bool
    {
        $result = false;
        $test = [];
        $allCards = true;
        // Loop cards, save suit in array
        foreach ($cards as $card) {
            if (!$card) {
                $allCards = false;
                continue;
            }
            if (!in_array($card->suit(), $test)) {
                $test[] = $card->suit();
            }
        }
        // Check if only one suit in array
        if (count($test) === 1 && $allCards) {
            $result = true;
        }
        return $result;
    }
}

<?php

namespace App\Game;

use App\Card\Card;
use App\Card\CardGraphic;
use App\Card\CardHand;
use App\Card\DeckOfCards;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Game Rule.
 */
class GameRulesTwoTest extends TestCase
{
    /**
     * Testing function getRanks
     */
    public function testGetRanks(): void
    {
        $testRules3 = new GameRulesTwo();
        $cardArray3 = array(new Card('hearts', 'A'), new Card('hearts', '2'),
            new Card('hearts', '3'), new Card('hearts', '4'), new Card('hearts', '5'));
        $incompleteArray = array(new Card('hearts', 'A'), new Card('hearts', '2'),
            new Card('hearts', '3'), '', new Card('hearts', '5'));

        $this->assertEquals(
            array(1 => 1, 2 => 1, 3 => 1, 4 => 1, 5 => 1,),
            $testRules3->getRanks($cardArray3)
        );
        $this->assertNotEquals(
            array(1 => 1, 2 => 1, 3 => 1, 4 => 1, 5 => 1,),
            $testRules3->getRanks($incompleteArray)
        );
    }
}

<?php

namespace App\Game;

use App\Card\Card;
use App\Card\CardGraphic;
use App\Card\CardHand;
use App\Card\DeckOfCards;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Card.
 */
class GameRulesTest extends TestCase
{
    /**
     * Construct object
     */
    public function testRoyalFlush()
    {
        $testRules = new GameRules();
        $cardArray = array(new Card('hearts', '10'), new Card('hearts', 'J'),
            new Card('hearts', 'Q'), new Card('hearts', 'K'), new Card ('hearts', 'A'));
        // $res = $testRules->royalFlush($royalFlush);
        // $this->assertEquals(true, $res);
        $this->assertTrue($testRules->royalFlush($cardArray));

        $this->assertTrue($testRules->straightFlush($cardArray));
    }

    public function testWrongCards()
    {
        $testRules2 = new GameRules();
        $cardArray2 = array(new Card('hearts', '10'), '',
            new Card('hearts', 'Q'), new Card('hearts', 'K'), new Card ('hearts', 'A'));

        $this->assertFalse($testRules2->royalFlush($cardArray2));

        $this->assertFalse($testRules2->straightFlush($cardArray2));
    }

    public function testGetRanks()
    {
        $testRules3 = new GameRules();
        $cardArray3 = array(new Card('hearts', 'A'), new Card('hearts', '2'),
            new Card('hearts', '3'), new Card('hearts', '4'), new Card ('hearts', '5'));
        $incompleteArray = array(new Card('hearts', 'A'), new Card('hearts', '2'),
            new Card('hearts', '3'), '', new Card ('hearts', '5'));
        
        $this->assertEquals(array(1 => 1, 2 => 1, 3 => 1, 4 => 1, 5 => 1,), $testRules3->getRanks($cardArray3));
        $this->assertNotEquals(array(1 => 1, 2 => 1, 3 => 1, 4 => 1, 5 => 1,), $testRules3->getRanks($incompleteArray));
    }

    public function testFullHouse()
    {
        $testRules4 = new GameRules();
        $cardArray4 = array(new Card('hearts', 'A'), new Card('spades', 'A'),
            new Card('spades', '2'), new Card('hearts', '2'), new Card ('clubs', '2'));
        
        $this->assertTrue($testRules4->fullHouse($cardArray4));

        // Lägg till test med neg utfall!
    }

    public function testFourOfAKind()
    {
        $testRules4 = new GameRules();
        $cardArray4 = array(new Card('hearts', 'A'), new Card('diamonds', '2'),
            new Card('spades', '2'), new Card('hearts', '2'), new Card ('clubs', '2'));
        
        $this->assertTrue($testRules4->fourOfAKind($cardArray4));

        // Lägg till test med neg utfall!
    }

    public function testThreeOfAKind()
    {
        $testRules5 = new GameRules();
        $cardArray5 = array(new Card('hearts', 'A'), new Card('spades', 'A'),
            new Card('spades', '2'), new Card('hearts', '2'), new Card ('clubs', '2'));
        
        $this->assertTrue($testRules5->threeOfAKind($cardArray5));

        // Lägg till test med neg utfall!
    }
}

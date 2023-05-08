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
class GameRulesTest extends TestCase
{
    /**
     * Testing rules royal flush and straight flush
     */
    public function testRoyalFlush(): void
    {
        $testRules = new GameRules();
        $cardArray = array(new Card('hearts', '10'), new Card('hearts', 'J'),
            new Card('hearts', 'Q'), new Card('hearts', 'K'), new Card('hearts', 'A'));

        $wrongArray = array(new Card('hearts', '10'), new Card('diamonds', '4'),
            new Card('hearts', 'Q'), new Card('hearts', 'K'), new Card('hearts', 'A'));

        $this->assertTrue($testRules->royalFlush($cardArray));
        $this->assertFalse($testRules->royalFlush($wrongArray));
        $this->assertTrue($testRules->straightFlush($cardArray));
        $this->assertFalse($testRules->straightFlush($wrongArray));
    }

    /**
     * Testing function getRanks
     */
    public function testGetRanks(): void
    {
        $testRules3 = new GameRules();
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

    /**
     * Testing rule full house
     */
    public function testFullHouse(): void
    {
        $testRules4 = new GameRules();
        $cardArray4 = array(new Card('hearts', 'A'), new Card('spades', 'A'),
            new Card('spades', '2'), new Card('hearts', '2'), new Card('clubs', '2'));

        $wrongArray = array(new Card('hearts', '10'), new Card('clubs', '7'),
            new Card('hearts', 'Q'), new Card('hearts', 'K'), new Card('hearts', 'A'));

        $this->assertTrue($testRules4->fullHouse($cardArray4));
        $this->assertFalse($testRules4->fullHouse($wrongArray));
    }

    /**
     * Testing rule four of a kind
     */
    public function testFourOfAKind(): void
    {
        $testRules5 = new GameRules();
        $cardArray5 = array(new Card('hearts', 'A'), new Card('diamonds', '2'),
            new Card('spades', '2'), new Card('hearts', '2'), new Card('clubs', '2'));

        $wrongArray = array(new Card('hearts', '10'), new Card('clubs', '7'),
            new Card('hearts', 'Q'), new Card('hearts', 'K'), new Card('hearts', 'A'));

        $this->assertTrue($testRules5->fourOfAKind($cardArray5));
        $this->assertFalse($testRules5->fourOfAKind($wrongArray));
    }

    /**
     * Testing rule three of a kind
     */
    public function testThreeOfAKind(): void
    {
        $testRules6 = new GameRules();
        $cardArray6 = array(new Card('hearts', 'A'), new Card('spades', 'A'),
            new Card('spades', '2'), new Card('hearts', '2'), new Card('clubs', '2'));

        $wrongArray = array(new Card('hearts', '10'), new Card('clubs', '7'),
            new Card('hearts', 'Q'), new Card('hearts', 'K'), new Card('hearts', 'A'));

        $this->assertTrue($testRules6->threeOfAKind($cardArray6));
        $this->assertFalse($testRules6->threeOfAKind($wrongArray));

        // Lägg till test med neg utfall!
    }

    /**
     * Testing rule two pairs
     */
    public function testTwoPair(): void
    {
        $testRules7 = new GameRules();
        $cardArray7 = array(new Card('hearts', 'A'), new Card('spades', 'A'),
            new Card('spades', '2'), new Card('hearts', '2'), new Card('clubs', '3'));

        $wrongArray = array(new Card('hearts', '10'), new Card('clubs', '7'),
            new Card('hearts', 'Q'), new Card('hearts', 'K'), new Card('hearts', 'A'));

        $this->assertTrue($testRules7->twoPairs($cardArray7), 'Should contain two pairs');
        $this->assertFalse($testRules7->twoPairs($wrongArray));
    }

    /**
     * Testing rule pair
     */
    public function testPair(): void
    {
        $testRules8 = new GameRules();
        $cardArray8 = array(new Card('hearts', 'A'), new Card('spades', 'A'),
            new Card('spades', '2'), new Card('hearts', '8'), new Card('clubs', '3'));

        $wrongArray = array(new Card('hearts', '10'), new Card('clubs', '7'),
            new Card('hearts', 'Q'), new Card('hearts', 'K'), new Card('hearts', 'A'));

        $this->assertTrue($testRules8->pair($cardArray8), 'Should contain one pair');
        $this->assertFalse($testRules8->pair($wrongArray));
    }
}

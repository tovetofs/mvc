<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class CardHand.
 */
class CardHandTest extends TestCase
{
    /**
     * Creates a hand of cards, adds card to hand, tests if the cards are found
     * in the hand
     */
    public function testCreateHand(): void
    {
        $testArray = array(new Card('hearts', 'K'), new Card('clubs', '8'));
        $testHand = new CardHand($testArray);
        $this->assertInstanceOf("\App\Card\CardHand", $testHand, 'Should be instancde Card');

        $testHand->add(new Card('spades', 'A'));

        $resArray = $testHand->showHand()['spadesA'];
        $this->assertEquals('spades', $resArray['suit'], 'Suit should be spades');
        $resArray2 = $testHand->showJsonDeck()[0];
        $this->assertEquals('K', $resArray2['rank'], 'Rank should be K');
    }
}

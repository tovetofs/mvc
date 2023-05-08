<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class CardHand.
 */
class DeckOfCardsTest extends TestCase
{
    /**
     * Construct object DeckOfCards
     * Tests that it contains only CardGraphic
     */
    public function testCreateDeckOfCards(): void
    {
        $testDeck = new DeckOfCards();
        $this->assertInstanceOf("\App\Card\DeckOfCards", $testDeck);
        $this->assertContainsOnlyInstancesOf('\App\Card\CardGraphic', $testDeck->deck);
    }

    /**
     * Constructs a deck, then shuffles and compares the original to the shuffled (should be different),
     * then sorts the deck and compares again with the original deck (should be the same)
     */
    public function testShuffleDeck(): void
    {
        $testDeck2 = new DeckOfCards();
        $testDeckNew = $testDeck2->showDeck();
        $testDeck2->shuffleDeck();
        $testDeckShuffled = $testDeck2->showDeck();
        $this->assertNotEquals(array_keys($testDeckNew), array_keys($testDeckShuffled));
        $testDeck2->sortDeck();
        $this->assertEquals(array_keys($testDeck2->showDeck()), array_keys($testDeckNew), 'message');
    }

    /**
     * Constructs a deck, check number of cards, then draw cards, check that 3 cards was drawn and that
     * it was CardGraphic, then check remaining cards in deck
     */
    public function testDrawCards(): void
    {
        $testDeck3 = new DeckOfCards();
        $this->assertEquals(52, $testDeck3->remainingCards(), 'Testing that there are 52 cards in a deck');

        $testDraw = $testDeck3->drawCards(3);
        $this->assertEquals(3, count($testDraw), 'Testing that there are 3 objects that are drawn');
        $this->assertContainsOnlyInstancesOf('\App\Card\CardGraphic', $testDraw, 'Testing
            that testDraw contains CardGraphic');
        $this->assertEquals(49, $testDeck3->remainingCards(), 'Checking that there are 49 cards left in deck');
    }

    /**
     * Testing to return deck of cards as an associative array
     */
    public function testShowJsonDeck(): void
    {
        $testDeck4 = new DeckOfCards();
        $testJson = $testDeck4->showJsonDeck();
        $this->assertEquals('clubs', $testJson[0]['suit']);
        $this->assertEquals('2', $testJson[1]['rank']);
        $this->assertIsArray($testJson);
    }
}

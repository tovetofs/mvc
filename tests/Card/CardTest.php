<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Card.
 */
class CardTest extends TestCase
{
    /**
     * Creates a new card, tests if instance of Card and if correct card
     */
    public function testCreateCardNbr(): void
    {
        $testCard = new Card('spades', '7');
        $this->assertInstanceOf("\App\Card\Card", $testCard);

        $this->assertEquals('spades7', $testCard->displayCard(), 'Should be spades7');
        $this->assertNotEquals('spades8', $testCard->displayCard(), 'Should not be spades8');
    }

    /**
     * Test to create an ace
     */
    public function testCreateCardAce(): void
    {
        $testCard2 = new Card('spades', 'A');
        $this->assertInstanceOf("\App\Card\Card", $testCard2, 'Should be Card');

        $this->assertEquals('spades', $testCard2->showSuit(), 'Should be spades');
        $this->assertEquals('A', $testCard2->showRank(), 'Should be rank A');
        $this->assertEquals(1, $testCard2->showValue(), 'Should be value 1');
        $this->assertNotEquals('A', $testCard2->showValue(), 'Value should not be A');
    }

    /**
     * Test to create a jack
     */
    public function testCreateCardJack(): void
    {
        $testCard3 = new Card('hearts', 'J');

        $this->assertEquals('hearts', $testCard3->suit(), 'Should be hearts');
        $this->assertEquals('J', $testCard3->rank(), 'Should be rank J');
        $this->assertEquals(11, $testCard3->value(), 'Should be value 11');
    }

    /**
     * Test to create a queen
     */
    public function testCreateCardQueen(): void
    {
        $testCard4 = new Card('diamonds', 'Q');

        $this->assertEquals('diamonds', $testCard4->showSuit(), 'Should be diamonds');
        $this->assertEquals('Q', $testCard4->showRank(), 'Should be rank Q');
        $this->assertEquals(12, $testCard4->showValue(), 'Should be value 12');
        $this->assertNotEquals('hearts', $testCard4->showSuit(), 'Should not be hearts');
    }

    /**
     * Test to create a king
     */
    public function testCreateCardKing(): void
    {
        $testCard5 = new Card('clubs', 'K');

        $this->assertEquals('clubs', $testCard5->suit(), 'Should be clubs');
        $this->assertEquals('K', $testCard5->rank(), 'Should be rank K');
        $this->assertEquals(13, $testCard5->value(), 'Should be value 13');
    }
}

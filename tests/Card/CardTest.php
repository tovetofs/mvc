<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Card.
 */
class CardTest extends TestCase
{
    /**
     * Construct object
     */
    public function testCreateCardNbr()
    {
        $testCard = new Card('spades', '7');
        $this->assertInstanceOf("\App\Card\Card", $testCard);

        $this->assertEquals('spades7', $testCard->displayCard());
    }

    public function testCreateCardAce()
    {
        $testCard2 = new Card('spades', 'A');
        $this->assertInstanceOf("\App\Card\Card", $testCard2);

        $this->assertEquals('spades', $testCard2->showSuit());
        $this->assertEquals('A', $testCard2->showRank());
        $this->assertEquals(1, $testCard2->showValue());
    }

    public function testCreateCardJack()
    {
        $testCard3 = new Card('hearts', 'J');

        $this->assertEquals('hearts', $testCard3->suit());
        $this->assertEquals('J', $testCard3->rank());
        $this->assertEquals(11, $testCard3->value());
    }

    public function testCreateCardQueen()
    {
        $testCard4 = new Card('diamonds', 'Q');

        $this->assertEquals('diamonds', $testCard4->showSuit());
        $this->assertEquals('Q', $testCard4->showRank());
        $this->assertEquals(12, $testCard4->showValue());
    }

    public function testCreateCardKing()
    {
        $testCard5 = new Card('clubs', 'K');

        $this->assertEquals('clubs', $testCard5->suit());
        $this->assertEquals('K', $testCard5->rank());
        $this->assertEquals(13, $testCard5->value());
    }
}

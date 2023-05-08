<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class CardGraphic.
 */
class CardGraphicTest extends TestCase
{
    /**
     * Creates a new Card Graphic and test that the right code is returned
     */
    public function testCreateCardGraphic(): void
    {
        $testCardGraphic = new CardGraphic('spades', '2');
        $this->assertInstanceOf("\App\Card\CardGraphic", $testCardGraphic, 'Should be a CardGraphic');

        $this->assertEquals('&#9824', $testCardGraphic->showUTF(), 'Should display &#9825');
    }
}

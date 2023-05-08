<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class CardGraphic.
 */
class CardGraphicTest extends TestCase
{
    /**
     * Construct object
     */
    public function testCreateCardGraphic(): void
    {
        $testCardGraphic = new CardGraphic('spades', '2');
        $this->assertInstanceOf("\App\Card\CardGraphic", $testCardGraphic);

        $this->assertEquals('&#9824', $testCardGraphic->showUTF());
    }
}

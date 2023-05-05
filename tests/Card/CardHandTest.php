<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class CardHand.
 */
class CardHandTest extends TestCase
{
    /**
     * Construct object
     */
    public function testCreateHand()
    {
        $testArray = array(new Card('hearts', 'K'), new Card('clubs', '8'));
        $testHand = new CardHand($testArray);
        $this->assertInstanceOf("\App\Card\CardHand", $testHand);

        $testHand->add(new Card('spades' ,'A'));
        
        $resArray = $testHand->showHand()['spadesA'];
        $this->assertEquals('spades', $resArray['suit']);
        $resArray2 = $testHand->showJsonDeck()[0];
        $this->assertEquals('K', $resArray2['rank']);
    }
}

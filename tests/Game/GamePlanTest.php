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
class GamePlanTest extends TestCase
{
    /**
     * Construct object
     */
    public function testCreateGamePlan(): void
    {
        $testPlan = new GamePlan();
        $this->assertInstanceOf("\App\Game\GamePlan", $testPlan, 'Should be an object GamePlan');
        $this->assertIsArray($testPlan->showGamePlan(), 'Show Game Plan should be an array');
    }

    /**
     * Placing a card on Game Plan, checking that correct card can be found on game plan
     */
    public function testPlaceCardOnGamePlan(): void
    {
        $testPlan2 = new GamePlan();
        $testPlan2->placeCard('row1', 'col1', new Card('spades', '3'));
        $gamePlanArray = $testPlan2->showGamePlan();
        $placedCard = $gamePlanArray['row1']['col1']->displayCard();
        $this->assertEquals('spades3', $placedCard, '3 of spades should be found on the game plan');
        $this->assertEquals(1, $testPlan2->playedCards(), 'There should be 1 card played on board');
    }

    public function testShowJsonBoard(): void
    {
        $testPlan3 = new GamePlan();
        $testPlan3->placeCard('row2', 'col2', new Card('spades', 'K'));
        $testJson = $testPlan3->showJsonBoard();
        $placedCard2 = $testJson['row2']['col2'];
        $this->assertEquals(array('spades', 'K'), $placedCard2, 'King of spades 
            should be found on the board');
    }
}

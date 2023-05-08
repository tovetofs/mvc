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
class ScoreBoardTest extends TestCase
{
    /**
     * Construct object
     */
    public function testCheckWin(): void
    {
        $testBoard = new ScoreBoard();
        // $testBoard->totalSum() = 90;
        $this->assertFalse($testBoard->checkWin('Eng'));
        $this->assertFalse($testBoard->checkWin('Am'));
    }

    public function testCalculateScore(): void
    {
        $testBoard2 = new ScoreBoard();
        $cardArray = array(new Card('hearts', '10'), new Card('hearts', 'J'),
            new Card('hearts', 'Q'), new Card('hearts', 'K'), new Card('hearts', 'A'));

        $this->assertEquals(100, $testBoard2->calculateScores(
            $cardArray,
            new GameRules(),
            'Am'
        ), 'Should return 100 points');
        $this->assertEquals(30, $testBoard2->calculateScores(
            $cardArray,
            new GameRules(),
            'Eng'
        ), 'Should return 30 points');
    }

    public function testRowScore(): void
    {
        $testBoard3 = new ScoreBoard();
        $testPlan = new GamePlan();
        $testPlan->placeCard('row1', 'col1', new Card('hearts', '10'));
        $testPlan->placeCard('row1', 'col2', new Card('hearts', 'J'));
        $testPlan->placeCard('row1', 'col3', new Card('hearts', 'Q'));
        $testPlan->placeCard('row1', 'col4', new Card('hearts', 'K'));
        $testPlan->placeCard('row1', 'col5', new Card('hearts', 'A'));

        $testBoard3->rowScore($testPlan, new GameRules(), 'Am');
        $testBoard3->colScore($testPlan, new GameRules(), 'Am');
        $testBoard3->setTotalSum($testPlan, new GameRules(), 'Am');

        $this->assertEquals([100, 0, 0, 0, 0], $testBoard3->rowSums());
        $this->assertEquals([0, 0, 0, 0, 0], $testBoard3->colSums());
        $this->assertEquals(100, $testBoard3->totalSum());
    }

    public function testColScore(): void
    {
        $testBoard4 = new ScoreBoard();
        $testPlan2 = new GamePlan();
        $testPlan2->placeCard('row1', 'col1', new Card('hearts', '10'));
        $testPlan2->placeCard('row2', 'col1', new Card('hearts', 'J'));
        $testPlan2->placeCard('row3', 'col1', new Card('hearts', 'Q'));
        $testPlan2->placeCard('row4', 'col1', new Card('hearts', 'K'));
        $testPlan2->placeCard('row5', 'col1', new Card('hearts', 'A'));

        $testPlan2->placeCard('row1', 'col2', new Card('spades', '2'));
        $testPlan2->placeCard('row2', 'col2', new Card('spades', '3'));
        $testPlan2->placeCard('row3', 'col2', new Card('spades', '4'));
        $testPlan2->placeCard('row4', 'col2', new Card('spades', '5'));
        $testPlan2->placeCard('row5', 'col2', new Card('spades', '6'));

        $testPlan2->placeCard('row1', 'col3', new Card('clubs', '4'));
        $testPlan2->placeCard('row2', 'col3', new Card('clubs', '5'));
        $testPlan2->placeCard('row3', 'col3', new Card('clubs', '6'));
        $testPlan2->placeCard('row4', 'col3', new Card('clubs', '7'));
        $testPlan2->placeCard('row5', 'col3', new Card('clubs', '8'));


        $testBoard4->colScore($testPlan2, new GameRules(), 'Eng');
        $testBoard4->setTotalSum($testPlan2, new GameRules(), 'Eng');

        $this->assertEquals([30, 30, 30, 0, 0], $testBoard4->colSums());
        $this->assertEquals(90, $testBoard4->totalSum());
        $this->assertTrue($testBoard4->checkWin('Eng'));
    }
}

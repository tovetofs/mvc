<?php

namespace App\Card;

class DeckOfCards
{
    /**
     * @var array<mixed>
     */
    public array $deck = [];

    /**
     * @var array<string>
     */
    private array $suits = array("clubs", "diamonds", "hearts", "spades");

    /**
     * @var array<string>
     */
    private array $ranks = array("A", "2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K");

    public function __construct()
    {
        foreach ($this->suits as $suit) {
            foreach ($this->ranks as $rank) {
                $card = new CardGraphic($suit, $rank);
                $this->deck[] = $card;
            }
        }
    }

    public function shuffleDeck(): void
    {
        shuffle($this->deck);
    }

    public function sortDeck(): void
    {
        sort($this->deck);
    }

    /**
    * @return array<mixed>
    */
    public function showDeck(): array
    {
        $values = [];
        foreach ($this->deck as $card) {
            $values[$card->displayCard()] = array("suit"=>$card->showSuit(), "rank"=>$card->showRank(),
                "value"=>$card->showValue());
        }
        return $values;
    }

    /**
    * @return array<mixed>
    */
    public function drawCards(int $numberCards = 1): array
    {
        $drawnCards = array_splice($this->deck, 0, $numberCards);
        return $drawnCards;
    }

    /**
    * @return array<mixed>
    */
    public function showJsonDeck(): array
    {
        $values = [];
        foreach ($this->deck as $card) {
            $values[] = array("suit"=>$card->showSuit(), "rank"=>$card->showRank());
        }
        return $values;
    }

    public function remainingCards(): int
    {
        return count($this->deck);
    }
}

<?php

namespace App\Card;

class CardHand
{
    /**
     * @var array<mixed>
     */
    private array $hand = [];

    /**
     * @param array<Card> $drawnCards
     */
    public function __construct(array $drawnCards)
    {
        foreach ($drawnCards as $card) {
            // $drawnCards as Card
            $this->hand[] = $card;
        }
    }

    public function add(Card $card): void
    {
        $this->hand[] = $card;
    }

    /**
    * @return array<mixed>
    */
    public function showHand(): array
    {
        $values = [];
        foreach ($this->hand as $card) {
            $values[$card->displayCard()] = array("suit"=>$card->showSuit(), "rank"=>$card->showRank());
        }
        return $values;
    }

    /**
    * @return array<mixed>
    */
    public function showJsonDeck(): array
    {
        $values = [];
        foreach ($this->hand as $card) {
            $values[] = array("suit"=>$card->showSuit(), "rank"=>$card->showRank());
        }
        return $values;
    }
}

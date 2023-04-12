<?php

namespace App\Card;

class CardHand
{
    private $hand = [];

    public function __construct(array $drawnCards)
    {
        foreach ($drawnCards as $card) {
            $this->hand[] = $card;
        }
    }

    public function add(Card $card): void
    {
        $this->hand[] = $card;
    }

    public function showHand(): array
    {
        $values = [];
        foreach ($this->hand as $card) {
            $values[$card->displayCard()] = array("suit"=>$card->showUTF(), "rank"=>$card->showRank(),
                "color"=>$card->getColor());
        }
        return $values;
    }

    public function showJsonDeck(): array
    {
        $values = [];
        foreach ($this->hand as $card) {
            $values[] = array("suit"=>$card->showSuit(), "rank"=>$card->showRank());
        }
        return $values;
    }
}

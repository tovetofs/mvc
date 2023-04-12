<?php

namespace App\Card;

class DeckOfCards
{
    private $deck = [];

    public function __construct()
    {
        $str = file_get_contents('json/cards.json');
        $json = json_decode($str, true);
        foreach ($json as $suit => $val) {
            foreach ($val as $rank => $utf) {
                $card = new Card($suit, $rank);
                $this->deck[] = $card;
            }
        }
    }

    public function shuffleDeck()
    {
        shuffle($this->deck);
    }

    public function sortDeck()
    {
        sort($this->deck);
    }

    public function showDeck(): array
    {
        $values = [];
        foreach ($this->deck as $card) {
            $values[$card->displayCard()] = array("suit"=>$card->showSuit(), "rank"=>$card->showRank(),
                "color"=>$card->getColor(), "value"=>$card->showValue());
        }
        return $values;
    }

    public function drawCards(int $numberCards = 1): array
    {
        $drawnCards = array_splice($this->deck, 0, $numberCards);
        return $drawnCards;
    }

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

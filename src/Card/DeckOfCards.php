<?php

namespace App\Card;

class DeckOfCards
{
    /**
     * @var array<mixed>
     */
    private array $deck = [];

    public function __construct()
    {
        $str = file_get_contents('json/cards.json');
        $json = json_decode($str, true);
        foreach ($json as $suit => $val) {
            $keys = array_keys($val);
            foreach ($keys as $key) {
                $rank = (string)$key;
                $card = new CardGraphic($suit, $rank);
                $this->deck[] = $card;
            }
            // foreach ($val as $rank => $utf) {
            //     $card = new Card($suit, $rank);
            //     $this->deck[] = $card;
            // }
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

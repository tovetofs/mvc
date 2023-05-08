<?php

namespace App\Card;

/**
 * Class representing a card hand
 */
class CardHand
{
    /**
     * Array containing the cards in the hand
     * @var array<mixed>
     */
    private array $hand = [];

    /**
     * Constructor, takes array of drawn cards as parameter
     * @param array<Card> $drawnCards
     */
    public function __construct(array $drawnCards)
    {
        foreach ($drawnCards as $card) {
            // $drawnCards as Card
            $this->hand[] = $card;
        }
    }

    /**
     * Adds a card to the hand
     */
    public function add(Card $card): void
    {
        $this->hand[] = $card;
    }

    /**
     * Displaying the hand as an array
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
     * Displaying the hand as an array
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

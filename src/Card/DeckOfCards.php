<?php

namespace App\Card;

/**
 * Class representing a deck of cards
 */
class DeckOfCards
{
    /**
     * Array containing the cards in the deck
     * @var array<mixed>
     */
    public array $deck = [];

    /**
     * Array with the different suits in a deck
     * @var array<string>
     */
    private array $suits = array("clubs", "diamonds", "hearts", "spades");

    /**
     * Array with the different ranks in a deck
     * @var array<string>
     */
    private array $ranks = array("A", "2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K");

    /**
     * Constructs a deck using the array of suits and array of ranks
     */
    public function __construct()
    {
        foreach ($this->suits as $suit) {
            foreach ($this->ranks as $rank) {
                $card = new CardGraphic($suit, $rank);
                $this->deck[] = $card;
            }
        }
    }

    /**
     * Shuffles the deck
     */
    public function shuffleDeck(): void
    {
        shuffle($this->deck);
    }

    /**
     * Sorts the deck according to suit and value
     */
    public function sortDeck(): void
    {
        sort($this->deck);
    }

    /**
     * Displaying the deck as an array
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
     * Draws a number of cards (default one card) from the deck
     * @return array<mixed>
     */
    public function drawCards(int $numberCards = 1): array
    {
        $drawnCards = array_splice($this->deck, 0, $numberCards);
        return $drawnCards;
    }

    /**
     * Displaying the deck as an array
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

    /**
     * Returns the number of remaining cards in the deck
     */
    public function remainingCards(): int
    {
        return count($this->deck);
    }
}

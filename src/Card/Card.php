<?php

namespace App\Card;

/**
 * Class representing a card
 */
class Card
{
    /**
     * The suit of the card
     */
    protected string $suit;

    /**
     * The value of the card
     */
    protected int $value;

    /**
     * The rank of the card
     */
    protected string $rank;

    /**
     * Constructor, takes suit and rank as arguments
     */
    public function __construct(string $suit, string $rank)
    {
        $this->suit = $suit;
        $this->rank = $rank;
        switch ($this->rank) {
            case 'A':
                $this->value = 1;
                break;
            case 'J':
                $this->value = 11;
                break;
            case 'Q':
                $this->value = 12;
                break;
            case 'K':
                $this->value = 13;
                break;
            default:
                $this->value = (int)$this->rank;
        }
    }

    /**
     * Displays the suit and rank of the card as a string
     */
    public function displayCard(): string
    {
        return $this->suit . $this->rank;
    }

    /**
     * Displays the suit of the card as a string
     */
    public function showSuit(): string
    {
        return $this->suit;
    }

    /**
     * Displays the rank of the card as a string
     */
    public function showRank(): string
    {
        return $this->rank;
    }

    /**
     * Displays the value of the card as an int
     */
    public function showValue(): int
    {
        return $this->value;
    }

    /**
     * Returns private variable suit
     */
    public function suit(): string
    {
        return $this->suit;
    }

    /**
     * Returns private variable rank
     */
    public function rank(): string
    {
        return $this->rank;
    }

    /**
     * Returns private variable value
     */
    public function value(): int
    {
        return $this->value;
    }
}

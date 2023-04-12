<?php

namespace App\Card;

class Card
{
    protected $suit;

    protected $value;

    protected $rank;

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
                $this->value = $this->rank;
        }
    }

    public function displayCard(): string
    {
        return $this->suit . $this->rank;
    }

    public function showSuit(): string
    {
        return $this->suit;
    }

    public function showRank(): string
    {
        return $this->rank;
    }

    public function showValue(): int
    {
        return $this->value;
    }

    public function getColor(): string
    {
        switch ($this->suit) {
            case 'spades':
                $this->color = 'black';
                break;
            case 'clubs':
                $this->color = 'black';
                break;
            case 'hearts':
                $this->color = 'red';
                break;
            case 'diamonds':
                $this->color = 'red';
                break;
        }
        return $this->color;
    }
}

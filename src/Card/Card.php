<?php

namespace App\Card;

class Card
{
    protected string $suit;

    protected int $value;

    protected string $rank;

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

    public function suit(): string
    {
        return $this->suit;
    }

    public function rank(): string
    {
        return $this->rank;
    }

    public function value(): int
    {
        return $this->value;
    }
}

<?php

namespace App\Card;

/**
 * Class representing a card graphic
 */
class CardGraphic extends Card
{
    /**
     * Array with utf8 codes for the different suits
     * @var array<mixed>
     */
    public static array $staticUTF = array("clubs"=>"&#9827", "diamonds"=>"&#9830",
        "hearts"=>"&#9829", "spades"=>"&#9824");

    /**
     * Displays the utf8-code for a given card
     */
    public function showUTF(): string
    {
        return self::$staticUTF[$this->suit];
    }
}

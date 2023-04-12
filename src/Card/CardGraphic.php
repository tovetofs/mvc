<?php

namespace App\Card;

class CardGraphic extends Card
{
    public static $staticUTF = array("clubs"=>"&#9827", "diamonds"=>"&#9830",
        "hearts"=>"&#9829", "spades"=>"&#9824");

    public function showUTF(): string
    {
        return self::$staticUTF[$this->suit];
    }
}

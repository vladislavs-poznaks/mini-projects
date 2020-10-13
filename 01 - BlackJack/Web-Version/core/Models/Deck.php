<?php

namespace Core\Models;

class Deck implements StorableInterface
{
    private $cards = [];
    private $suits = ['H', 'S', 'D', 'C'];
    private $values = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];

    public function __construct()
    {
        foreach ($this->suits as $suit) {
            foreach ($this->values as $value) {
                $this->cards[] = (new Card($suit, $value));
            }
        }
    }

    public function shuffle(): void
    {
        shuffle($this->cards);
    }

    public function getCard(): Card
    {
        return array_pop($this->cards);
    }
}

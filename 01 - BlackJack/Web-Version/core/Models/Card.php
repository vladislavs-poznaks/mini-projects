<?php

namespace Core\Models;

class Card
{
    private string $suit;
    private string $value;

    public function __construct(string $suit, string $value)
    {
        $this->suit = $suit;
        $this->value = $value;
    }

    public function name(): string
    {
        return $this->suit . $this->value;
    }

    public function getValue(): int
    {
        switch ($this->value) {
            case 'A':
                return 11;
            case 'K':
            case 'Q':
            case 'J':
                return 10;
            default:
                return ((int) $this->value);
        }
    }
}
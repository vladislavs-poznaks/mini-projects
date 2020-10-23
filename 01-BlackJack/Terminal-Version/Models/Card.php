<?php
class Card
{
    protected $suit;
    protected $value;

    public function __construct($suit, $value)
    {
        $this->suit = $suit;
        $this->value = $value;
    }

    public function show()
    {
        return $this->suit . $this->value;
    }

    public function getValue()
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
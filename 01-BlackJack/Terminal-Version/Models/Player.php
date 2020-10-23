<?php
class Player
{
    protected $cards = [];

    public function getHand(): string
    {
        $hand = '';
        foreach ($this->cards as $card) {
            $hand .= $card->show() . ' ';
        }
        return $hand;
    }

    public function isPlaying($playerScore) {
        if ($playerScore < 21) {
            return true;
        }
        return false;
    }

    public function takeCard(Card $card)
    {
        $this->cards[] = $card;
    }

    public function getScore(): int
    {
        $score = 0;
        $aces = 0;

        foreach ($this->cards as $card) {
            $score += $card->getValue();
            if ($card->getValue() === 11) {
                $aces++;
            }
        }

        while ($score > 21 && $aces > 0) {
            $score -= 10;
            $aces--;
        }

        return $score;
    }
}
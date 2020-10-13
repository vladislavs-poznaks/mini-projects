<?php
class Dealer extends Player
{
    public function getHiddenHand(): string
    {
        return $this->cards[0]->show() . ' **';
    }

    public function isPlaying($playerScore): bool
    {
        if ($playerScore >= 21) {
            return false;
        } elseif ($this->getScore() < $playerScore) {
            return true;
        } elseif ($this->getScore() === $playerScore && $this->getScore() < 17) {
            return true;
        } else {
            return false;
        }
    }
}
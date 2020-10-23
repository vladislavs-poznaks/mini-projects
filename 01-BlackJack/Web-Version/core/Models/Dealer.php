<?php

namespace Core\Models;

class Dealer extends Player
{
    public function isPlaying(?int $score = 0): bool
    {
        if ($score >= 21) {
            return false;
        } elseif ($this->getScore() < $score) {
            return true;
        } elseif ($this->getScore() === $score && $this->getScore() < 17) {
            return true;
        } else {
            return false;
        }
    }
}
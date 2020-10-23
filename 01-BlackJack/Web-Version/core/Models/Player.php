<?php

namespace Core\Models;

class Player implements StorableInterface
{
    private bool $isPlaying = true;
    private array $cards = [];

    /**
     * @return Card[]
     */
    public function getHand(): array
    {
        return $this->cards;
    }

    public function endTurn(): void
    {
        $this->isPlaying = false;
    }

    public function isPlaying(int $score = 0): bool
    {
        if ($this->getScore() < 21 && $this->isPlaying) {
            return true;
        }
        return false;
    }

    public function takeCard(Card $card): void
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

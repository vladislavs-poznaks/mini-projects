<?php

namespace Core\Models;

class Game implements StorableInterface
{
    private int $money = 100;
    private int $bet = 0;

    public function getMoney(): int
    {
        return $this->money;
    }

    public function setBet(int $bet): string
    {
        if ($bet <= $this->money) {
            $this->bet = $bet;
            $this->money -= $bet;
            return 'Your bet of ' . $this->bet . '$ is accepted!';
        } else {
            return 'You don\'t have enough money...';
        }
    }

    public function getBet(): int
    {
        return $this->bet;
    }

    public function win(): void
    {
        $this->bet *= 2;
        $this->money += $this->bet;
        $this->bet = 0;
    }

    public function loose(): void
    {
        $this->bet = 0;
    }

    public function push(): void
    {
        $this->money += $this->bet;
        $this->bet = 0;
    }
}
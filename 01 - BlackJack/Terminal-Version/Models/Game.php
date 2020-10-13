<?php
class Game
{
    private $money = 100;
    private $bet;

    public function getMoney(): int
    {
        return $this->money;
    }

    public function setBet(int $bet)
    {
        if ($bet <= $this->money) {
            $this->bet = $bet;
            $this->money -= $bet;
            return "Your bet of $$this->bet is accepted!";
        } else {
            return "Sorry, not enough money";
        }
    }

    public function win()
    {
        $this->bet *= 2;
        $this->money += $this->bet;
        $this->bet = 0;
    }

    public function loose()
    {
        $this->bet = 0;
    }

    public function push()
    {
        $this->money += $this->bet;
        $this->bet = 0;
    }
}
<?php

namespace Controllers;

use Core\Models\{Card, Deck, Player, Dealer, Game};
use Core\{App, File};

class GameController
{
    public function home($message = ''): void
    {
        $game = File::load('game');
        $player = File::load('player');
        $dealer = File::load('dealer');

        $cards = App::get('cards');

        require 'views/game.view.php';
    }

    public function bet()
    {
        if (ctype_digit($_POST['bet'])) {
            $message = App::setBet((int) $_POST['bet']);
        } else {
            $message = 'Please enter a valid number!';
        }

        $this->home($message);
    }

    public function hit()
    {
        if ($this->isRunning()) {
            $message = App::playerTurn();
        } else {
            $message = App::getResult();
        }

        $this->home($message);
    }

    public function stand()
    {
        $message = App::getResult();

        $this->home($message);
    }

    public function restart()
    {
        App::restartGame();

        $this->home();
    }

    public function reset()
    {
        App::resetGame();

        $this->home();
    }

    private function isRunning(): bool
    {
        $player = File::load('player');

        return $player->isPlaying();
    }
}
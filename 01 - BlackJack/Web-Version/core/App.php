<?php

namespace Core;

use Exception;
use Core\Models\{Deck, Player, Dealer, Game};

class App
{
    private static $registry = [];

    public static function bind($key, $value): void
    {
        static::$registry[$key] = $value;
    }

    public static function get($key)
    {
        if (array_key_exists($key, static::$registry)) {
            return static::$registry[$key];
        } else {
            throw new Exception("No $key found in App container.");
        }
    }

    public static function setBet(int $bet): string
    {
        $game = File::load('game');

        if ($game->getBet() === 0) {
            $message = $game->setBet($bet);
        } else {
            $message = 'Bet already set!';
        }

        File::store($game);

        return $message;
    }

    public static function playerTurn()
    {
        $message = '';

        $deck = File::load('deck');
        $player = File::load('player');

        if ($player->isPlaying()) {
            $player->takeCard($deck->getCard());
            //$message = 'Player\'s score is ' . $player->getScore() . '. ';
        }

        File::store($deck);
        File::store($player);

        if ($player->getScore() >= 21) {
            $message .= static::getResult();
        }

        return $message;
    }

    public static function getResult()
    {
        $game = File::load('game');
        $deck = File::load('deck');
        $player = File::load('player');
        $dealer = File::load('dealer');

        while ($dealer->isPlaying($player->getScore())) $dealer->takeCard($deck->getCard());

        if ($player->getScore() === 21) {
            $message = "BlackJack!";
            $game->win();
        } elseif ($player->getScore() > 21) {
            $message = "Player Busts!";
            $game->loose();
        } elseif ($dealer->getScore() > 21) {
            $message = "Dealer Busts! You Won!";
            $game->win();
        } elseif ($player->getScore() === $dealer->getScore()) {
            $message = "Push! No Winner...";
            $game->push();
        } elseif ($player->getScore() > $dealer->getScore()) {
            $message = "Congrats! You Won!";
            $game->win();
        } else {
            $message = "Sorry, You Lost!";
            $game->loose();
        }

        $player->endTurn();

        File::store($game);
        File::store($deck);
        File::store($player);
        File::store($dealer);

        return $message;
    }

    public static function restartGame()
    {
        $deck = new Deck();
        $deck->shuffle();

        $player = new Player();
        $dealer = new Dealer();

        for ($i = 0; $i < 2; $i++) {
            $player->takeCard($deck->getCard());
            $dealer->takeCard($deck->getCard());
        }

        File::store($deck);
        File::store($player);
        File::store($dealer);
    }

    public static function resetGame()
    {
        File::store(new Game());

        static::restartGame();
    }
}

<?php

require "bootstrap.php";

$game = new Game();

do {

    // New hand setup
    $deck = new Deck();
    $player = new Player();
    $dealer = new Dealer();

    $deck->shuffle();

    for ($i = 0; $i < 2; $i++) {
        $player->takeCard($deck->getCard());
        $dealer->takeCard($deck->getCard());
    }

    echo PHP_EOL;
    echo "---------------------" . PHP_EOL;
    echo "Welcome to BlackJack!" . PHP_EOL;
    echo "---------------------" . PHP_EOL;
    echo "---Payout is 2 : 1---" . PHP_EOL;
    echo "---------------------" . PHP_EOL;

    // Prompt to place bet
    echo "You have $ " . $game->getMoney() . PHP_EOL;
    do {
        $input = strtolower(readline("Your bet $(5, 10, 20, 50)? "));
    } while (! in_array($input, ['5', '10', '20', '50']) && $game->getMoney() > (int) $input);
    echo $game->setBet((int) $input) . PHP_EOL;
    echo "You have $ " . $game->getMoney() . PHP_EOL;

    // Play hand
    while ($player->isPlaying($player->getScore())) {

        // Show dealt hands
        echo "Dealer: " . $dealer->getHiddenHand() . " || Player: " . $player->getHand() . PHP_EOL;

        // Prompt to play hand
        do {
            $input = strtolower(readline("Hit or Stand? (H / S)"));
        } while (! in_array($input, ['hit', 'h', 'stand', 's']));

        if (in_array($input, ['h', 'hit'])) {
            $player->takeCard($deck->getCard());
        } else {
            break;
        }

    }

    while ($dealer->isPlaying($player->getScore())) $dealer->takeCard($deck->getCard());

    // Show result
    $result = PHP_EOL
        . "Dealer: " . $dealer->getHand() . " || Player: " . $player->getHand()
        . PHP_EOL
        . "Dealer: " . $dealer->getScore() . " || Player: " . $player->getScore()
        . PHP_EOL
        . PHP_EOL;

    if ($player->getScore() === 21) {
        $result .= "BlackJack!";
        $game->win();
    } elseif ($player->getScore() > 21) {
        $result .= "Player Busts!";
        $game->loose();
    } elseif ($dealer->getScore() > 21) {
        $result .= "Dealer Busts! You Won!";
        $game->win();
    } elseif ($player->getScore() === $dealer->getScore()) {
        $result .= "Push! No Winner...";
        $game->push();
    } elseif ($player->getScore() > $dealer->getScore()) {
        $result .= "Congrats! You Won!";
        $game->win();
    } else {
        $result .= "Sorry, You Lost!";
        $game->loose();
    }

    // Add new money result.
    $result .= PHP_EOL . "You have $ " . $game->getMoney() .PHP_EOL;
    echo $result . PHP_EOL;

    // Prompt to play again
    do {
        $input = strtolower(readline("Play again or quit? (A / Q)"));
    } while (! in_array($input, ['again', 'a', 'quit', 'q']));

    PHP_EOL;
} while (in_array($input, ['again', 'a']));

<?php require 'partials/header.view.php' ?>

<div class="game-container">

    <div class="title">
        <h1>BlackJack</h1>
    </div>

    <div class="money">
        <h2>Money  $<?= $game->getMoney() ?></h2>
    </div>

    <?php if ($game->getBet() === 0 && $player->isPlaying()) : ?>

        <div class="bet-button-a <?php if ($game->getMoney() < 5) echo 'disabled'?>">
            <form action="/bet" method="POST">
                <input type="hidden" name="bet" value="5">
                <button type="submit" <?php if ($game->getMoney() < 5) echo 'disabled'?>>Bet $5</button>
            </form>
        </div>

        <div class="bet-button-b <?php if ($game->getMoney() < 20) echo 'disabled'?>">
            <form action="/bet" method="POST">
                <input type="hidden" name="bet" value="20">
                <button type="submit" <?php if ($game->getMoney() < 20) echo 'disabled'?>>Bet $20</button>
            </form>
        </div>

        <div class="bet-button-c <?php if ($game->getMoney() < 50) echo 'disabled'?>">
            <form action="/bet" method="POST">
                <input type="hidden" name="bet" value="50">
                <button type="submit" <?php if ($game->getMoney() < 50) echo 'disabled'?>>Bet $50</button>
            </form>
        </div>

        <div class="bet-button-d">
            <form action="/bet" method="POST">
                <input type="hidden" name="bet" value="<?= $game->getMoney() ?>">
                <button type="submit">Bet $<?= $game->getMoney() ?></button>
            </form>
        </div>


    <?php else : ?>

    <div class="bet-message">
        <h3><?= $message ?></h3>
    </div>

    <?php endif; ?>

    <div class="dealer">
        <?php if ($game->getBet() > 0 || ! $player->isPlaying()) : ?>
                <h3>Dealer Cards</h3>
                <div>
                    <?php
                    $count = 1;
                    foreach ($dealer->getHand() as $card) : ?>

                        <img
                            <?php if ($player->isPlaying()) : ?>
                                src="<?= $cards
                                . ($count !== count($dealer->getHand()) ? '00' : $card->name()) ?>.png"
                            <?php elseif (! $player->isPlaying()) : ?>
                                src="<?= $cards . $card->name() ?>.png"
                            <?php endif; ?>
                                alt="Dealer Card"
                        >

                        <?php
                        $count++;
                    endforeach; ?>
                </div>
        <?php endif; ?>
    </div>

    <div class="player">
        <?php if ($game->getBet() > 0 || ! $player->isPlaying()) : ?>
            <div>
                <h3>Player Cards</h3>
                <div>
                    <?php foreach ($player->getHand() as $card) : ?>

                        <img
                                src="<?= $cards . $card->name() ?>.png"
                                alt="Dealer Card"
                        >

                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <?php if ($game->getBet() > 0) : ?>

    <div class="hit-button">
        <form method="POST" action="/hit">
            <button type="submit">Hit!</button>
        </form>
    </div>
    <div class="stand-button">
        <form method="POST" action="/stand">
            <button type="submit">Stand!</button>
        </form>
    </div>

    <?php endif; ?>

    <div class="game-end-controls">
        <?php if ($game->getMoney() > 0 && ! $player->isPlaying()) : ?>
            <div>
                <form method="POST" action="/restart">
                    <button type="submit">Play again!</button>
                </form>
            </div>
        <?php endif; ?>

        <?php if ($game->getMoney() === 0 && ! $player->isPlaying()) : ?>
            <div>
                <form method="POST" action="/reset">
                    <button type="submit">Reset Game!</button>
                </form>
            </div>
        <?php endif; ?>
    </div>

    <?php include 'partials/_dealer.view.php' ?>

    <?php include 'partials/_player.view.php' ?>

    <?php include 'partials/_controls.view.php' ?>


</div>

<?php require 'partials/footer.view.php' ?>
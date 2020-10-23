<?php

use Core\{App, File};

App::bind('cards', 'https://raw.githubusercontent.com/vladislavs-poznaks/storage/main/CARDS/images/');

if (! File::fileExists('game')) {
    App::resetGame();
}

if (! File::fileExists('deck')
    || ! File::fileExists('player')
    || ! File::fileExists('dealer')) {

    App::restartGame();
}

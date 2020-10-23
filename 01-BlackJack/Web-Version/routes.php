<?php

$router->get('', 'Controllers\GameController@home');
$router->get('bet', 'Controllers\GameController@home');
$router->get('hit', 'Controllers\GameController@home');
$router->get('stand', 'Controllers\GameController@home');
$router->get('restart', 'Controllers\GameController@home');
$router->get('reset', 'Controllers\GameController@home');

$router->post('bet', 'Controllers\GameController@bet');
$router->post('hit', 'Controllers\GameController@hit');
$router->post('stand', 'Controllers\GameController@stand');
$router->post('restart', 'Controllers\GameController@restart');
$router->post('reset', 'Controllers\GameController@reset');

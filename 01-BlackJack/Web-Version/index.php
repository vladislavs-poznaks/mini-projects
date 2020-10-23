<?php

require 'vendor/autoload.php';
require 'bootstrap.php';

use Core\{Request, Router};

$router = new Router();
require 'routes.php';

$router->direct(Request::type(), Request::uri());

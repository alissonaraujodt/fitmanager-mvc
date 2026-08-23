<?php

session_start();

require_once '../app/config/config.php';
require_once '../app/core/Controller.php';
require_once '../app/core/Router.php';

// Controllers
require_once '../app/controllers/HomeController.php';
require_once '../app/controllers/AuthController.php';
require_once '../app/controllers/AlunoController.php';

$router = new Router();
$router->run();

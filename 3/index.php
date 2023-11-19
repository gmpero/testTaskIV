<?php
// Перед продакшином необходимо скрыть ошибки
// error_reporting(E_ERROR | E_PARSE);

session_start();

require_once 'app/models/Database.php';
require_once 'app/models/Comment.php';
require_once 'app/controllers/CommentsController.php';

require_once 'app/Router.php';

$router = new Router();
$router->run();
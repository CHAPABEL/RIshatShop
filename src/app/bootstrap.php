<?php
// Автозагрузка и запуск приложения
session_start();
mb_internal_encoding('UTF-8');

require_once __DIR__ . '/Helpers/functions.php';
require_once __DIR__ . '/Core/Router.php';
require_once __DIR__ . '/Core/Controller.php';
require_once __DIR__ . '/Core/Model.php';
require_once __DIR__ . '/Core/View.php';

// Настройки подключения к БД
require_once __DIR__ . '/config.php';

// Запуск роутера
$router = new Router();
$router->dispatch($_SERVER['REQUEST_URI']);

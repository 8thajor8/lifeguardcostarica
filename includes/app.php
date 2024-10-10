<?php

use Model\ActiveRecord;
require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();
require 'funciones.php';
require 'config/database.php';
date_default_timezone_set('America/Costa_Rica');

$db = conectarDB();



ActiveRecord::setDB($db);
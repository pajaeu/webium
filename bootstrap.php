<?php

use DI\ContainerBuilder;
use Dotenv\Dotenv;

const ROOT_DIR = __DIR__;
const APP_DIR = __DIR__ . '/app';
const CONFIG_DIR = __DIR__ . '/config';
const LOG_DIR = __DIR__ . '/logs';
const PUBLIC_DIR = __DIR__ . '/public';

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(ROOT_DIR);
$dotenv->load();

$containerBuilder = new ContainerBuilder();
$containerBuilder->useAttributes(true);

$dependencies = require CONFIG_DIR . '/dependencies.php';
$dependencies($containerBuilder);

return $containerBuilder->build();
<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMSetup;
use Latte\Engine;
use Latte\Loaders\FileLoader;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\App;
use Slim\Factory\AppFactory;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        App::class => function (ContainerInterface $container) {
            AppFactory::setContainer($container);

            $middleware = require CONFIG_DIR . '/middleware.php';
            $routes = require CONFIG_DIR . '/routes.php';

            $app = AppFactory::create();

            $routes($app);

            $middleware($app);

            return $app;
        },
        EntityManagerInterface::class => function () {
            $config = ORMSetup::createAttributeMetadataConfiguration(
                paths: [
                    APP_DIR . '/Entity',
                ],
                isDevMode: true,
            );

            return new EntityManager(
                DriverManager::getConnection([
                    'driver' => $_ENV['DB_DRIVER'] ?? 'pdo_mysql',
                    'host' => $_ENV['DB_HOST'] ?? 'localhost',
                    'port' => $_ENV['DB_PORT'] ?? 3306,
                    'dbname' => $_ENV['DB_NAME'],
                    'user' => $_ENV['DB_USER'],
                    'password' => $_ENV['DB_PASS'],
                ]), $config
            );
        },
        ResponseFactoryInterface::class => fn(App $app) => $app->getResponseFactory(),
        Engine::class => function () {
            $latte = new Engine();
            $latte->setLoader(loader: new FileLoader(ROOT_DIR . $_ENV['TEMPLATE_DIR']));
            $latte->setTempDirectory(ROOT_DIR . $_ENV['TEMPLATE_CACHE_DIR']);

            return $latte;
        },
    ]);
};

<?php

use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;
use Slim\Views\Twig;

$definitions = [

    'settings' => function (): array {
        return require 'settings.php';
    },

    Twig::class => function (ContainerInterface $container): Twig {
        /** @var array<string, array<string, mixed>> $settings */
        $settings = $container->get('settings');

        $options = [
            'debug' => $settings['app']['debug'],
            'cache' => $settings['view']['cache'],
        ];

        /** @var string $path */
        $path = $settings['view']['path'];

        $twig = Twig::create($path, $options);

        $twig->getEnvironment()->addFunction(new \Twig\TwigFunction('assets', function (string $filePath = ''): string {
            if (!is_string($filePath)) {
                return "";
            }

            global $settings;
            $path = $settings['app']['path'];

            $assetsFolderPath = $path . '/public/assets';
            return $assetsFolderPath . '/' . $filePath;
        }));

        return $twig;
    },

    PDO::class => function (ContainerInterface $container): PDO {
        $settings = $container->get('settings');

        $schema = $settings['database']['engine'] . ":" .
            ($settings['database']['path'] == ""  ?
                "dbname=" . $settings['database']['name'] . ";host=" . $settings['database']['host'] . ";charset=utf8" :
                __DIR__ . "/../" . $settings['database']['path']);

        try {
            $connection = new PDO($schema, $settings['database']['user'], $settings['database']['password']);
        } catch (\PDOException $th) {
            $envExamplePath = realpath(__DIR__ . '/../.env.example');
            $envExamplePath = !$envExamplePath ? '.env.example' : $envExamplePath;
            die("DATABASE ERROR: Check the database environment in your \".env\" file based on \"$envExamplePath\" configuration file in your project root");
        }

        return $connection;
    },

];

return (new ContainerBuilder())->addDefinitions($definitions)->build();

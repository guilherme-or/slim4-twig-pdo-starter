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

        $db = $settings['database'];
        $schema = "mysql:dbname=" . $db['name'] . ";host=" . $db['host'] . ";charset=utf8";

        $connection = new PDO($schema, $db['user'], $db['password']);

        return $connection;
    },

];

return (new ContainerBuilder())->addDefinitions($definitions)->build();

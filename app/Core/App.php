<?php

namespace App\Core;

use Psr\Log\LoggerInterface;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class App
{
    private static array $container = [];

    public static function bind(string $key, $value): void
    {
        self::$container[$key] = $value;
    }

    public static function resolve(string $key)
    {
        if (!isset(self::$container[$key])) {
            if ($key === LoggerInterface::class) {
                $logger = new Logger('app');
                $logger->pushHandler(new StreamHandler(__DIR__ . '/../../storage/logs/app.log', Logger::DEBUG));
                self::$container[$key] = $logger;
                return $logger;
            }

            self::$container[$key] = new $key();
        }

        return self::$container[$key];
    }
}

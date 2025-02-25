<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/config.php';

use App\Core\App;
use App\Core\Router;
use App\Exceptions\NotFoundException;
use Psr\Log\LoggerInterface;

session_start();

// Регистрируем Router в DI контейнере.
App::bind(Router::class, new Router());

// Регистрируем Logger в DI контейнере.
$logger = new \Monolog\Logger('app');
$logger->pushHandler(new \Monolog\Handler\StreamHandler(__DIR__ . '/../storage/logs/app.log', \Monolog\Logger::DEBUG));
App::bind(LoggerInterface::class, $logger);

try {
    // Разрешаем зависимости через DI контейнер.
    $router = App::resolve(Router::class);
    $router->resolve($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
} catch (NotFoundException $e) {
    http_response_code(404);
    $logger->warning("404 Not Found: " . $e->getMessage());
    echo "404 Not Found: " . $e->getMessage(); // Отправка ответа на клиент.
} catch (\Exception $e) {
    http_response_code(500);
    $logger->error("500 Internal Server Error: " . $e->getMessage(), ['exception' => $e]);
    echo "500 Internal Server Error"; // Отправка ответа на клиент.
}

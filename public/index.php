<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/config.php';

use App\Core\App;
use App\Core\Router;
use App\Exceptions\NotFoundException;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

session_start();

App::bind(Router::class, new Router());

$logger = new Logger('app');
$logger->pushHandler(new StreamHandler(__DIR__ . '/../storage/logs/app.log', Logger::DEBUG));
App::bind(LoggerInterface::class, $logger);

try {
    $router = App::resolve(Router::class);
    $router->resolve($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
} catch (NotFoundException $e) {
    http_response_code(404);
    $logger->warning("404 Not Found: " . $e->getMessage());
    echo "404 Not Found: " . $e->getMessage();
} catch (\Exception $e) {
    http_response_code(500);
    $logger->error("500 Internal Server Error: " . $e->getMessage(), [
        'exception' => $e,
        'stack' => $e->getTraceAsString()
    ]);
    echo "500 Internal Server Error";
}

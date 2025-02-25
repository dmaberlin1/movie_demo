<?php

namespace App\Core;

use App\Exceptions\NotFoundException;
use App\Exceptions\RuntimeException;

class Router
{
    private array $routes = [];

    public function __construct()
    {
    }

    public function loadRoutes(): void
    {
        require __DIR__ . '/../../routes/web.php';
    }

    public function get(string $uri, array $action): void
    {
        $this->routes['GET'][$uri] = $action;
    }

    public function post(string $uri, array $action): void
    {
        $this->routes['POST'][$uri] = $action;
    }

    public function put(string $uri, array $action): void
    {
        $this->routes['PUT'][$uri] = $action;
    }

    public function delete(string $uri, array $action): void
    {
        $this->routes['DELETE'][$uri] = $action;
    }

    public function resolve(string $requestUri, string $requestMethod)
    {
        $uri = parse_url($requestUri, PHP_URL_PATH);
        $method = strtoupper($requestMethod);

        if (!isset($this->routes[$method])) {
            throw new NotFoundException("Method {$method} is not supported");
        }

        $route = $this->findRoute($uri, $method);
        if (!$route) {
            throw new NotFoundException("Route {$method} {$uri} not found");
        }

        [$controller, $action] = $route;

        if (!class_exists($controller)) {
            throw new RuntimeException("Controller {$controller} not found");
        }

        if (!method_exists($controller, $action)) {
            throw new RuntimeException("Method {$action} not found in {$controller}");
        }

        $controllerInstance = App::resolve($controller);

        $params = $this->extractParams($uri, $route[0]);

        $controllerInstance->$action(...$params);
    }

    private function findRoute(string $uri, string $method): ?array
    {
        foreach ($this->routes[$method] as $routeUri => $action) {
            if ($this->matchRoute($uri, $routeUri)) {
                return $action;
            }
        }

        return null;
    }

    private function matchRoute(string $uri, string $routeUri): bool
    {
        $pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([^/]+)', $routeUri);
        return preg_match("~^$pattern$~", $uri);
    }

    private function extractParams(string $routeUri, string $requestUri): array
    {
        preg_match("~^" . preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[^/]+)', $routeUri) . "$~", $requestUri, $matches);

        return array_values(array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY));
    }
}

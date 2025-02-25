<?php

namespace App\Core;


class Router
{
    private array $routes = [];

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

        if (!isset($this->routes[$method][$uri])) {
            http_response_code(404);
            echo "404 Not Found";
            return;
        }

        [$controller, $method] = $this->routes[$method][$uri];
        if (class_exists($controller) && method_exists($controller, $method)) {
            $controllerInstance = new $controller();
            $controllerInstance->$method();
        } else {
            http_response_code(500);
            echo "Controller or method not found!";
        }
    }
}

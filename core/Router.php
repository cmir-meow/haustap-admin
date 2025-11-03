<?php
namespace Core;

final class Router {
    private array $routes = ['GET' => [], 'POST' => []];

    public function get(string $path, callable $handler): void { $this->routes['GET'][$path] = $handler; }
    public function post(string $path, callable $handler): void { $this->routes['POST'][$path] = $handler; }

    public function dispatch(string $uri, string $method): bool {
        $path = parse_url($uri, PHP_URL_PATH) ?: '/';
        if (isset($this->routes[$method][$path])) {
            ($this->routes[$method][$path])();
            return true;
        }
        return false;
    }
}
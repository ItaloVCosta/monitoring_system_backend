<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Access-Control-Allow-Credentials: true");

require_once __DIR__ . '/../vendor/autoload.php';
$routes = require_once __DIR__ . '/../routes/api.php';


$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
$uri = trim($uri, '/');

function matchRoute( $route, $uri) {
    $route = trim($route, '/');
    $routeParts = explode('/', $route);
    $uriParts = explode('/', $uri);

    if (count($routeParts) !== count($uriParts)) {
        return false;
    }

    $params = [];
    foreach ($routeParts as $key => $part) {

        if (strpos($part, '{') === 0 && strpos($part, '}') === strlen($part) - 1) {
            $paramName = trim($part, '{}');
            $params[$paramName] = $uriParts[$key];
        } elseif ($routeParts[$key] !== $uriParts[$key]) {
            return false;
        }
    }

    return $params;
}

if ($method === 'OPTIONS') {
    http_response_code(204); 
    exit();
}

if (isset($routes[$method])) {
    $matched = false;
    
    foreach ($routes[$method] as $route => $handler) {

        $params = matchRoute($route, $uri);

        if ($params !== false) {
            [$controller, $method] = $handler;

            if (class_exists($controller) && method_exists($controller, $method)) {
                $instance = new $controller();
                $instance->$method(...$params);
                $matched = true;
                break;
            }
        }
    }

    if (!$matched) {
        http_response_code(404);
        echo json_encode([__('words.error') => __('messages.http.error.404.route')]);
    }
} else {
    http_response_code(405);
    echo json_encode([__('words.error') => __('messages.http.error.405')]);
}

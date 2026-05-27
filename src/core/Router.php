<?php

namespace Core;

class Router {
    protected $routes = [];

    public function add($route, $controllerAction) {
        $this->routes[$route] = $controllerAction;
    }

    public function dispatch($url) {
        $url = '/' . trim($url, '/');
        
        if (array_key_exists($url, $this->routes)) {
            $controllerAction = $this->routes[$url];
            list($controller, $action) = explode('@', $controllerAction);
            
            $controllerFile = dirname(__DIR__) . '/controllers/' . $controller . '.php';
            if (!file_exists($controllerFile)) {
                $controllerFile = dirname(__DIR__) . '/controllers/admin/' . $controller . '.php';
            }
            
            if (file_exists($controllerFile)) {
                require_once $controllerFile;
                
                // Remove namespace/dir prefix to just get the class name
                $controllerParts = explode('/', $controller);
                $controllerClass = end($controllerParts);
                
                $controllerObj = new $controllerClass();
                if (method_exists($controllerObj, $action)) {
                    $controllerObj->$action();
                } else {
                    echo "Action $action not found in controller $controller.";
                }
            } else {
                echo "Controller file $controllerFile not found.";
            }
        } else {
            // Very simple 404
            http_response_code(404);
            echo "404 Not Found";
        }
    }
}

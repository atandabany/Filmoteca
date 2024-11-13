<?php

namespace App\Core;

class Router
{
    public function route(){
        
        $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

        $parts = explode('/', $uri);
        $route = $parts[0] ?? null;
        $action = $parts[1] ?? null;

        $queryParams = $_GET;

        $routes = [
            'films' => 'FilmController',
            'contact' => 'ContactController',
        ];

        if (array_key_exists($route, $routes)){
            $controllerName = 'App\\Controller\\' . $routes[$route];
            if (!class_exists($controllerName)){
                echo "Controller '$controllerName' not found";
                return;
            }

            $controller = new $controllerName();

            if (method_exists($controller,$action)){
                $queryParams = $_GET;
                $controller->$action($queryParams);
            } else {
                echo "Action '$action' not found in $controllerName"; 
            }
        } else {
            echo "404 not found";
        }
    }
}
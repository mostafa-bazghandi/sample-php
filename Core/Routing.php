<?php

namespace Core;

use Core\Request;

class Routing
{
    protected array $routes = [];
    private Request $request;
    public function __construct()
    {
        $this->request = new Request();
    }
    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }
    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }
    public function getRouteMap($method): array
    {
        return $this->routes[$method] ?? [];
    }
    public function getCallback()
    {
        $method = $this->request->method();
        $url = $this->request->geturi();
        //     Trim slashes
        $url = trim($url, '/');

        //     Get all routes for current request method
        $routes = $this->getRouteMap($method);

        $routeParams = false;

        //     Start iterating registed routes
        foreach ($routes as $route => $callback) {
            // Trim slashes
            $route = trim($route, '/');
            $routeNames = [];

            if (!$route) {
                continue;
            }

            // Find all route names from route and save in $routeNames
            if (preg_match_all('/\{(\w+)(:[^}]+)?}/', $route, $matches)) {
                $routeNames = $matches[1];
            }

            // // Convert route name into regex pattern
            $routeRegex = "@^" . preg_replace_callback('/\{\w+(:([^}]+))?}/', fn ($m) => isset($m[2]) ? "({$m[2]})" : '(\w+)', $route) . "$@";

            // Test and match current route against $routeRegex
            if (preg_match_all($routeRegex, $url, $valueMatches)) {
                $values = [];
                for ($i = 1; $i < count($valueMatches); $i++) {
                    $values[] = $valueMatches[$i][0];
                }
                $routeParams = array_combine($routeNames, $values);


                $this->request->setRouteParams($routeParams);
                return $callback;
            }
        }

        return false;
    }


    public function check()
    {
        $method = $this->request->method();
        $path = $this->request->geturi();
        $callback = $this->routes[$method][$path] ?? false;
        if (!$callback) {
            $callback = $this->getCallback();

            if ($callback === false) {
                http_response_code(404);
                $this->error404('_404');
            }
        }
        if (is_array($callback)) {
            $callback[0] = new $callback[0]();
        }
        return call_user_func($callback,(array) $this->request);
    }
    public function renderview($view, $data,$data1)
    {
        $view = str_replace(".", "/", $view);
        include(Config::$BASE_PATH . "/App/View/$view.php");
    }
    public function error404($view)
    {
        include(Config::$BASE_PATH . "/App/View/app/$view.php");
    }
}

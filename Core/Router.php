<?php

use Middleware\Middleware;

class Router
{

    protected $routes = [];

    public function addRoute($url,$controller,$method)
    {
        $this->routes[] = [
            'url' => $url,
            'controller' => $controller,
            'method' => $method,
            'middleware'=> null,
        ];
        return $this;
    }

    public function get($url, $controller)
    {
        return $this->addRoute($url, $controller, 'GET');
    }

    public function post($url, $controller)
    {
        return $this->addRoute($url, $controller, 'POST');
    }

    public function patch($url, $controller)
    {
        return $this->addRoute($url, $controller, 'PATCH');
    }

    public function delete($url, $controller)
    {
       return $this->addRoute($url, $controller, 'DELETE');
    }

    public function only($key) {
       $this->routes[array_key_last($this->routes)]['middleware']= $key;
    }

    public function route(String $url,String $method)
    {
        foreach ($this->routes as $route) {
            if ($url === $route['url'] && strtoUpper($method) === $route['method']) {

                // if ($route['middleware'] == 'guest') {
                //    (new Guest)->handle();                }

                // if($route['middleware'] == 'auth') {
                //    (new Auth)->handle();                }

                //rewritten as
                    Middleware::resolve($route['middleware']);

                return require base_path($route['controller']);
            }
        }
        abort();
    }

    public static function redirect(String $path)
    {
        header($path);
        exit();
    }
}

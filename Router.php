<?php

class Router {
    public array $methods = array("GET", "POST");
    public array $routes = array();
    public string $method;
    public string $request;

    function __construct() {
        $this->request = $_SERVER['REQUEST_URI'];
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    function __call($method, $args) {
        $method = strtoupper($method);
        if ($method != $this->method) return;
        $key = array_search($method, $this->methods);
        if ($key > -1) { // HTTP Method exists
            list($route, $fn) = $args;
            $this->routes[$this->format($route)] = $fn;
        } else {
            echo "HTTP Method not Allowed: " . $method . "\n";
        }
    }

    public function get(string $uri, $method) : void {
        $uri = $this->format($uri);
        $this ->routes[$uri] = $method;
    }

    private function format($uri) : string {
        $uri = rtrim(strtolower($uri), "/");
        if ($uri === '') $uri = "/";
        return $uri;
    }

    function __destruct() {
        $r = $this->format($this->request);
        if (array_key_exists($r, $this->routes)) $this->routes[$r]->call($this);
    }
}
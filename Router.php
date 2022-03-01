<?php

class Router {
    public string $request;
    public array $routes = [];

    function __construct() {
        $this->request = $_SERVER['REQUEST_URI'];
    }

    public function get(string $uri, $method) : void {
        $uri = $this->format($uri);
        $this ->routes[$uri] = $method;
    }

    private function format($uri) : string {
        return rtrim(strtolower($uri), "/");
    }

    function __destruct() {
        $r = $this->format($this->request);
        if (array_key_exists($r, $this->routes)) $this->routes[$r]->call($this);
    }
}
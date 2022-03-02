<?php

class Router {
    private array $methods = array("GET", "POST");
    private array $routes = array();
    private string $method;
    private string $request;

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
            $this->routes[$this->formatURI($route)] = $fn;
        } else {
            echo "HTTP Method not Allowed: " . $method . "\n";
        }
    }

    public static function formatURI(string $uri) : string {
        if (str_contains($uri, "?")) $uri = explode($uri, "?")[0]; // Strip out parameters
        $uri = rtrim(strtolower($uri), "/");
        if ($uri === "" || $uri === "?") $uri = "/";
        return $uri;
    }

    function __destruct() {
        $r = $this->formatURI($this->request);
        if (array_key_exists($r, $this->routes)) {
            $this->routes[$r]->call($this);
        } else $this->routes["*"]->call($this);
    }
}
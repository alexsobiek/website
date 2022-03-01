<?php

include_once("./Router.php");

$router = new Router();

$router->get("/", function() {
    echo "Homepage";
});

$router->get("/page2", function() {
    echo "Page 2";
});
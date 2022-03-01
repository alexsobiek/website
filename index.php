<?php

include_once("./Router.php");
include_once("./Page.php");

$router = new Router();

$router->get("/", function() {
    Page::get("home");
});

$router->post("/", function() {
    echo "POST";
});

$router->get("*", function() {
    echo "404";
});
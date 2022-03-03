<?php

include_once("./Router.php");
include_once("./Page.php");

$router = new Router();

$router->get("/", function() {
    $page = new Page("home");
    $page->addCSS("terminal.css");
    $page->addJS("terminal.js");
    $page->render();
});

$router->post("/", function() {
    echo "POST";
});

$router->get("*", function() {
    Page::get("404");
});
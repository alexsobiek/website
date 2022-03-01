<?php
include_once("./Router.php");
class Page {
    private string $path;

    function __construct(string $path) {
        $this->path = __DIR__ . "/views/" . $path . ".php";
    }

    public static function get(string $path) : void {
       $page = new Page($path);
       $page->render();
    }

    public function render() : void {
        $page = $this;
        if (isset($_GET["partial"]) && $_GET["partial"] == "true") $this->getContent();
        else require(__DIR__ . "/views/template.php");
    }

    public function getContent() : void {
        require($this->path);
        echo "\n";
    }
}
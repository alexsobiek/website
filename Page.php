<?php
include_once("./Router.php");
class Page {
    private string $path;
    public array $css = array();
    public array $javascript = array();

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

    public function addCSS(string $path) : void {
        $this->css[] = $path;
    }

    public function addJS(string $path) : void {
        $this->javascript[] = $path;
    }

    public function getBaseURL() : string {
        $port = '';
        if (!in_array($_SERVER['SERVER_PORT'], [80, 443])) {
            $port = ":$_SERVER[SERVER_PORT]";
        }
        return "//".$_SERVER['SERVER_NAME'].$port;
    }
}
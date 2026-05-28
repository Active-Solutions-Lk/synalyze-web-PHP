<?php

class DocsController {
    public function index() {
        $pageTitle = "Documentation - Synalyze";
        
        ob_start();
        require dirname(__DIR__) . '/views/pages/docs.php';
        $content = ob_get_clean();
        
        require dirname(__DIR__) . '/views/layouts/main.php';
    }
}

<?php

class LegalController {
    public function terms() {
        $pageTitle = "Terms of Use - Synalyze";
        
        ob_start();
        require dirname(__DIR__) . '/views/pages/terms.php';
        $content = ob_get_clean();
        
        require dirname(__DIR__) . '/views/layouts/main.php';
    }

    public function privacy() {
        $pageTitle = "Privacy Policy - Synalyze";
        
        ob_start();
        require dirname(__DIR__) . '/views/pages/privacy.php';
        $content = ob_get_clean();
        
        require dirname(__DIR__) . '/views/layouts/main.php';
    }
}

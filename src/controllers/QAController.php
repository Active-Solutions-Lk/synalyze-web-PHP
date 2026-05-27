<?php
require_once dirname(__DIR__) . '/models/FaqModel.php';

class QAController {
    public function index() {
        $model = new FaqModel();
        $categories = $model->getFaqCategories();
        
        $pageTitle = "FAQ - Synalyze";
        
        ob_start();
        require dirname(__DIR__) . '/views/pages/qa.php';
        $content = ob_get_clean();
        
        require dirname(__DIR__) . '/views/layouts/main.php';
    }
}

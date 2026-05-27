<?php
require_once dirname(__DIR__) . '/models/AboutModel.php';

class AboutController {
    public function index() {
        $model = new AboutModel();
        $pageData = $model->getAboutPageData();
        $whatWeDoCards = $model->getWhatWeDoCards();
        $whyChooseUsItems = $model->getWhyChooseUsItems();
        
        $pageTitle = "About - Synalyze";
        
        ob_start();
        require dirname(__DIR__) . '/views/pages/about.php';
        $content = ob_get_clean();
        
        require dirname(__DIR__) . '/views/layouts/main.php';
    }
}

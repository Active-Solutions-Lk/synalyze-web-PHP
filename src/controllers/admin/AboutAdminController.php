<?php
require_once dirname(__DIR__, 2) . '/models/AboutModel.php';

class AboutAdminController {
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['admin'])) {
            header("Location: " . baseUrl('/admin/login'));
            exit;
        }
    }

    public function index() {
        $model = new AboutModel();
        $pageData = $model->getAboutPageData();
        $whatWeDoCards = $model->getWhatWeDoCards();
        $whyChooseUsItems = $model->getWhyChooseUsItems();
        
        $pageTitle = "About Page - Admin";
        
        ob_start();
        require dirname(__DIR__, 2) . '/views/admin/about.php';
        $content = ob_get_clean();
        
        require dirname(__DIR__, 2) . '/views/layouts/admin.php';
    }

    public function updateHero() {
        $pdo = \Core\Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("UPDATE AboutPage SET heroHeadline=?, heroSubheadline=?, heroButtonText=?, whoWeAreTitle=?, whoWeAreDescription=?, whatWeDoTitle=?, whatWeDoDescription=?, whyChooseUsTitle=?, missionTitle=?, missionDescription=?, visionTitle=?, visionDescription=? WHERE id=1");
        $stmt->execute([
            $_POST['heroHeadline'], $_POST['heroSubheadline'], $_POST['heroButtonText'], 
            $_POST['whoWeAreTitle'], $_POST['whoWeAreDescription'], $_POST['whatWeDoTitle'], 
            $_POST['whatWeDoDescription'], $_POST['whyChooseUsTitle'], $_POST['missionTitle'], 
            $_POST['missionDescription'], $_POST['visionTitle'], $_POST['visionDescription']
        ]);
        $this->redirectSuccess("About page content updated.");
    }

    public function createCard() {
        $pdo = \Core\Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("INSERT INTO AboutWhatWeDoCard (iconName, title, description) VALUES (?, ?, ?)");
        $stmt->execute([$_POST['iconName'], $_POST['title'], $_POST['description']]);
        $this->redirectSuccess("Card added.");
    }

    public function deleteCard() {
        $pdo = \Core\Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("DELETE FROM AboutWhatWeDoCard WHERE id = ?");
        $stmt->execute([$_POST['id']]);
        $this->redirectSuccess("Card deleted.");
    }

    public function createWhyItem() {
        $pdo = \Core\Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("INSERT INTO AboutWhyChooseUsItem (title, description) VALUES (?, ?)");
        $stmt->execute([$_POST['title'], $_POST['description']]);
        $this->redirectSuccess("Item added.");
    }

    public function deleteWhyItem() {
        $pdo = \Core\Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("DELETE FROM AboutWhyChooseUsItem WHERE id = ?");
        $stmt->execute([$_POST['id']]);
        $this->redirectSuccess("Item deleted.");
    }

    public function updateCard() {
        $pdo = \Core\Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("UPDATE AboutWhatWeDoCard SET iconName=?, title=?, description=? WHERE id=?");
        $stmt->execute([$_POST['iconName'], $_POST['title'], $_POST['description'], $_POST['id']]);
        $this->redirectSuccess("Card updated.");
    }

    public function updateWhyItem() {
        $pdo = \Core\Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("UPDATE AboutWhyChooseUsItem SET title=?, description=? WHERE id=?");
        $stmt->execute([$_POST['title'], $_POST['description'], $_POST['id']]);
        $this->redirectSuccess("Item updated.");
    }

    private function redirectSuccess($msg) {
        session_start();
        $_SESSION['success'] = $msg;
        header("Location: " . baseUrl('/admin/about'));
        exit;
    }
}

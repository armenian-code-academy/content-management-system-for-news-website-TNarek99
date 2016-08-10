<?php

require_once NEWS_ADMIN_ROOT . '../core/Model/NewsTable.php';
require_once NEWS_ADMIN_ROOT . '../core/classes/View.php';
require_once NEWS_ADMIN_ROOT . '../core/classes/Pagination.php';

class NewsController
{
    public function listAction()
    {
        $newsTable = new NewsTable();
        $newsCount = $newsTable->getNewsCount();
        $pagination = new Pagination($newsCount, 'controller=news&action=list');
        
        $news = $newsTable->getNews(Pagination::ITEMS_PER_PAGE, $pagination->getOffset());

        $view = new View('News/List');
        $view->assign('news', $news);
        $view->assign('pagination', $pagination);

        return $view;
    }

    public function addAction()
    {
        if (count($_POST)) {
            $title = $_POST['title']; 
            $content = $_POST['content']; 
            $category_id = $_POST['category'];

            if (strlen($_FILES['image']['name']) > 0){
                define("UPLOAD_DIR", NEWS_ADMIN_ROOT . '../core/assets/img/news_images/');

                if (!empty($_FILES["image"])) {
                    $myFile = $_FILES["image"];

                    if ($myFile["error"] !== UPLOAD_ERR_OK) {
                        echo "<p>An error occurred.</p>";
                        exit;
                    }

                    // ensure a safe filename
                    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);

                    // don't overwrite an existing file
                    $i = 0;
                    $parts = pathinfo($name);
                    while (file_exists(UPLOAD_DIR . $name)) {
                        $i++;
                        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
                    }

                    $image = $name;

                    // preserve file from temporary directory
                    $success = move_uploaded_file($myFile["tmp_name"],
                        UPLOAD_DIR . $name);
                    if (!$success) {
                        echo "<p>Unable to save file.</p>";
                        exit;
                    }

                    // set proper permissions on the new file
                    chmod(UPLOAD_DIR . $name, 0777);
                }
            }

            $newsTable = new NewsTable();
            $newsTable->addNews($image, $title, $content, $category_id);

            $view = new View('News/Add');

            return $view;
        } else {
            $view = new View('News/Add');

            return $view;
        }
    }

    public function updateAction()
    {
        if (count($_POST)) {
            $id = $_GET['updateId'];
            $title = $_POST['title'];
            $content = $_POST['content'];
            $categoryId = $_POST['category'];

            $newsTable = new NewsTable();
            $currentNews = $newsTable->getNewsById($id);
            $currentImage = $currentNews->getImage();

            if (strlen($_FILES['image']['name']) > 0){
                define("UPLOAD_DIR", NEWS_ADMIN_ROOT . '../core/assets/img/news_images/');

                if (!empty($_FILES["image"])) {
                    $myFile = $_FILES["image"];

                    if ($myFile["error"] !== UPLOAD_ERR_OK) {
                        echo "<p>An error occurred.</p>";
                        exit;
                    }

                    // ensure a safe filename
                    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);

                    // don't overwrite an existing file
                    $i = 0;
                    $parts = pathinfo($name);
                    while (file_exists(UPLOAD_DIR . $name)) {
                        $i++;
                        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
                    }

                    $image = $name;

                    unlink(NEWS_ADMIN_ROOT . '../core/assets/img/news_images/' . $currentImage);

                    // preserve file from temporary directory
                    $success = move_uploaded_file($myFile["tmp_name"],
                        UPLOAD_DIR . $name);
                    if (!$success) {
                        echo "<p>Unable to save file.</p>";
                        exit;
                    }

                    // set proper permissions on the new file
                    chmod(UPLOAD_DIR . $name, 0777);

                    $newsTable->updateNews($id, $image, $title, $content, $categoryId);
                }
            } else {
                $newsTable->updateNews($id, null, $title, $content, $categoryId);
            }

            $view = new View('News/Update');

            return $view;
        }  else {
            $view = new View('News/Update');

            return $view;
        }
    }

    public function deleteAction()
    {
        if (isset($_GET['delId'])) {
            $delId = $_GET['delId'];
            
            $newsTable = new NewsTable();
            $currentNews = $newsTable->getNewsById($delId);
            $currentImage = $currentNews->getImage();

            if ($currentImage != "default.png") {
                unlink(NEWS_ADMIN_ROOT . '../core/assets/img/news_images/' . $currentImage);
            }

            $newsTable->deleteNews($delId);

            $newsTable = new NewsTable();
            $newsCount = $newsTable->getNewsCount();
            $pagination = new Pagination($newsCount, 'controller=news&action=list');

            $news = $newsTable->getNews(Pagination::ITEMS_PER_PAGE, $pagination->getOffset());

            $view = new View('News/List');
            $view->assign('news', $news);
            $view->assign('pagination', $pagination);
            
            return $view;
        } else {
            $newsTable = new NewsTable();
            $newsCount = $newsTable->getNewsCount();
            $pagination = new Pagination($newsCount, 'controller=news&action=list');

            $newsTable = new NewsTable();
            $news = $newsTable->getNews(Pagination::ITEMS_PER_PAGE, $pagination->getOffset());

            $view = new View('News/List');
            $view->assign('news', $news);
            $view->assign('pagination', $pagination);

            return $view;
        }
    }
}
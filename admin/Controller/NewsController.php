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

            $newsTable = new NewsTable();
            $newsTable->addNews($title, $content, $category_id);

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

            $newsTable = new NewsTable();
            $newsTable->updateNews($id, $title, $content);

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
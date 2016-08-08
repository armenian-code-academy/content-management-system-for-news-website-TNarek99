<?php

require_once NEWS_ADMIN_ROOT . '../core/Model/NewsCategoryTable.php';
require_once NEWS_ADMIN_ROOT . '../core/classes/View.php';
require_once NEWS_ADMIN_ROOT . '../core/classes/Pagination.php';

class NewsCategoryController
{
    public function listAction()
    {
        $newsCategoryTable = new NewsCategoryTable();
        $newsCategoriesCount = $newsCategoryTable->getNewsCategoriesCount();
        $pagination = new Pagination($newsCategoriesCount, 'controller=newsCategory&action=list');

        $newsCategories = $newsCategoryTable->getNewsCategories(Pagination::ITEMS_PER_PAGE, $pagination->getOffset());

        $view = new View('NewsCategory/List');
        $view->assign('newsCategories', $newsCategories);
        $view->assign('pagination', $pagination);

        return $view;
    }

    public function addAction()
    {
        if (count($_POST)) {
            $title = $_POST['title'];

            $newsCategoryTable = new NewsCategoryTable();
            $newsCategoryTable->addNewsCategory($title);

            $view = new View('NewsCategory/Add');

            return $view;
        } else {
            $view = new View('NewsCategory/Add');

            return $view;
        }
    }

    public function updateAction()
    {
        if (count($_POST)) {
            $id = $_GET['updateId'];
            $title = $_POST['title'];

            $newsCategoryTable = new NewsCategoryTable();
            $newsCategoryTable->updateNewsCategory($id, $title);

            $view = new View('NewsCategory/Update');

            return $view;
        }  else {
            $view = new View('NewsCategory/Update');

            return $view;
        }
    }

    public function deleteAction()
    {
        if (isset($_GET['delId'])) {
            $delId = $_GET['delId'];

            $newsCategoryTable = new NewsCategoryTable();
            $newsCategoryTable->deleteNewsCategory($delId);

            $newsCategoryTable = new NewsCategoryTable();
            $newsCount = $newsCategoryTable->getNewsCategoriesCount();
            $pagination = new Pagination($newsCount, 'controller=news&action=list');

            $newsCategories = $newsCategoryTable->getNewsCategories(Pagination::ITEMS_PER_PAGE, $pagination->getOffset());

            $view = new View('NewsCategory/List');
            $view->assign('newsCategories', $newsCategories);
            $view->assign('pagination', $pagination);

            return $view;
        } else {
            $newsCategoryTable = new NewsCategoryTable();
            $newsCount = $newsCategoryTable->getNewsCategoriesCount();
            $pagination = new Pagination($newsCount, 'controller=news&action=list');

            $newsCategoryTable = new NewsCategoryTable();
            $newsCategories = $newsCategoryTable->getNewsCategories(Pagination::ITEMS_PER_PAGE, $pagination->getOffset());

            $view = new View('NewsCategory/List');
            $view->assign('newsCategories', $newsCategories);
            $view->assign('pagination', $pagination);

            return $view;
        }
    }
}
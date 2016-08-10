<?php

require_once NEWS_WEBSITE_ROOT . '../core/Model/NewsTable.php';
require_once NEWS_WEBSITE_ROOT . '../core/Model/NewsCategoryTable.php';
require_once NEWS_WEBSITE_ROOT . '../core/classes/View.php';
require_once NEWS_WEBSITE_ROOT . '../core/classes/Pagination.php';

class NewsController
{
    public function listAction()
    {
        $newsTable = new NewsTable();
        $newsCategoryTable = new NewsCategoryTable();
        //$newsCount = $newsTable->getNewsCount();
        //$pagination = new Pagination($newsCount, 'controller=news&action=list');

        $news = $newsTable->getNews();
        $categories = $newsCategoryTable->getNewsCategories();

        $view = new View('../../../website/View/Template/News/List');
        $view->assign('news', $news);
        $view->assign('categories', $categories);
        //$view->assign('pagination', $pagination);

        return $view;
    }
}
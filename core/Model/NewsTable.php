<?php

require_once NEWS_ADMIN_ROOT . '/Entity/NewsTableRow.php';
require_once NEWS_ADMIN_ROOT . '../core/classes/Connection.php';

class NewsTable
{
    /**
     * @var string
     */
    private $dbTable;

    /**
     * SudentDB constructor.
     * @param string $dbTable
     */
    public function __construct()
    {
        $this->dbTable = 'news';
    }

    public function getNews($limit = 0, $offset = 0)
    {
        if ($limit != 0 && $offset != 0) {
            $statement = Connection::getConnection()->prepare('
          SELECT 
            id, image, date, title, content, category_id
            FROM ' . $this->dbTable . ' LIMIT ' . $limit . ' OFFSET ' . $offset
            );
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);

            $result = $statement->fetchAll();

            $news = [];
            foreach ($result as $item){
                $newsItem = new NewsTableRow();
                $newsItem->setId($item['id']);
                $newsItem->setImage($item['image']);
                $newsItem->setDate($item['date']);
                $newsItem->setTitle($item['title']);
                $newsItem->setContent($item['content']);
                $newsItem->setCategoryId($item['category_id']);
                $news[] = $newsItem;
            }
            return $news;
        } else {
            $statement = Connection::getConnection()->prepare('
          SELECT 
            id, image, date, title, content, category_id
            FROM ' . $this->dbTable
            );
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);

            $result = $statement->fetchAll();

            $news = [];
            foreach ($result as $item){
                $newsItem = new NewsTableRow();
                $newsItem->setId($item['id']);
                $newsItem->setImage($item['image']);
                $newsItem->setDate($item['date']);
                $newsItem->setTitle($item['title']);
                $newsItem->setContent($item['content']);
                $newsItem->setCategoryId($item['category_id']);
                $news[] = $newsItem;
            }
            return $news;
        }
    }
    
    public function getNewsCount()
    {
        $statement = Connection::getConnection()->prepare('
          SELECT 
            COUNT(*) AS count 
            FROM ' . $this->dbTable
        );
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        
        $result = $statement->fetch();
        
        return $result['count'];
    }
    
    public function addNews($image, $title, $content, $category_id)
    {
        $statement = Connection::getConnection()->prepare('
          INSERT INTO ' . $this->dbTable .' (`image`, `title`, `content`, `category_id`) 
          VALUES (:image, :title, :content, :category_id)'
        );

        $statement->bindParam("image", $image, PDO::PARAM_STR);
        $statement->bindParam("title", $title, PDO::PARAM_STR);
        $statement->bindParam("content", $content, PDO::PARAM_STR);
        $statement->bindParam("category_id", $category_id, PDO::PARAM_STR);

        $statement->execute();
    }

    public function deleteNews($id)
    {
        $statement = Connection::getConnection()->prepare('
          DELETE FROM ' . $this->dbTable . ' WHERE id=' . $id
        );

        $statement->execute();
    }

    public function updateNews($id, $image = null, $title, $content, $category_id)
    {
        if ($image != null) {
            $statement = Connection::getConnection()->prepare('
              UPDATE ' . $this->dbTable . ' SET image = "' . $image . '", title = "' . $title . '", content = "' . $content . '", category_id = "' . $category_id . '" WHERE id=' . $id
            );
        } else {
            $statement = Connection::getConnection()->prepare('
              UPDATE ' . $this->dbTable . ' SET title = "' . $title . '", content = "' . $content . '", category_id = "' . $category_id . '" WHERE id=' . $id
            );
        }

        $statement->execute();
    }

    public function getNewsById($id)
    {
        $statement = Connection::getConnection()->prepare('
          SELECT id, image, date, title, content, category_id 
          FROM ' . $this->dbTable . ' WHERE id = ' . $id
        );
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);

        $result = $statement->fetch();

        $news = new NewsTableRow();
        $news->setId($result['id']);
        $news->setImage($result['image']);
        $news->setTitle($result['title']);
        $news->setContent($result['content']);
        $news->setCategoryId($result['category_id']);

        return $news;
    }
}
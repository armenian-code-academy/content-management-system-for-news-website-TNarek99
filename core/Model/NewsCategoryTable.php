<?php

require_once NEWS_ADMIN_ROOT . '/Entity/NewsCategoryTableRow.php';
require_once NEWS_ADMIN_ROOT . '../core/classes/Connection.php';

class NewsCategoryTable
{
    /**
     * @var string
     */
    private $dbTable;

    public function __construct()
    {
        $this->dbTable = 'cats';
    }

    public function getNewsCategories($limit = 0, $offset = 0)
    {
        if ($limit != 0 && $offset != 0) {
            $statement = Connection::getConnection()->prepare('
              SELECT id, title 
              FROM ' . $this->dbTable . ' LIMIT ' . $limit . ' OFFSET ' . $offset
            );
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);

            $result = $statement->fetchAll();

            $newsCategories = [];
            foreach ($result as $item){
                $newsCategory = new NewsCategoryTableRow();
                $newsCategory->setId($item['id']);
                $newsCategory->setTitle($item['title']);
                $newsCategories[] = $newsCategory;
            }
            return $newsCategories;
        } else {
            $statement = Connection::getConnection()->prepare('
              SELECT id, title 
              FROM ' . $this->dbTable
            );
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);

            $result = $statement->fetchAll();

            $newsCategories = [];
            foreach ($result as $item){
                $newsCategory = new NewsCategoryTableRow();
                $newsCategory->setId($item['id']);
                $newsCategory->setTitle($item['title']);
                $newsCategories[] = $newsCategory;
            }
            return $newsCategories;
        }
    }

    public function getNewsCategoriesCount()
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

    public function addNewsCategory($title)
    {
        $statement = Connection::getConnection()->prepare('
          INSERT INTO ' . $this->dbTable .' (`title`) 
          VALUES (:title)'
        );

        $statement->bindParam("title", $title, PDO::PARAM_STR);

        $statement->execute();
    }

    public function deleteNewsCategory($id)
    {
        $statement = Connection::getConnection()->prepare('
          DELETE FROM ' . $this->dbTable . ' WHERE id=' . $id
        );

        $statement->execute();
    }
    
    public function updateNewsCategory($id, $title)
    {
        $statement = Connection::getConnection()->prepare('
          UPDATE ' . $this->dbTable . ' SET title = "' . $title . '" WHERE id=' . $id
        );

        $statement->execute();
    }
    
    public function getNewsCategoryById($id) 
    {
        $statement = Connection::getConnection()->prepare('
          SELECT id, title 
          FROM ' . $this->dbTable . ' WHERE id = ' . $id
        );
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);

        $result = $statement->fetch();

        $newsCategory = new NewsCategoryTableRow();
        $newsCategory->setId($result['id']);
        $newsCategory->setTitle($result['title']);
        $newsCategories = $newsCategory;
        
        return $newsCategories;
    }
}
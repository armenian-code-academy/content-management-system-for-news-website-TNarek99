<ul class="news-list">
    <?php 
    
    foreach ($news as $newsItem) {
        if ($newsItem->getCategoryId() == $categoryId) {
            echo '<li class="news-list-item">';
            echo $newsItem->getTitle();
            echo '</li>';
        }
    }
    
    ?>
</ul>
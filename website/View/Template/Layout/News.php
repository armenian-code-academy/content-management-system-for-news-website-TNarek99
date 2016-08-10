<ul class="news-list">
    <?php 
    
    foreach ($news as $newsItem) {
        echo '<li class="news-list-item">';
        echo $newsItem->getTitle();
        echo '</li>';
    }
    
    ?>
</ul>
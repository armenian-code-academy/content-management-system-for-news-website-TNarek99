<ul class="categories-list">
    <?php

    foreach ($categories as $category) {
        echo '<li class="categories-list-item">';
        echo '<span class="categories-list-link">';
        echo $category->getTitle();
        echo '</span>';
        echo '</li>';
    }

    ?>
</ul>
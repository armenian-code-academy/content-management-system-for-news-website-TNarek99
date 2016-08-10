<ul class="categories-list">
    <?php

    foreach ($categories as $category) {
        if ($category->getId() == $categoryId) {
            echo '<li class="categories-list-item categories-list-item-chosen">';
            echo '<span class="categories-list-link">';
            echo $category->getTitle();
            echo '</span>';
            echo '</li>';
        } else {
            echo '<li class="categories-list-item">';
            echo '<span class="categories-list-link">';
            echo $category->getTitle();
            echo '</span>';
            echo '</li>';
        }
    }

    ?>
</ul>
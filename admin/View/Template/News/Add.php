<?php

require_once NEWS_ADMIN_ROOT . '../core/Model/NewsCategoryTable.php';

$newsCategoryTable = new NewsCategoryTable();
$newsCategories = $newsCategoryTable->getNewsCategories();

?>

<h1 class="page-header">News</h1>
<form method="post" enctype="multipart/form-data" action="<?= NEWS_ADMIN_ROOT_URL . '?controller=news&action=add' ?>">
    <input class="form-control" type="file" name="image">
    <input class="form-control" type="text" name="title" placeholder="Title">
    <input class="form-control" type="text" name="content" placeholder="Content">
    <select class="form-control" name="category">
        <?php

        foreach ($newsCategories as $newsCategory) {
            echo '<option value="' . $newsCategory->getId() . '">';
            echo $newsCategory->getTitle();
            echo '</option>';
        }

        ?>
    </select>
    <input class="btn btn-default" type="submit" value="Submit">
</form>

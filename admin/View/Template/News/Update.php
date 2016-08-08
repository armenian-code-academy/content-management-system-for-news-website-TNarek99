<?php

require_once NEWS_ADMIN_ROOT . '../core/Model/NewsCategoryTable.php';

$newsCategoryTable = new NewsCategoryTable();
$newsCategories = $newsCategoryTable->getNewsCategories();

$updateNewsTable = new NewsTable();

$updateNews =  $updateNewsTable->getNewsById($_GET['updateId']);

?>

<h1 class="page-header">News</h1>
<form method="post" action="<?= NEWS_ADMIN_ROOT_URL . '?controller=news&action=update&updateId=' . $_GET['updateId'] ?>">
    <input class="form-control" type="text" name="title" placeholder="Title" value="<?= $updateNews->getTitle() ?>">
    <input class="form-control" type="text" name="content" placeholder="Content" value="<?= $updateNews->getContent() ?>">
    <select class="form-control" name="category">
        <?php

        foreach ($newsCategories as $newsCategory) {
            if ($newsCategory->getId() == $updateNews->getCategoryId()) {
                echo '<option selected="selected" value="' . $newsCategory->getId() . '">';
                echo $newsCategory->getTitle();
                echo '</option>';
            } else {
                echo '<option value="' . $newsCategory->getId() . '">';
                echo $newsCategory->getTitle();
                echo '</option>';
            }
        }

        ?>
    </select>
    <input class="btn btn-default" type="submit" value="Submit">
</form>
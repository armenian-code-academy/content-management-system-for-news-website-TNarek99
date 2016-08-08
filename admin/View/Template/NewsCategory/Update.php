<?php

$updateCategoryTable = new NewsCategoryTable();

$updateCategory =  $updateCategoryTable->getNewsCategoryById($_GET['updateId']);

?>

<h1 class="page-header">News Categories</h1>
<form method="post" action="<?= NEWS_ADMIN_ROOT_URL . '?controller=newsCategory&action=update&updateId=' . $_GET['updateId'] ?>">
    <input class="form-control" type="text" name="title" placeholder="Title" value="<?= $updateCategory->getTitle() ?>">
    <input class="btn btn-default" type="submit" value="Submit">
</form>

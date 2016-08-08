<?php

$updateNewsTable = new NewsTable();

$updateNews =  $updateNewsTable->getNewsById($_GET['updateId']);

?>

<h1 class="page-header">News</h1>
<form method="post" action="<?= NEWS_ADMIN_ROOT_URL . '?controller=news&action=update&updateId=' . $_GET['updateId'] ?>">
    <input class="form-control" type="text" name="title" placeholder="Title" value="<?= $updateNews->getTitle() ?>">
    <input class="form-control" type="text" name="content" placeholder="Content" value="<?= $updateNews->getContent() ?>">
    <input class="btn btn-default" type="submit" value="Submit">
</form>
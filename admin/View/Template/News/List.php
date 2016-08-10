<h1 class="page-header">
    News <a class="btn btn-success" href="<?= NEWS_ADMIN_ROOT_URL . '?controller=news&action=add' ?>">
        Add News <span class="glyphicon glyphicon-plus"></span>
    </a>
</h1>
<table class="table">
<?php
    foreach ($news as $key => $value){
    echo
    '<tr>
    <td>' . $value->getId() . '</td>
    <td>' . $value->getImage() . '</td>
    <td>' . $value->getDate() . '</td>
    <td>' . $value->getTitle() . '</td>
    <td>' . $value->getContent() . '</td>
    <td>' . $value->getCategoryId() . '</td>
    <td width="1">
        <a class="btn btn-danger" href="' . NEWS_ADMIN_ROOT_URL . '?controller=news&action=delete&delId=' . $value->getId() . '">Delete News <span class="glyphicon glyphicon-trash"></span></a>
        <br>
        <br>
        <a class="btn btn-warning" href="' . NEWS_ADMIN_ROOT_URL . '?controller=news&action=update&updateId=' . $value->getId() . '">Update News<span class="glyphicon glyphicon-edit"></span></a>
    </td>
    </tr>';
}
echo '</table>';
$pagination->draw();
?>

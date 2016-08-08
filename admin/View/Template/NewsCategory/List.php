<h1 class="page-header">
    News Categories <a class="btn btn-success" href="<?= NEWS_ADMIN_ROOT_URL . '?controller=newsCategory&action=add' ?>">
        Add Category <span class="glyphicon glyphicon-plus"></span>
    </a>
</h1>
<table class="table">
    <?php
    foreach ($newsCategories as $key => $value){
        echo
            '<tr>
        <td>' . $value->getId() . '</td>
        <td>' . $value->getTitle() . '</td>
        <td width="1">
            <a class="btn btn-danger" href="' . NEWS_ADMIN_ROOT_URL . '?controller=newsCategory&action=delete&delId=' . $value->getId() . '">Delete Category<span class="glyphicon glyphicon-trash"></span></a>
            <br>
            <br>
            <a class="btn btn-warning" href="' . NEWS_ADMIN_ROOT_URL . '?controller=newsCategory&action=update&updateId=' . $value->getId() . '">Update Category<span class="glyphicon glyphicon-edit"></span></a>
        </td>
    </tr>';
    }
    ?>
</table>

<?php
$pagination->draw();
?>

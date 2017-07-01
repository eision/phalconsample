<?= $this->getContent() ?>
<?php
$db = mysqli_connect('localhost', 'root', '', 'sample') or
die(mysqli_connect_error());
mysqli_set_charset($db, 'utf8');

$recordSet = mysqli_query($db, 'SELECT * FROM companies ORDER BY id
DESC');
?>

<ul class="pager">
    <li class="pull-right">
        <?= $this->tag->linkTo(['companies/new', 'Create micropost']) ?>
    </li>
</ul>

<table class="table table-bordered table-striped" align="center">

    <thead>
        <tr>
            <th>Title</th>
            <th>content</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
<?php
while ($table = mysqli_fetch_assoc($recordSet)) {?>
    <tbody>
        <tr>
            <td><?php print(htmlspecialchars($table['title'])); ?></td>
            <td><?php print(htmlspecialchars($table['content'])); ?></td>
            <td width="7%"><?= $this->tag->linkTo(['companies/edit/' . $table['id'], '<i class="glyphicon glyphicon-edit"></i> Edit', 'class' => 'btn btn-default']) ?></td>
            <td width="7%"><?= $this->tag->linkTo(['companies/delete/' . $table['id'], '<i class="glyphicon glyphicon-remove"></i> Delete', 'class' => 'btn btn-default']) ?></td>
        </tr>
<?php
}
?>
    </tbody>
</table>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список мастеров СТО</title>
</head>
<body>

<?php
require '../RedBeanPHP5_7-sqlite/rb-sqlite.php';

R::setup('sqlite:../data/ss_new.db');

if (!R::testConnection()) {
    die('Не удалось подключиться к базе данных.');
}

$workers = R::find('workers','`status` = ?',['является работником']);
?>

<form method="post" enctype="application/x-www-form-urlencoded" action="">

<table class="workers-table">
    <tr class="table-header">
        <th>Id</th>
        <th>Фамилия</th>
        <th>Имя</th>
        <th>Отчество</th>
        <th>Специализация</th>
        <th>Ссылка на редактирование</th>
        <th>Ссылка на удаление</th>
        <th>График</th>
        <th>Выполненные работы</th>
    </tr>
    <?php foreach($workers as $worker):
        ?>
        <tr>
            <td name="worker_id"><?= $worker->id ?></td>
            <td name="surname"><?= $worker->surname ?></td>
            <td name="name"><?= $worker->name ?></td>
            <td name="patronymic"><?= $worker->patronymic ?></td>
            <td name="specialization"><?= $worker->specialization ?></td>            
            
            <td><div><a href="update.php?id=<?= $worker->id ?>&surname=<?= $worker->surname ?>&name=<?= $worker->name ?>&patronymic=<?= $worker->patronymic ?>&specialization=<?= $worker->specialization ?>">Редактировать</a></div></td>
            <td><div><a href="delete.php?id=<?= $worker->id ?>">Удалить</a></div></td>
            <td><div><a href="schedule.php?id_w=<?= $worker->id ?>">График</a></div></td>
            <td><div><a href="completed_works.php?id_w=<?= $worker->id ?>">Выполненные работы</a></div></td>
        </tr>
    <?php endforeach; ?>
</table>
</form>

<form method="post" enctype="application/x-www-form-urlencoded" action="create.php">

<button>Добавить</button>

</form>
</body>
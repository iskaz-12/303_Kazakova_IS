<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>График мастера</title>
</head>
<body>

<?php
require '../RedBeanPHP5_7-sqlite/rb-sqlite.php';

R::setup('sqlite:../data/ss_new.db');

if (!R::testConnection()) {
    die('Не удалось подключиться к базе данных.');
}

$busyness = R::getAll('SELECT a.id, b.isactual, c.busyness_id, b.data, b.work_hours_start, b.work_hours_end FROM `workers` a, `busyness` b, `workersbusyness` c WHERE a.id = c.workers_id AND c.busyness_id = b.id AND isactual = :isactual AND a.id = :id',[':isactual' => 'да', ':id' => $_GET['id_w']]);
?>

<form method="post" enctype="application/x-www-form-urlencoded" action="">
<input type="hidden" name="id_w" value=<?= $_GET['id_w'] ?>>
<table class="busyness-table">
    <tr class="table-header">
        <th>Id рабочего времени</th>
        <th>Дата</th>
        <th>Время начала</th>
        <th>Время окончания</th>
        <th>Ссылка на редактирование</th>
        <th>Ссылка на удаление</th>
    </tr>
    <?php
    foreach($busyness as $b):
        ?>
        <tr>
            <td name="busyness_id"><?= $b['busyness_id'] ?></td>
            <td name="data"><?= $b['data'] ?></td>
            <td name="work_hours_start"><?= $b['work_hours_start'] ?></td>
            <td name="work_hours_end"><?= $b['work_hours_end'] ?></td>
            <td><div><a href="update_schedule.php?id_w=<?= $_GET['id_w'] ?>&busyness_id=<?=  $b['busyness_id']  ?>&data=<?=  $b['data']  ?>&work_hours_start=<?=  $b['work_hours_start']  ?>&work_hours_end=<?=  $b['work_hours_end']  ?>&is_actual=<?=  $b['isactual']  ?>">Обновить</a></div></td>
            <td><div><a href="delete_schedule.php?id_w=<?= $_GET['id_w'] ?>&busyness_id=<?=  $b['busyness_id']  ?>">Удалить</a></div></td>
        </tr>
    <?php endforeach; ?>
</table>

<div><a href="create_schedule.php?id_w=<?= $_GET['id_w'] ?>">Создать новую запись</a></div>

</form>

<form method="post" enctype="application/x-www-form-urlencoded" action="index.php">
 
<p><button>Вернуться к главному меню</button></p>
</form>

</body>
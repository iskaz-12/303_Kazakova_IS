<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список выполненных работ мастера</title>
</head>
<body>

<?php
require '../RedBeanPHP5_7-sqlite/rb-sqlite.php';

R::setup('sqlite:../data/ss_new.db');

if (!R::testConnection()) {
    die('Не удалось подключиться к базе данных.');
}

$completed_works = R::getAll('SELECT a.id AS `w_id`, b.status, c.orders_id, b.service_execution_time, d.services_id, e.name_of_service, d.duration_in_hours, d.price, d.id FROM `workers` a, `orders` b, `ordersservicescarcategories` c, `servicescarcategories` d, `services` e WHERE b.workers_id = a.id AND b.id = c.orders_id AND d.id = c.servicescarcategories_id AND d.services_id = e.id AND b.status = :stat AND a.id = :id',[':stat' => 'да', ':id' => $_GET['id_w']]);
?>

<form method="post" enctype="application/x-www-form-urlencoded" action="">
<table class="completed_works-table">
    <tr class="table-header">
        <th>Id мастера</th>
        <th>Id выполненной услуги</th>
        <th>Название услуги</th>
        <th>Дата оказания услуги (начало выполнения)</th>
        <th>Продолжительность выполнения услуги (в часах)</th>
        <th>Цена услуги (в рублях)</th>
    </tr>
    <?php foreach($completed_works as $c):
        ?>
        <tr>
            <td name="worker_id"><?= $c['w_id'] ?></td>
            <td name="order_id"><?= $c['orders_id'] ?></td>
            <td name="name_of_service"><?= $c['name_of_service'] ?></td>
            <td name="service_execution_time"><?= $c['service_execution_time'] ?></td>
            <td name="duration_in_hours"><?= $c['duration_in_hours'] ?></td>
            <td name="price"><?= $c['price'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</form>
<form method="post" enctype="application/x-www-form-urlencoded" action="index.php">
<p><button>Вернуться к главному меню</button></p>
</form>
</body>
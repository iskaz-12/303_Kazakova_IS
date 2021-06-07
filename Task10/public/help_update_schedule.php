<?php
require '../RedBeanPHP5_7-sqlite/rb-sqlite.php';

R::setup('sqlite:../data/ss_new.db');

if (!R::testConnection()) {
    die('Не удалось подключиться к базе данных.');
}

$busyness = R::load('busyness',$_POST['busyness_id']);

//  Данные обновляем только в таблице busyness
if (strcasecmp($_POST['date_busyness'],"")!=0){
    $busyness->data = $_POST['date_busyness'];
}
else{
    $busyness->data = $_POST['data_old'];
}
if (strcasecmp($_POST['busyness_time_start'],"")!=0){
    $busyness->work_hours_start = $_POST['busyness_time_start'];
}
else{
    $busyness->work_hours_start = $_POST['work_hours_start_old'];
}
if (strcasecmp($_POST['busyness_time_end'],"")!=0){
    $busyness->work_hours_end = $_POST['busyness_time_end'];
}
else{
    $busyness->work_hours_end = $_POST['work_hours_end_old'];
}

R::store($busyness);
?>

<!DOCTYPE html>
<html lang="en">
<body>
<div><a href="schedule.php?id_w=<?= $_POST['id_w'] ?>">Вернуться к расписанию выбранного мастера</a></div>
<form method="post" enctype="application/x-www-form-urlencoded" action="index.php">
<p><button>Вернуться к главному меню</button></p>
</form>
</body>
</html>
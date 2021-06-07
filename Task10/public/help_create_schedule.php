<?php
require '../RedBeanPHP5_7-sqlite/rb-sqlite.php';

R::setup('sqlite:../data/ss_new.db');

if (!R::testConnection()) {
    die('Не удалось подключиться к базе данных.');
}

if (strcasecmp($_POST['id_w'],"")!=0 and strcasecmp($_POST['date_busyness'],"")!=0 and strcasecmp($_POST['busyness_time_start'],"")!=0 and strcasecmp($_POST['busyness_time_end'],"")!=0){
    $busyness = R::dispense('busyness');
    $busyness->data = $_POST['date_busyness'];
    $busyness->work_hours_start = $_POST['busyness_time_start'];
    $busyness->work_hours_end = $_POST['busyness_time_end'];
    $busyness->isactual = 'да';
    R::store($busyness);

    $last_busyness_id = R::getInsertID();

    $workers_busyness = R::dispense('workersbusyness');
    $workers_busyness->workers_id = $_POST['id_w'];
    $workers_busyness->busyness_id = $last_busyness_id;
    R::store($workers_busyness);
}
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
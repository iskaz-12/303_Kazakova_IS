<?php
require '../RedBeanPHP5_7-sqlite/rb-sqlite.php';

R::setup('sqlite:../data/ss_new.db');

if (!R::testConnection()) {
    die('Не удалось подключиться к базе данных.');
}

$busyness = R::load('busyness',$_POST['busyness_id']);
$busyness->isactual = "нет";
R::store($busyness);
?>

<!DOCTYPE html>
<html lang="en">
<body>
<a href="schedule.php?id_w=<?= $_POST['id_w'] ?>">Вернуться к расписанию выбранного мастера</a>
    <form method="post" enctype="application/x-www-form-urlencoded" action="index.php">
        <p><button>Вернуться к главному меню</button></p>
    </form>
</body>
</html>
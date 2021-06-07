<?php
require '../RedBeanPHP5_7-sqlite/rb-sqlite.php';

R::setup('sqlite:../data/ss_new.db');

if (!R::testConnection()) {
    die('Не удалось подключиться к базе данных.');
}

$worker = R::load('workers',$_POST['w_id']);
$worker->status = "не является работником";
R::store($worker);
?>

<!DOCTYPE html>
<html lang="en">
<body>
<form method="post" enctype="application/x-www-form-urlencoded" action="index.php">
<p><button>Вернуться к главному меню</button></p>
</form>
</body>
</html>
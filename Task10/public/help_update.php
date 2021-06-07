<?php
require '../RedBeanPHP5_7-sqlite/rb-sqlite.php';

R::setup('sqlite:../data/ss_new.db');

if (!R::testConnection()) {
    die('Не удалось подключиться к базе данных.');
}

$worker = R::load('workers',$_POST['w_id']);

if (strcasecmp($_POST['surname_new'],"")!=0){
    $worker->surname = $_POST['surname_new'];
}
else{
    $worker->surname = $_POST['surname_old'];
}

if (strcasecmp($_POST['name_new'],"")!=0){
    $worker->name = $_POST['name_new'];
}
else{
    $worker->name = $_POST['name_old'];
}

if (strcasecmp($_POST['patronymic_new'],"")!=0){
    $worker->patronymic = $_POST['patronymic_new'];
}
else{
    $worker->patronymic = $_POST['patronymic_old'];
}

if (isset($_POST['specialization_new'])){
    $worker->specialization = $_POST['specialization_new'];
}
else{
    $worker->specialization = $_POST['specialization_old'];
}

$worker->percentage_of_revenue = $_POST['percentage_of_revenue'];
$worker->status = $_POST['status'];

R::store($worker);

$workers_services = R::find('workersservices','`workers_id` = ?',[$_POST['w_id']]);

R::trashAll($workers_services);


if (isset($_POST['change_of_oil_in_ICE'])) {
    $worker_service = R::dispense('workersservices');
    $worker_service->workers_id = $_POST['w_id'];
    $worker_service->services_id = '1';
    R::store($worker_service);
}
if (isset($_POST['oil_filter_change'])) {
    $worker_service = R::dispense('workersservices');
    $worker_service->workers_id = $_POST['w_id'];
    $worker_service->services_id = '2';
    R::store($worker_service);
}
if (isset($_POST['fuel_filter_change'])) {
    $worker_service = R::dispense('workersservices');
    $worker_service->workers_id = $_POST['w_id'];
    $worker_service->services_id = '3';
    R::store($worker_service);
}
if (isset($_POST['brake_fluid_change'])) {
    $worker_service = R::dispense('workersservices');
    $worker_service->workers_id = $_POST['w_id'];
    $worker_service->services_id = '4';
    R::store($worker_service);
}
if (isset($_POST['injector_flushing'])) {
    $worker_service = R::dispense('workersservices');
    $worker_service->workers_id = $_POST['w_id'];
    $worker_service->services_id = '5';
    R::store($worker_service);
}
if (isset($_POST['replacement_of_spark_plugs'])) {
    $worker_service = R::dispense('workersservices');
    $worker_service->workers_id = $_POST['w_id'];
    $worker_service->services_id = '6';
    R::store($worker_service);
}
if (isset($_POST['change_of_oil'])) {
    $worker_service = R::dispense('workersservices');
    $worker_service->workers_id = $_POST['w_id'];
    $worker_service->services_id = '7';
    R::store($worker_service);
}
if (isset($_POST['engine_overhaul'])) {
    $worker_service = R::dispense('workersservices');
    $worker_service->workers_id = $_POST['w_id'];
    $worker_service->services_id = '8';
    R::store($worker_service);
}
if (isset($_POST['belt_and_chain_replacement_in_valvetrain'])) {
    $worker_service = R::dispense('workersservices');
    $worker_service->workers_id = $_POST['w_id'];
    $worker_service->services_id = '9';
    R::store($worker_service);
}
if (isset($_POST['radiator_replacement'])) {
    $worker_service = R::dispense('workersservices');
    $worker_service->workers_id = $_POST['w_id'];
    $worker_service->services_id = '10';
    R::store($worker_service);
}
if (isset($_POST['turbine_replacement'])) {
    $worker_service = R::dispense('workersservices');
    $worker_service->workers_id = $_POST['w_id'];
    $worker_service->services_id = '11';
    R::store($worker_service);
}
if (isset($_POST['full_body_painting'])) {
    $worker_service = R::dispense('workersservices');
    $worker_service->workers_id = $_POST['w_id'];
    $worker_service->services_id = '12';
    R::store($worker_service);
}
if (isset($_POST['local_body_painting'])) {
    $worker_service = R::dispense('workersservices');
    $worker_service->workers_id = $_POST['w_id'];
    $worker_service->services_id = '13';
    R::store($worker_service);
}
if (isset($_POST['bumper_repair'])) {
    $worker_service = R::dispense('workersservices');
    $worker_service->workers_id = $_POST['w_id'];
    $worker_service->services_id = '14';
    R::store($worker_service);
}
if (isset($_POST['vacuum_dent_removal'])) {
    $worker_service = R::dispense('workersservices');
    $worker_service->workers_id = $_POST['w_id'];
    $worker_service->services_id = '15';
    R::store($worker_service);
}
if (isset($_POST['restoration_of_body_geometry'])) {
    $worker_service = R::dispense('workersservices');
    $worker_service->workers_id = $_POST['w_id'];
    $worker_service->services_id = '16';
    R::store($worker_service);
}
if (isset($_POST['clutch_replacement'])) {
    $worker_service = R::dispense('workersservices');
    $worker_service->workers_id = $_POST['w_id'];
    $worker_service->services_id = '17';
    R::store($worker_service);
}
if (isset($_POST['shock_absorber_replacement'])) {
    $worker_service = R::dispense('workersservices');
    $worker_service->workers_id = $_POST['w_id'];
    $worker_service->services_id = '18';
    R::store($worker_service);
}
if (isset($_POST['camber_toe_diagnostics'])) {
    $worker_service = R::dispense('workersservices');
    $worker_service->workers_id = $_POST['w_id'];
    $worker_service->services_id = '19';
    R::store($worker_service);
}
if (isset($_POST['wheel_balancing'])) {
    $worker_service = R::dispense('workersservices');
    $worker_service->workers_id = $_POST['w_id'];
    $worker_service->services_id = '20';
    R::store($worker_service);
}
if (isset($_POST['automatic_transmission_replacement'])) {
    $worker_service = R::dispense('workersservices');
    $worker_service->workers_id = $_POST['w_id'];
    $worker_service->services_id = '21';
    R::store($worker_service);
}
if (isset($_POST['manual_transmission_repair'])) {
    $worker_service = R::dispense('workersservices');
    $worker_service->workers_id = $_POST['w_id'];
    $worker_service->services_id = '22';
    R::store($worker_service);
}
if (isset($_POST['parking_sensors_installation'])) {
    $worker_service = R::dispense('workersservices');
    $worker_service->workers_id = $_POST['w_id'];
    $worker_service->services_id = '23';
    R::store($worker_service);
}
if (isset($_POST['rear_view_cameras_installation'])) {
    $worker_service = R::dispense('workersservices');
    $worker_service->workers_id = $_POST['w_id'];
    $worker_service->services_id = '24';
    R::store($worker_service);
}
if (isset($_POST['car_soundproofing'])) {
    $worker_service = R::dispense('workersservices');
    $worker_service->workers_id = $_POST['w_id'];
    $worker_service->services_id = '25';
    R::store($worker_service);
}
if (isset($_POST['car_wash'])) {
    $worker_service = R::dispense('workersservices');
    $worker_service->workers_id = $_POST['w_id'];
    $worker_service->services_id = '26';
    R::store($worker_service);
}
if (isset($_POST['car_polishing'])) {
    $worker_service = R::dispense('workersservices');
    $worker_service->workers_id = $_POST['w_id'];
    $worker_service->services_id = '27';
    R::store($worker_service);
}
if (isset($_POST['car_dry_cleaning'])) {
    $worker_service = R::dispense('workersservices');
    $worker_service->workers_id = $_POST['w_id'];
    $worker_service->services_id = '28';
    R::store($worker_service);
}
?>

<!DOCTYPE html>
<html lang="en">
<body>
<form method="post" enctype="application/x-www-form-urlencoded" action="index.php">
<p><button>Вернуться к главному меню</button></p>
</form>
</body>
</html>
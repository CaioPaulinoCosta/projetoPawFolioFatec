<?php 

require_once("config/globals.php");
require_once("config/db.php");
require_once("models/Schedule.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");
require_once("dao/ScheduleDAO.php");

date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_TIME, 'pt_BR.utf8');

$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
$scheduleDao = new ScheduleDAO($conn, $BASE_URL);

// Pega o tipo do formulario
$type = filter_input(INPUT_POST, "type");

// Resgata dados do usuario
$userData = $userDao->verifyToken();

if($type === "create") {

    // Recebe dados do input
    $schedule_pet_name = filter_input(INPUT_POST, "schedule_pet_name");
    $schedule_service_type = filter_input(INPUT_POST, "schedule_service_type");
    $schedule_date = filter_input(INPUT_POST, "schedule_date");
    $schedule_time = filter_input(INPUT_POST, "schedule_time");
    $schedule_payment_method = filter_input(INPUT_POST, "schedule_payment_method");
    $schedule_conclusion = filter_input(INPUT_POST, "schedule_conclusion");

    $schedule = new Schedule();

    // Valida dados minimos
    if(!empty($schedule_pet_name && $schedule_service_type && $schedule_date && $schedule_time && $schedule_payment_method && $schedule_conclusion)) {

    $schedule->schedule_pet_name = $schedule_pet_name;
    $schedule->schedule_service_type = $schedule_service_type;
    $schedule->schedule_date = $schedule_date;
    $schedule->schedule_time = $schedule_time;
    $schedule->schedule_payment_method = $schedule_payment_method;
    $schedule->schedule_conclusion = $schedule_conclusion;
    $schedule->userId = $userData->user_id;

    $scheduleDao->create($schedule);

    } else {

    $message->setMessage("Você precisa preencher todos os campos!", "error", "back");

    }

}  else {

    $message->setMessage("Informações inválidas!", "error", "index.php");

  }
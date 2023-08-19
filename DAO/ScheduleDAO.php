<?php

require_once("models/Schedule.php");
require_once("models/Message.php");

class ScheduleDAO implements scheduleDAOInterface {

    private $conn;
    private $url;
    private $message;

    public function __construct(PDO $conn, $url) {
        $this->conn = $conn;
        $this->url = $url;
        $this->message = new Message($url);
    }

    public function buildSchedule($data) {


        $schedule = new Schedule();

        $schedule->schedule_id = $data["schedule_id"];
        $schedule->schedule_pet_name = $data["schedule_pet_name"];
        $schedule->schedule_service_type = $data["schedule_service_type"];
        $schedule->schedule_date = $data["schedule_date"];
        $schedule->schedule_time = $data["schedule_time"];
        $schedule->schedule_payment_method = $data["schedule_payment_method"];
        $schedule->schedule_conclusion = $data["schedule_conclusion"];
        $schedule->userId = $data["userId"];
        $schedule->emplooyerId = $data["emplooyerId"];

        return $schedule;

    }
    public function findAll() {

    }
    public function getLatestSchedules() {

        $schedules = [];

        $stmt = $this->conn->query("SELECT * FROM schedule ORDER BY schedule_id DESC");

        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $scheduleArray = $stmt->fetchAll();

            foreach($scheduleArray as $schedule) {
                $schedules[] = $this->buildSchedule($schedule);
            }
        }

        return $schedules;

    }
    public function getScheduleByUserId($userId) {

        $schedules = [];

        $stmt = $this->conn->prepare("SELECT * FROM schedule WHERE userId = :userId");

        $stmt->bindParam(":userId", $userId);

        $stmt->execute();

        if($stmt->rowCount() > 0) {
  
            $schedulesArray = $stmt->fetchAll();
  
          foreach($schedulesArray as $schedule) {
            $schedules[] = $this->buildSchedule($schedule);
          }
  
        }
        return $schedules;

    }
    public function getScheduleByEmplooyerId($emplooyerId) {

        $schedules = [];

        $stmt = $this->conn->prepare("SELECT * FROM schedule WHERE emplooyerId = :emplooyerId");

        $stmt->bindParam(":emplooyerId", $emplooyerId);

        $stmt->execute();

        if($stmt->rowCount() > 0) {
  
            $schedulesArray = $stmt->fetchAll();
  
          foreach($schedulesArray as $schedule) {
            $schedules[] = $this->buildSchedule($schedule);
          }
  
        }
        return $schedules;

    }
    public function findById($schedule_id) {

        $schedules = [];
  
        $stmt = $this->conn->prepare("SELECT * FROM schedule WHERE schedule_id = :schedule_id");
  
        $stmt->bindParam(":schedule_id", $schedule_id);
  
        $stmt->execute();
  
        if($stmt->rowCount() > 0) {
  
            $scheduleData = $stmt->fetch();
  
        $schedule = $this->buildSchedule($scheduleData);
  
        return $schedule;
  
        } else {
  
        return false;
  
        }

    }
    public function create(Schedule $schedule) {

        $stmt = $this->conn->prepare("INSERT INTO schedule (
            schedule_pet_name, schedule_service_type, schedule_date, schedule_time, schedule_payment_method, schedule_conclusion, userId
            ) VALUES (
            :schedule_pet_name, :schedule_service_type, :schedule_date, :schedule_time, :schedule_payment_method, :schedule_conclusion, :userId
            )");
    
            $stmt->bindParam(":schedule_pet_name",  $schedule->schedule_pet_name);
            $stmt->bindParam(":schedule_service_type",  $schedule->schedule_service_type);
            $stmt->bindParam(":schedule_date",  $schedule->schedule_date);
            $stmt->bindParam(":schedule_time",  $schedule->schedule_time);
            $stmt->bindParam(":schedule_payment_method",  $schedule->schedule_payment_method);
            $stmt->bindParam(":schedule_conclusion",  $schedule->schedule_conclusion);
            $stmt->bindParam(":userId",  $schedule->userId);
    
            $stmt->execute();
    
            $this->message->setMessage("Agendamento realizado com sucesso!", "success", "index.php");

    }

    public function destroy($schedule_id) {

        $stmt = $this->conn->prepare("DELETE FROM schedule WHERE schedule_id = :schedule_id");

        $stmt->bindParam("schedule_id", $schedule_id);
    
        $stmt->execute();
    
        $this->message->setMessage("Agendamento removido com sucesso!", "success", "my_jobs.php");
    }
    
}
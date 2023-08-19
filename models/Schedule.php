<?php 

    class Schedule {

        public $schedule_id;
        public $schedule_pet_name;
        public $schedule_service_type;
        public $schedule_date;
        public $schedule_time;
        public $schedule_payment_method;
        public $schedule_conclusion;
        public $userId;
        public $emplooyerId;

    }

    interface scheduleDAOInterface {

        public function buildSchedule($data);
        public function findAll();
        public function getLatestSchedules();
        public function getScheduleByUserId($userId);
        public function getScheduleByEmplooyerId($emplooyerId);
        public function findById($schedule_id);
        public function create(Schedule $schedule);
        public function destroy($schedule_id);
    }
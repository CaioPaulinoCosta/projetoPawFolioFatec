<?php 

    class Pet {

        public $pet_id;
        public $pet_name;
        public $pet_species;
        public $pet_breed;
        public $pet_birthday;
        public $pet_color;
        public $pet_sex;
        public $pet_image;
        public $pet_vaccination_history_name;
        public $pet_vaccination_history_type;
        public $pet_vaccination_history_file;
        public $pet_level_of_sociality;
        public $pet_interactions_with_other_animals;
        public $pet_specific_behaviors;
        public $userId;

        public function imageGenerateName() {
            return bin2hex(random_bytes(60)) . "jpg";
        }
    }

    interface petsDAOInterface {

        public function buildPet($data);
        public function findAll();
        public function getLatestPets();
        public function getPetByUserId($userId);
        public function findById($pet_id);
        public function create(Pet $pets);
        public function update(Pet $pets);
        public function destroy($pet_id);
    }
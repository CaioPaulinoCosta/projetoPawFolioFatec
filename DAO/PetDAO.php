<?php

require_once("models/Pet.php");
require_once("models/Message.php");

class PetDAO implements petsDAOInterface {

    private $conn;
    private $url;
    private $message;

    public function __construct(PDO $conn, $url) {
        $this->conn = $conn;
        $this->url = $url;
        $this->message = new Message($url);
    }

    public function buildPet($data) {

        $pet = new Pet();

        $pet->pet_id = $data["pet_id"];
        $pet->pet_name = $data["pet_name"];
        $pet->pet_species = $data["pet_species"];
        $pet->pet_breed = $data["pet_breed"];
        $pet->pet_birthday = $data["pet_birthday"];
        $pet->pet_color = $data["pet_color"];
        $pet->pet_sex = $data["pet_sex"];
        $pet->pet_image = $data["pet_image"];
        $pet->pet_vaccination_history_name = $data["pet_vaccination_history_name"];
        $pet->pet_vaccination_history_type = $data["pet_vaccination_history_type"];
        $pet->pet_vaccination_history_file = $data["pet_vaccination_history_file"];
        $pet->pet_level_of_sociality = $data["pet_level_of_sociality"];
        $pet->pet_interactions_with_other_animals = $data["pet_interactions_with_other_animals"];
        $pet->pet_specific_behaviors = $data["pet_specific_behaviors"];
        $pet->userId = $data["userId"];

        return $pet;

    }
    public function findAll() {

    }
    public function getLatestPets() {

        $pets = [];

        $stmt = $this->conn->query("SELECT * FROM pets ORDER BY pet_id DESC");

        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $petsArray = $stmt->fetchAll();

            foreach($petsArray as $pet) {
                $pets[] = $this->buildPet($pet);
            }
        }

        return $pets;

    }
    public function getPetByUserId($userId) {

        $pets = [];

        $stmt = $this->conn->prepare("SELECT * FROM pets WHERE userId = :userId");

        $stmt->bindParam(":userId", $userId);

        $stmt->execute();

        if($stmt->rowCount() > 0) {
  
            $petsArray = $stmt->fetchAll();
  
          foreach($petsArray as $pet) {
            $pets[] = $this->buildPet($pet);
          }
  
        }
        return $pets;

    }
    public function findById($pet_id) {

        $pets = [];
  
        $stmt = $this->conn->prepare("SELECT * FROM pets WHERE pet_id = :pet_id");
  
        $stmt->bindParam(":pet_id", $pet_id);
  
        $stmt->execute();
  
        if($stmt->rowCount() > 0) {
  
            $petData = $stmt->fetch();
  
        $pet = $this->buildPet($petData);
  
        return $pet;
  
        } else {
  
        return false;
  
        }

    }
    public function create(Pet $pets) {

        $stmt = $this->conn->prepare("INSERT INTO pets (
            pet_name, pet_species, pet_breed, pet_birthday, pet_color, pet_sex, pet_image, pet_vaccination_history_name, pet_vaccination_history_type, pet_vaccination_history_file, pet_level_of_sociality, pet_interactions_with_other_animals, pet_specific_behaviors, userId
            ) VALUES (
            :pet_name, :pet_species, :pet_breed, :pet_birthday, :pet_color, :pet_sex, :pet_image, :pet_vaccination_history_name, :pet_vaccination_history_type, :pet_vaccination_history_file, :pet_level_of_sociality, :pet_interactions_with_other_animals, :pet_specific_behaviors, :userId
            )");
    
            $stmt->bindParam(":pet_name",  $pets->pet_name);
            $stmt->bindParam(":pet_species",  $pets->pet_species);
            $stmt->bindParam(":pet_breed",  $pets->pet_breed);
            $stmt->bindParam(":pet_birthday",  $pets->pet_birthday);
            $stmt->bindParam(":pet_color",  $pets->pet_color);
            $stmt->bindParam(":pet_sex",  $pets->pet_sex);
            $stmt->bindParam(":pet_image",  $pets->pet_image);
            $stmt->bindParam(":pet_vaccination_history_name",  $pets->pet_vaccination_history_name);
            $stmt->bindParam(":pet_vaccination_history_type",  $pets->pet_vaccination_history_type);
            $stmt->bindParam(":pet_vaccination_history_file",  $pets->pet_vaccination_history_file);
            $stmt->bindParam(":pet_level_of_sociality",  $pets->pet_level_of_sociality);
            $stmt->bindParam(":pet_interactions_with_other_animals",  $pets->pet_interactions_with_other_animals);
            $stmt->bindParam(":pet_specific_behaviors",  $pets->pet_specific_behaviors);
            $stmt->bindParam(":userId",  $pets->userId);
    
            $stmt->execute();
    
            $this->message->setMessage("Pet cadastrado com sucesso!", "success", "index.php");

    }
    public function update(Pet $pets) {

        $stmt = $this->conn->prepare("UPDATE pets SET 
        pet_name = :pet_name,
        pet_species = :pet_species,
        pet_breed = :pet_breed,
        pet_birthday = :pet_birthday,
        pet_color = :pet_color,
        pet_sex = :pet_sex,
        pet_image = :pet_image,
        pet_vaccination_history_name = :pet_vaccination_history_name,
        pet_vaccination_history_type = :pet_vaccination_history_type,
        pet_vaccination_history_file = :pet_vaccination_history_file,
        pet_level_of_sociality = :pet_level_of_sociality,
        pet_interactions_with_other_animals = :pet_interactions_with_other_animals,
        pet_specific_behaviors = :pet_specific_behaviors,
        WHERE pet_id = :pet_id
      ");

            $stmt->bindParam(":pet_name",  $pets->pet_name);
            $stmt->bindParam(":pet_species",  $pets->pet_species);
            $stmt->bindParam(":pet_breed",  $pets->pet_breed);
            $stmt->bindParam(":pet_birthday",  $pets->pet_birthday);
            $stmt->bindParam(":pet_color",  $pets->pet_color);
            $stmt->bindParam(":pet_sex",  $pets->pet_sex);
            $stmt->bindParam(":pet_image",  $pets->pet_image);
            $stmt->bindParam(":pet_vaccination_history_name",  $pets->pet_vaccination_history_name);
            $stmt->bindParam(":pet_vaccination_history_type",  $pets->pet_vaccination_history_type);
            $stmt->bindParam(":pet_vaccination_history_file",  $pets->pet_vaccination_history_file);
            $stmt->bindParam(":pet_level_of_sociality",  $pets->pet_level_of_sociality);
            $stmt->bindParam(":pet_interactions_with_other_animals",  $pets->pet_interactions_with_other_animals);
            $stmt->bindParam(":pet_specific_behaviors",  $pets->pet_specific_behaviors);
            $stmt->bindParam(":pet_id",  $pets->pet_id);

      $stmt->execute();

      $this->message->setMessage("As informações de seu pet foram atualizadas com sucesso!", "success", "index.php");

    }
    public function destroy($pet_id) {

        $stmt = $this->conn->prepare("DELETE FROM pet WHERE pet_id = :pet_id");

        $stmt->bindParam("pet_id", $pet_id);
    
        $stmt->execute();
    
        $this->message->setMessage("Pet removido de sua lista de pets com sucesso!", "success", "my_jobs.php");
    }

}
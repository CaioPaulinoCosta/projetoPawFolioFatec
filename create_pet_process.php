<?php 

require_once("config/globals.php");
require_once("config/db.php");
require_once("models/Pet.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");
require_once("dao/PetDAO.php");

date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_TIME, 'pt_BR.utf8');

$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
$petDao = new PetDAO($conn, $BASE_URL);

// Pega o tipo do formulario
$type = filter_input(INPUT_POST, "type");

// Resgata dados do usuario
$userData = $userDao->verifyToken();

if($type === "create") {

    // Recebe dados do input
    $pet_name = filter_input(INPUT_POST, "pet_name");
    $pet_species = filter_input(INPUT_POST, "pet_species");
    $pet_breed = filter_input(INPUT_POST, "pet_breed");
    $pet_birthday = filter_input(INPUT_POST, "pet_birthday");
    $pet_color = filter_input(INPUT_POST, "pet_color");
    $pet_sex = filter_input(INPUT_POST, "pet_sex");
    $pdf_file = filter_input(INPUT_POST, "pet_vaccination_history_file");
    $pet_level_of_sociality = filter_input(INPUT_POST, "pet_level_of_sociality");
    $pet_interactions_with_other_animals = filter_input(INPUT_POST, "pet_interactions_with_other_animals");
    $pet_specific_behaviors = filter_input(INPUT_POST, "pet_specific_behaviors");

    $pet = new Pet();

    // Valida dados minimos
    if(!empty($pet_name && $pet_species && $pet_breed && $pet_birthday && $pet_color && $pet_sex && $pet_level_of_sociality && $pet_interactions_with_other_animals && $pet_specific_behaviors)) {

    $pet->pet_name = $pet_name;
    $pet->pet_species = $pet_species;
    $pet->pet_birthday = $pet_birthday;
    $pet->pet_color = $pet_color;
    $pet->pet_sex = $pet_sex;
    $pet->pet_level_of_sociality = $pet_level_of_sociality;
    $pet->pet_interactions_with_other_animals = $pet_interactions_with_other_animals;
    $pet->pet_specific_behaviors = $pet_specific_behaviors;
    $pet->userId = $userData->user_id;

    // Upload de imagem do filme
    if(isset($_FILES["pet_image"]) && !empty($_FILES["pet_image"]["tmp_name"])) {

    $image = $_FILES["pet_image"];
    $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
    $jpgArray = ["image/jpeg", "image/jpg"];

    // Checa o tipo da imagem 
    if (in_array($image["type"], $imageTypes)) {
        if (in_array($image["type"], $jpgArray)) {
            $imageFile = imagecreatefromjpeg($image["tmp_name"]);
        } else {
            if (getimagesize($image["tmp_name"]) !== false) {
                $imageFile = imagecreatefrompng($image["tmp_name"]);
            } else {
                $message->setMessage("Arquivo PNG inválido!", "error", "index.php");
            }
        } 

        if ($imageFile) {
            $imageName = $pet->imageGenerateName();
            imagejpeg($imageFile, "./img/pets/" . $imageName, 100);
            $pet->pet_image = $imageName;
        }
    } else {
        $message->setMessage("Tipo inválido de imagem, insira png ou jpg!", "error", "index.php");
    }


    } 

    if(isset($_FILES['pet_vaccination_history_file']) && $_FILES['pet_vaccination_history_file']['error'] === UPLOAD_ERR_OK) {
        $pdf_name = $_FILES['pet_vaccination_history_file']['name']; // Nome do arquivo
        $pdf_tmp_name = $_FILES['pet_vaccination_history_file']['tmp_name']; // Nome temporário do arquivo
        $pdf_type = $_FILES['pet_vaccination_history_file']['type']; // Tipo do arquivo
    
        // Move o arquivo para o local desejado
        $destination = 'files/vaccination_history/' . $pdf_name;
        move_uploaded_file($pdf_tmp_name, $destination);

        $pet->pet_vaccination_history_name = $pdf_name;
        $pet->pet_vaccination_history_type  = $pdf_type;
        $pet->pet_vaccination_history_file  = $destination;
    }

    $petDao->create($pet);

    } else {

    $message->setMessage("Você precisa preencher todos os campos!", "error", "back");

    }

}  else {

    $message->setMessage("Informações inválidas!", "error", "index.php");

  }
<?php
require_once("templates/Header.php");

// User
require_once("models/User.php");
require_once("dao/UserDAO.php");
require_once("dao/PetDAO.php");

$user = new User();
$userDao = new UserDao($conn, $BASE_URL);
$petDao = new PetDAO($conn, $BASE_URL);

$userData = $userDao->verifyToken(true);

$userPets = $petDao->getPetByUserId($userData->user_id);

?>

<div class="container-fluid create-pet m-0 p-0">
    <div class="create-pet-bg"></div>
    <div class="container d-flex justify-content-center">
        <div class="create-pet-form-container">
            <div class="create-pet-container-header text-center mt-3 mb-3">
                <h2>Marque um agendamento</h2>
                <p>Preencha o formulário abaixo para marcar um agendamento em nosso pet shop.</p>
            </div>
            <div class="d-flex justify-content-center mb-3">
                <div class="separator-create-pet-form"></div>
            </div>

            <div class="create-pet-form">
                <form action="<?= $BASE_URL ?>create_schedule_process.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="type" value="create">
                    <div class="row">
                        <div class="col-6 mt-3">
                            <label for="">Nome do pet</label>
                            <select name="schedule_pet_name" id="" class="form-control">
                            <option value="">Escolha</option>
                            <?php foreach($userPets as $pet): ?>
                                <option value="<?= $pet->pet_name ?>"><?= $pet->pet_name ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mt-3">
                            <label for="">Tipo de serviço</label>
                            <select name="schedule_service_type" id="" class="form-control">
                                <option value="">Escolha</option>
                                <option value="Tosa">Tosa</option>
                                <option value="Banho">Banho</option>
                                <option value="Serviços_veterinários">Serviços veterinários</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-6 mt-3">
                                <label for="">Data do agendamento</label>
                                <input type="date" class="form-control" id="datePicker" name="schedule_date">
                            </div>
                        </div>
                        <div class="row" id="horarioRow" style="display: none;">
                            <div class="col-6 mt-3">
                                <label for="">Horario do agendamento</label>
                                <select name="schedule_time" id="horario" class="form-control">
                                    <option value="">Selecione um horário</option>
                                    <!-- Loop para criar as opções de horário -->
                                    <?php
                                    $inicio = strtotime('08:00'); // Converte o horário para um timestamp
                                    $fim = strtotime('19:00'); // Converte o horário para um timestamp

                                    while ($inicio <= $fim) {
                                        $horario = date('H:i', $inicio); // Converte o timestamp para o formato de hora
                                        echo '<option value="' . $horario . '">' . $horario . '</option>';
                                        $inicio += 30 * 60; // Adiciona 30 minutos em segundos
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mt-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="schedule_conclusion" id="retirada" value="retirada" onclick="togglePaymentForm(false)">
                                    <label class="form-check-label" for="retirada">
                                        Vou retirar no petshop
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="schedule_conclusion" id="entrega" value="entrega" onclick="togglePaymentForm(true)">
                                    <label class="form-check-label" for="entrega">
                                        Quero que entregue em minha casa
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="paymentRow" style="display: none;">
                            <div class="col-6 mt-3">
                                <label for="">Forma de pagamento</label>
                                <select name="schedule_payment_method" id="" class="form-control">
                                    <option value="">Escolha</option>
                                    <option value="Cartão_de_crédito">Cartão de crédito</option>
                                    <option value="Cartão_de_débito">Cartão de débito</option>
                                    <option value="Dinheiro">Dinheiro</option>
                                    <option value="PIX">PIX</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <button class="btn">Agendar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="js/create_schedule.js"></script>



<?php
require_once("templates/Footer.php")
?>
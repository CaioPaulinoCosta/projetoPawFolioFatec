<?php
require_once("templates/Header.php")
?>

<div class="container-fluid create-pet m-0 p-0">
    <div class="create-pet-bg"></div>
    <div class="container d-flex justify-content-center">
        <div class="create-pet-form-container">
            <div class="create-pet-container-header text-center mt-3 mb-3">
                <h2>Cadastre seu pet</h2>
                <p>Preencha o formulário abaixo com os dados de seu pet para o cadastralo em nosso pet shop.</p>
            </div>
            <div class="d-flex justify-content-center mb-3">
                <div class="separator-create-pet-form"></div>
            </div>

            <div class="create-pet-form">
                <form action="<?= $BASE_URL ?>create_pet_process.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="type" value="create">
                    <div class="row">

                        <h4>Identificação</h4>

                        <div class="col-6">
                            <label for="" class="mt-3">Nome</label>
                            <input type="text" class="form-control" placeholder="Digite o nome de seu pet..." name="pet_name">
                        </div>
                        <div class="col-6">
                            <label for="" class="mt-3">Espécie</label>
                            <input type="text" class="form-control" placeholder="Digite a espécie de seu pet..." name="pet_species">
                        </div>
                        <div class="col-6">
                            <label for="" class="mt-3">Raça</label>
                            <input type="text" class="form-control" placeholder="Digite a raça de seu pet..." name="pet_breed">
                        </div>

                        <div class="col-6">
                            <label for="" class="mt-3">Data de nascimento</label>
                            <input type="text" class="form-control" placeholder="Digite a data de nascimento de seu pet..." name="pet_birthday">
                        </div>
                        <div class="col-6">
                            <label for="" class="mt-3">Cor</label>
                            <input type="text" class="form-control" placeholder="Digite a cor de seu pet..." name="pet_color">
                        </div>
                        <div class="col-12">
                            <div class="create-pet-image-preview mt-3"></div>
                            <label for="" class="mt-3">Imagem</label>
                            <div class="row">
                                <div class="col-6">
                                    <small>Envie uma imagem de seu pet</small>
                                <input type="file" class="form-control" id="imageInput" name="pet_image">
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mt-3">
                            <label for="">Sexo</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pet_sex" id="flexRadioDefault1" value="Macho">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Macho
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pet_sex" id="flexRadioDefault2" value="Fêmea">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Fêmeas
                                </label>
                            </div>
                        </div>


                    </div>

                    <div class="row mt-3">

                        <h4>Documentação</h4>

                        <div class="col-6">
                            <label for="">Histórico de vacinações</label>
                            <input type="file" class="form-control mt-3" name="pet_vaccination_history_file">
                        </div>

                    </div>

                    <div class="row mt-3">

                        <h4>Comportamento e Temperamento</h4>

                        <div class="col-10">
                            <div class="form-floating mt-3">
                                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" style="height: 200px;" name="pet_level_of_sociality"></textarea>
                                <label for="floatingTextarea">Nível de sociabilidade (amigável, tímido, agressivo com estranhos, etc.)</label>
                            </div>
                        </div>

                        <div class="col-10">
                            <div class="form-floating mt-3">
                                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" style="height: 200px;" name="pet_interactions_with_other_animals"></textarea>
                                <label for="floatingTextarea">Interações com outros animais</label>
                            </div>
                        </div>

                        <div class="col-10">
                            <div class="form-floating mt-3">
                                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" style="height: 200px;" name="pet_specific_behaviors"></textarea>
                                <label for="floatingTextarea">Comportamentos específicos (latir muito, rosnar, miar alto, etc.)</label>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">
                                <button class="btn">Cadastrar pet</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="js/create_pet.js"></script>

<?php
require_once("templates/Footer.php")
?>
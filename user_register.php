<?php
require_once("templates/Header.php")
?>

<div class="container-fluid register">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 register-form">
                <div class="register-header text-center">
                    <h2>Seja bem-vindo!</h2>
                    <p>Preencha o formulário abaixo para se registrar em nosso site.</p>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="separator-register"></div>
                </div>
                <div class="row">
                    <div class="col">
                        <form action="<?= $BASE_URL ?>user_auth.php" method="POST">
                        <input type="hidden" name="type" value="register">
                            <div class="register-form-card d-flex justify-content-center">

                                <div class="d-block text-center" style="width: 80%;">
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="text" name="user_name" class="form-control mt-3" placeholder="Nome:">
                                        </div>
                                        <div class="col-6">
                                            <input type="text" name="user_lastname" class="form-control mt-3" placeholder="Sobrenome:">
                                        </div>
                                        <div class="col-6">
                                            <input type="text" name="user_birthday" class="form-control mt-3" placeholder="Data de nascimento:" id="user_birthday">
                                        </div>
                                        <div class="col-6">
                                            <input type="text" name="user_phone" class="form-control mt-3" placeholder="Telefone:" id="user_phone">
                                        </div>
                                        <div class="col-12">
                                            <input type="text" name="user_cpf" class="form-control mt-3" placeholder="CPF:" id="user_cpf">
                                        </div>
                                        <div class="col-6">
                                            <select name="user_state" class="form-control mt-3" id="">
                                                <option value="">Estado</option>
                                                <option value="AC">Acre</option>
                                                <option value="AL">Alagoas</option>
                                                <option value="AP">Amapá</option>
                                                <option value="AM">Amazonas</option>
                                                <option value="BA">Bahia</option>
                                                <option value="CE">Ceará</option>
                                                <option value="DF">Distrito Federal</option>
                                                <option value="ES">Espírito Santo</option>
                                                <option value="GO">Goiás</option>
                                                <option value="MA">Maranhão</option>
                                                <option value="MT">Mato Grosso</option>
                                                <option value="MS">Mato Grosso do Sul</option>
                                                <option value="MG">Minas Gerais</option>
                                                <option value="PA">Pará</option>
                                                <option value="PB">Paraíba</option>
                                                <option value="PR">Paraná</option>
                                                <option value="PE">Pernambuco</option>
                                                <option value="PI">Piauí</option>
                                                <option value="RJ">Rio de Janeiro</option>
                                                <option value="RN">Rio Grande do Norte</option>
                                                <option value="RS">Rio Grande do Sul</option>
                                                <option value="RO">Rondônia</option>
                                                <option value="RR">Roraima</option>
                                                <option value="SC">Santa Catarina</option>
                                                <option value="SP">São Paulo</option>
                                                <option value="SE">Sergipe</option>
                                                <option value="TO">Tocantins</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <input type="text" name="user_city" class="form-control mt-3" placeholder="Cidade:">
                                        </div>
                                        <div class="col-12">
                                            <input type="text" name="user_adress" class="form-control mt-3" placeholder="Endereço:">
                                        </div>
                                        <div class="col-12">
                                            <input type="text" name="user_email" class="form-control mt-3" placeholder="Email:" id="user_email">
                                            <p class="mt-3" id="email_error">Insira um email válido.</p>
                                        </div>
                                        <div class="col-12">
                                            <input type="password" name="user_password" class="form-control mt-3" placeholder="Senha:" id="user_password">
                                            <p class="mt-3" id="password_error">A senha deve conter pelo menos 1 caractere especial, 1 letra maiúscula e 1 número.</p>
                                        </div>
                                        <div class="col-12">
                                            <input type="password" name="confirmpassword" class="form-control mt-3" placeholder="Confirmar Senha:" id="user_password">
                                            <p class="mt-3" id="password_error">A senha deve conter pelo menos 1 caractere especial, 1 letra maiúscula e 1 número.</p>
                                        </div>
                                    </div>
                                    <div class="d-grid gap-2">
                                    <button class="btn mt-3" id="entrarButton" disabled>Cadastrar</button>
                                    </div>
                                    <p>Já possui uma conta? <a href="user_login.php">Clique aqui</a> para entrar agora mesmo.</p>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/user_register.js"></script>

<?php
require_once("templates/Footer.php")
?>
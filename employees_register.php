<?php
require_once("templates/Header.php")
?>

<div class="container-fluid register">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 register-form">
                <div class="register-header text-center">
                    <h2>Cadastro de funcionário</h2>
                    <p>Preencha o formulário abaixo para criar seu cadastro como funcionário.</p>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="separator-register"></div>
                </div>
                <div class="row">
                    <div class="col">
                        <form action="<?= $BASE_URL ?>employees_auth.php" method="POST">
                        <input type="hidden" name="type" value="register">
                            <div class="register-form-card d-flex justify-content-center">

                                <div class="d-block text-center" style="width: 80%;">
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="text" name="employees_name" class="form-control mt-3" placeholder="Nome:">
                                        </div>
                                        <div class="col-6">
                                            <input type="text" name="employees_lastname" class="form-control mt-3" placeholder="Sobrenome:">
                                        </div>
                                        <div class="col-6">
                                            <input type="text" name="employees_cpf" class="form-control mt-3" placeholder="CPF:" id="employee_cpf">
                                        </div>
                                        <div class="col-6">
                                            <input type="text" name="employees_registration" class="form-control mt-3" placeholder="Registro:">
                                        </div>
                                        <div class="col-12">
                                            <input type="text" name="employees_email" class="form-control mt-3" placeholder="Email:" id="employee_email">
                                            <p class="mt-3" id="email_error_employee">Insira um email válido.</p>
                                        </div>
                                        <div class="col-12">
                                            <input type="password" name="employees_password" class="form-control mt-3" placeholder="Senha:" id="employee_password">
                                            <p class="mt-3" id="password_error_employee">A senha deve conter pelo menos 1 caractere especial, 1 letra maiúscula e 1 número.</p>
                                        </div>
                                        <div class="col-12">
                                            <input type="password" name="confirmpassword" class="form-control mt-3" placeholder="Confirmar Senha:" id="employees_password">
                                            <p class="mt-3" id="password_error_employees">A senha deve conter pelo menos 1 caractere especial, 1 letra maiúscula e 1 número.</p>
                                        </div>
                                    </div>
                                    <div class="d-grid gap-2">
                                    <button class="btn mt-3" id="loginButtonEmployee" disabled>Cadastrar</button>
                                    </div>
                                    <p>Já possui uma conta? <a href="employees_login.php">Clique aqui</a> para entrar agora mesmo.</p>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/employees_register.js"></script>

<?php
require_once("templates/Footer.php")
?>
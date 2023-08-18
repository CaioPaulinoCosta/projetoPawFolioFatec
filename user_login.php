<?php
require_once("templates/Header.php")
?>

<div class="container-fluid login-register">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 login-form">
                <div class="login-header text-center">
                    <h2>Seja bem-vindo!</h2>
                    <p>Faça o login para acessar sua conta.</p>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="separator-login"></div>
                </div>
                <div class="row">
                    <div class="col">
                        <form action="<?= $BASE_URL ?>user_auth.php" method="POST">
                            <input type="hidden" name="type" value="login">
                            <div class="login-form-card d-flex justify-content-center">
                                <div class="d-block text-center" style="width: 40%;">
                                    <input type="text" name="user_email" class="form-control mt-3" placeholder="Email:">
                                    <input type="password" name="user_password" class="form-control mt-3" placeholder="Senha:">
                                    <div class="d-grid gap-2">
                                        <button class="btn mt-3">Entrar</button>
                                    </div>
                                    <p>Ainda não tem uma conta? <a href="user_register.php">Clique aqui</a> para criar uma.</p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once("templates/Footer.php")
?>
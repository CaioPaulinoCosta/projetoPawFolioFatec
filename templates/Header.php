<?php

require_once("config/globals.php");
require_once("config/db.php");
require_once("models/Message.php");

// User 
require_once("dao/UserDAO.php");

$message = new Message($BASE_URL);

$flassMessage = $message->getMessage();

if (!empty($flassMessage["msg"])) {
  // Limpar a mensagem
  $message->clearMessage();
}

$userDao = new UserDAO($conn, $BASE_URL);

$userData = $userDao->verifyToken(false);

// Employees

require_once("dao/EmployeesDAO.php");

$employeesDao = new EmployeesDAO($conn, $BASE_URL);

$employeesData = $employeesDao->verifyToken(false);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="short icon" href="img/logo.png" />

  <!-- CSS DO PROJETO -->
  <link rel="stylesheet" href="css/styles.css">
  <!-- BOOTSTRAP -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <title>PawFolio</title>
</head>

<body>
  <header>

    <?php if ($userData) : ?>
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="#"><img src="img/logo.png" alt="logo"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav m-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" href="#">Home</a>
              </li>
              <li class="nav-item">
                <span class="nav-link">|</span>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Serviços</a>
              </li>
              <li class="nav-item">
                <span class="nav-link">|</span>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Agenda</a>
              </li>
              <li class="nav-item">
                <span class="nav-link">|</span>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Perfil
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#"><i class="fa-solid fa-calendar-days"></i> Agendamentos</a></li>
                  <li><a class="dropdown-item" href="#"><i class="fa-solid fa-dog"></i> Meus pets</a></li>
                  <li><a class="dropdown-item" href="#"><i class="fa-regular fa-bell"></i> Notificações</a></li>
                  <li><a class="dropdown-item" href="<?= $BASE_URL ?>logout.php"><i class="fa-solid fa-xmark"></i> Sair</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    <?php elseif ($employeesData) : ?>
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="#"><img src="img/logo.png" alt="logo"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav m-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" href="#">Home</a>
              </li>
              <li class="nav-item">
                <span class="nav-link">|</span>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Serviços</a>
              </li>
              <li class="nav-item">
                <span class="nav-link">|</span>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Agenda</a>
              </li>
              <li class="nav-item">
                <span class="nav-link">|</span>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Perfil
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Agendamentos</a></li>
                  <li><a class="nav-link" href="<?= $BASE_URL ?>logout.php">Sair</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    <?php else :  ?>
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="#"><img src="img/logo.png" alt="logo"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav m-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" href="#">Home</a>
              </li>
              <li class="nav-item">
                <span class="nav-link">|</span>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Serviços</a>
              </li>
              <li class="nav-item">
                <span class="nav-link">|</span>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Agenda</a>
              </li>
            </ul>
            <div>
              <a href="<?= $BASE_URL ?>user_login.php"><button class="btn">Entrar</button></a>
              <a href="<?= $BASE_URL ?>user_register.php"><button class="btn">Cadastrar</button></a>
            </div>
          </div>
        </div>
      </nav>
    <?php endif  ?>

  </header>
  <?php if (!empty($flassMessage["msg"])) : ?>
    <div class="msg-container">
      <p class="msg <?= $flassMessage["type"] ?>"><?= $flassMessage["msg"] ?></p>
    </div>
  <?php endif; ?>
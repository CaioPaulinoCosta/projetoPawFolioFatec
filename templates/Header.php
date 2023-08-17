<?php

require_once("config/globals.php");
require_once("config/db.php");

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
              </div>
            </div>
          </nav>
    </header>
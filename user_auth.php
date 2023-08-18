<?php

  require_once("config/globals.php");
  require_once("config/db.php");
  require_once("models/User.php");
  require_once("models/Message.php");
  require_once("dao/UserDAO.php");

  $message = new Message($BASE_URL);

  $userDao = new UserDAO($conn, $BASE_URL);

  // Resgata o tipo do formulário
  $type = filter_input(INPUT_POST, "type");

  // Verificação do tipo de formulário
  if($type === "register") {

    $user_name = filter_input(INPUT_POST, "user_name");
    $user_lastname = filter_input(INPUT_POST, "user_lastname");
    $user_birthday = filter_input(INPUT_POST, "user_birthday");
    $user_email = filter_input(INPUT_POST, "user_email");
    $user_phone = filter_input(INPUT_POST, "user_phone");
    $user_cpf = filter_input(INPUT_POST, "user_cpf");
    $user_city = filter_input(INPUT_POST, "user_city");
    $user_state = filter_input(INPUT_POST, "user_state");
    $user_adress = filter_input(INPUT_POST, "user_adress");
    $user_password = filter_input(INPUT_POST, "user_password");
    $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

    if($user_name && $user_lastname && $user_birthday &&  $user_email && $user_password && $user_phone && $user_cpf && $user_city && $user_state && $user_adress) {

      if($user_password === $confirmpassword) {

        // Verificar se o e-mail já está cadastrado no sistema
        if($userDao->findByEmail($user_email) === false) {

          $user = new User();

          // Criação de token e senha
          $userToken = $user->generateToken();
          $finalPassword = $user->generatePassword($user_password);

          $user->user_name = $user_name;
          $user->user_lastname = $user_lastname;
          $user->user_birthday = $user_birthday;
          $user->user_email = $user_email;
          $user->user_phone = $user_phone;
          $user->user_cpf = $user_cpf;
          $user->user_city = $user_city;
          $user->user_state = $user_state;
          $user->user_adress = $user_adress;
          $user->user_password = $finalPassword;
          $user->user_token = $userToken;

          $auth = true;

          $userDao->create($user, $auth);

        } else {
          
          // Enviar uma msg de erro, usuário já existe
          $message->setMessage("Usuário já cadastrado, tente outro e-mail.", "error", "back");

        }

      } else {

        // Enviar uma msg de erro, de senhas não batem
        $message->setMessage("As senhas não são iguais.", "error", "back");

      }

    } else {

      // Enviar uma msg de erro, de dados faltantes
      $message->setMessage("Por favor, preencha todos os campos.", "error", "back");

    }

  } else if($type === "login") {

    $user_email = filter_input(INPUT_POST, "user_email");
    $user_password = filter_input(INPUT_POST, "user_password");

    // Tenta autenticar usuário
    if($userDao->authenticateUser($user_email, $user_password)) {

      $message->setMessage("Seja bem-vindo!", "success", "index.php");

    // Redireciona o usuário, caso não conseguir autenticar
    } else {

      $message->setMessage("Usuário e/ou senha incorretos.", "error", "back");

    }

  } else {

    $message->setMessage("Informações inválidas!", "error", "index.php");

  }
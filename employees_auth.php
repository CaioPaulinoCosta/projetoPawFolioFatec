<?php

  require_once("config/globals.php");
  require_once("config/db.php");
  require_once("models/Employees.php");
  require_once("models/Message.php");
  require_once("dao/EmployeesDAO.php");

  $message = new Message($BASE_URL);

  $employeesDao = new EmployeesDAO($conn, $BASE_URL);

  // Resgata o tipo do formulário
  $type = filter_input(INPUT_POST, "type");

  // Verificação do tipo de formulário
  if($type === "register") {

    $employees_name = filter_input(INPUT_POST, "employees_name");
    $employees_lastname = filter_input(INPUT_POST, "employees_lastname");
    $employees_email = filter_input(INPUT_POST, "employees_email");
    $employees_password = filter_input(INPUT_POST, "employees_password");
    $employees_cpf = filter_input(INPUT_POST, "employees_cpf");
    $employees_registration = filter_input(INPUT_POST, "employees_registration");
    $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

    if($employees_name && $employees_lastname && $employees_email &&  $employees_password && $employees_cpf && $employees_registration && $confirmpassword) {

      if($employees_password === $confirmpassword) {

        // Verificar se o e-mail já está cadastrado no sistema
        if($employeesDao->findByEmail($employees_email) === false) {

          $employee = new Employees();

          // Criação de token e senha
          $employeeToken = $employee->generateToken();
          $finalPassword = $employee->generatePassword($employees_password);

          $employee->employees_name = $employees_name;
          $employee->employees_lastname = $employees_lastname;
          $employee->employees_email = $employees_email;
          $employee->employees_password = $employees_password;
          $employee->employees_cpf = $employees_cpf;
          $employee->employees_registration = $employees_registration;
          $employee->employees_password = $finalPassword;
          $employee->employees_token = $employeeToken;

          $auth = true;

          $employeesDao->create($employee, $auth);

        } else {
          
          // Enviar uma msg de erro, usuário já existe
          $message->setMessage("Funcionário já cadastrado, tente outro e-mail.", "error", "back");

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

    $employees_email = filter_input(INPUT_POST, "employees_email");
    $employees_password = filter_input(INPUT_POST, "employees_password");

    // Tenta autenticar usuário
    if($employeesDao->authenticateEmployees($employees_email, $employees_password)) {

      $message->setMessage("Seja bem-vindo!", "success", "index.php");

    // Redireciona o usuário, caso não conseguir autenticar
    } else {

      $message->setMessage("Usuário e/ou senha incorretos.", "error", "back");

    }

  } else {

    $message->setMessage("Informações inválidas!", "error", "index.php");

  }
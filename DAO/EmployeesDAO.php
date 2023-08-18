<?php

  require_once("models/Employees.php");
  require_once("models/Message.php");

  class EmployeesDAO implements EmployeesDAOInterface {

    private $conn;
    private $url;
    private $message;

    public function __construct(PDO $conn, $url) {
      $this->conn = $conn;
      $this->url = $url;
      $this->message = new Message($url);
    }

    public function buildEmployees($data) {

      $employees = new Employees();

      $employees->employees_id = $data["employees_id"];
      $employees->employees_name = $data["employees_name"];
      $employees->employees_lastname = $data["employees_lastname"];
      $employees->employees_email = $data["employees_email"];
      $employees->employees_password = $data["employees_password"];
      $employees->employees_cpf = $data["employees_cpf"];
      $employees->employees_registration = $data["employees_registration"];
      $employees->employees_token = $data["employees_token"];

      return $employees;

    }

    public function create(Employees $employees,$authEmployees = false) {

      $stmt = $this->conn->prepare("INSERT INTO employees (
          employees_name, employees_lastname, employees_email, employees_password, employees_cpf, employees_registration, employees_token 
        ) VALUES (
            :employees_name, :employees_lastname, :employees_email, :employees_password, :employees_cpf, :employees_registration, :employees_token
        )");

      $stmt->bindParam(":employees_name", $employees->employees_name);
      $stmt->bindParam(":employees_lastname", $employees->employees_lastname);
      $stmt->bindParam(":employees_email", $employees->employees_email);
      $stmt->bindParam(":employees_password", $employees->employees_password);
      $stmt->bindParam(":employees_cpf", $employees->employees_cpf);
      $stmt->bindParam(":employees_registration", $employees->employees_registration);
      $stmt->bindParam(":employees_token", $employees->employees_token);

      $stmt->execute();

      if($authEmployees) {
        $this->setTokenToSession($employees->employees_token);
      }

    }

    public function update(Employees $employees, $redirect = true) {

        $stmt = $this->conn->prepare("UPDATE employees SET
        employees_name = :employees_name,
        employees_lastname = :employees_lastname,
        employees_email = :employees_email,
        employees_password = :employees_password,
        employees_cpf = :employees_cpf,
        employees_registration = :employees_registration,
        employees_token = :employees_token
        WHERE employees_id = :employees_id
      ");

      $stmt->bindParam(":employees_name", $employees->employees_name);
      $stmt->bindParam(":employees_lastname", $employees->employees_lastname);
      $stmt->bindParam(":employees_email", $employees->employees_email);
      $stmt->bindParam(":employees_password", $employees->employees_password);
      $stmt->bindParam(":employees_cpf", $employees->employees_cpf);
      $stmt->bindParam(":employees_registration", $employees->employees_registration);
      $stmt->bindParam(":employees_token", $employees->employees_token);
      $stmt->bindParam(":employees_id", $employees->employees_id);


      $stmt->execute();

      if($redirect) {

        // Redireciona para o perfil do usuario
        $this->message->setMessage("Dados atualizados com sucesso!", "success", "index.php");

      }

    }

    public function verifyToken($protected = false) {

      if(!empty($_SESSION["token"])) {

        // Pega o token da session
        $employees_token = $_SESSION["token"];

        $employees = $this->findByToken($employees_token);

        if($employees) {
          return $employees;
        } else if($protected) {

          // Redireciona usuário não autenticado
          $this->message->setMessage("Faça a autenticação para acessar esta página!", "error", "index.php");

        }

      } else if($protected) {

        // Redireciona usuário não autenticado
        $this->message->setMessage("Faça a autenticação para acessar esta página!", "error", "index.php");

      }

    }

    public function setTokenToSession($employees_token, $redirect = true) {

      // Salvar token na session
      $_SESSION["token"] = $employees_token;

      if($redirect) {

        // Redireciona para o perfil do usuario
        $this->message->setMessage("Seja bem-vindo!", "success", "index.php");

      }

    }

    public function authenticateEmployees($employees_email, $employees_password) {

        $employees = $this->findByEmail($employees_email);
  
        if($employees) {
  
          // Checar se as senhas batem
          if(password_verify($employees_password, $employees->employees_password)) {
  
            // Gerar um token e inserir na session
            $token = $employees->generateToken();
  
            $this->setTokenToSession($token, false);
  
            // Atualizar token no usuário
            $employees->employees_token = $token;
  
            $this->update($employees, false);
  
            return true;
  
          } else {
            return false;
          }
  
        } else {
  
          return false;
  
        }
  
      }

    public function findByEmail($employees_email) {

        if($employees_email != "") {

            $stmt = $this->conn->prepare("SELECT * FROM employees WHERE employees_email = :employees_email");
    
            $stmt->bindParam(":employees_email", $employees_email);
    
            $stmt->execute();
    
            if($stmt->rowCount() > 0) {
    
              $data = $stmt->fetch();
              $employees = $this->buildEmployees($data);
              
              return $employees;
    
            } else {
              return false;
            }
    
          } else {
            return false;
          }

    }

    public function findById($id) {
    }

    public function findByToken($employees_token) {

      if($employees_token != "") {

        $stmt = $this->conn->prepare("SELECT * FROM employees WHERE employees_token = :employees_token");

        $stmt->bindParam(":employees_token", $employees_token);

        $stmt->execute();

        if($stmt->rowCount() > 0) {

          $data = $stmt->fetch();
          $employees = $this->buildEmployees($data);
          
          return $employees;

        } else {
          return false;
        }

      } else {
        return false;
      }

    }

    public function destroyToken() {

      // Remove o token da session
      $_SESSION["token"] = "";

      // Redirecionar e apresentar a mensagem de sucesso
      $this->message->setMessage("Você fez o logout com sucesso!", "success", "index.php");

    }

    public function changePassword(Employees $employees) {

    }

  }
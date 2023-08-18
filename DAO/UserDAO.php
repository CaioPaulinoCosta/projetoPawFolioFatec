<?php

  require_once("models/User.php");
  require_once("models/Message.php");

  class UserDAO implements UserDAOInterface {

    private $conn;
    private $url;
    private $message;

    public function __construct(PDO $conn, $url) {
      $this->conn = $conn;
      $this->url = $url;
      $this->message = new Message($url);
    }

    public function buildUser($data) {

      $user = new User();

      $user->user_id = $data["user_id"];
      $user->user_name = $data["user_name"];
      $user->user_lastname = $data["user_lastname"];
      $user->user_email = $data["user_email"];
      $user->user_password = $data["user_password"];
      $user->user_birthday = $data["user_birthday"];
      $user->user_phone = $data["user_phone"];
      $user->user_cpf = $data["user_cpf"];
      $user->user_city = $data["user_city"];
      $user->user_state = $data["user_state"];
      $user->user_adress = $data["user_adress"];
      $user->user_token = $data["user_token"];

      return $user;

    }

    public function create(User $user, $authUser = false) {

      $stmt = $this->conn->prepare("INSERT INTO users(
          user_name, user_lastname, user_email, user_password, user_birthday, user_phone, user_cpf, user_city, user_state, user_adress, user_token
        ) VALUES (
            :user_name, :user_lastname, :user_email, :user_password, :user_birthday, :user_phone, :user_cpf, :user_city, :user_state, :user_adress, :user_token
        )");

      $stmt->bindParam(":user_name", $user->user_name);
      $stmt->bindParam(":user_lastname", $user->user_lastname);
      $stmt->bindParam(":user_email", $user->user_email);
      $stmt->bindParam(":user_password", $user->user_password);
      $stmt->bindParam(":user_birthday", $user->user_birthday);
      $stmt->bindParam(":user_phone", $user->user_phone);
      $stmt->bindParam(":user_cpf", $user->user_cpf);
      $stmt->bindParam(":user_city", $user->user_city);
      $stmt->bindParam(":user_state", $user->user_state);
      $stmt->bindParam(":user_adress", $user->user_adress);
      $stmt->bindParam(":user_token", $user->user_token);

      $stmt->execute();

      if($authUser) {
        $this->setTokenToSession($user->user_token);
      }

    }

    public function update(User $user, $redirect = true) {

        $stmt = $this->conn->prepare("UPDATE users SET
        user_name = :user_name,
        user_lastname = :user_lastname,
        user_email = :user_email,
        user_password = :user_password,
        user_birthday = :user_birthday,
        user_phone = :user_phone,
        user_cpf = :user_cpf,
        user_city = :user_city,
        user_state = :user_state,
        user_adress = :user_adress,
        user_token = :user_token
        WHERE user_id = :user_id
      ");

      $stmt->bindParam(":user_name", $user->user_name);
      $stmt->bindParam(":user_lastname", $user->user_lastname);
      $stmt->bindParam(":user_email", $user->user_email);
      $stmt->bindParam(":user_password", $user->user_password);
      $stmt->bindParam(":user_birthday", $user->user_birthday);
      $stmt->bindParam(":user_phone", $user->user_phone);
      $stmt->bindParam(":user_cpf", $user->user_cpf);
      $stmt->bindParam(":user_city", $user->user_city);
      $stmt->bindParam(":user_state", $user->user_state);
      $stmt->bindParam(":user_adress", $user->user_adress);
      $stmt->bindParam(":user_token", $user->user_token);
      $stmt->bindParam(":user_id", $user->user_id);


      $stmt->execute();

      if($redirect) {

        // Redireciona para o perfil do usuario
        $this->message->setMessage("Dados atualizados com sucesso!", "success", "editprofile.php");

      }

    }

    public function verifyToken($protected = false) {

      if(!empty($_SESSION["token"])) {

        // Pega o token da session
        $user_token = $_SESSION["token"];

        $user = $this->findByToken($user_token);

        if($user) {
          return $user;
        } else if($protected) {

          // Redireciona usuário não autenticado
          $this->message->setMessage("Faça a autenticação para acessar esta página!", "error", "index.php");

        }

      } else if($protected) {

        // Redireciona usuário não autenticado
        $this->message->setMessage("Faça a autenticação para acessar esta página!", "error", "index.php");

      }

    }

    public function setTokenToSession($user_token, $redirect = true) {

      // Salvar token na session
      $_SESSION["token"] = $user_token;

      if($redirect) {

        // Redireciona para o perfil do usuario
        $this->message->setMessage("Seja bem-vindo!", "success", "index.php");

      }

    }

    public function authenticateUser($user_email, $user_password) {

        $user = $this->findByEmail($user_email);
  
        if($user) {
  
          // Checar se as senhas batem
          if(password_verify($user_password, $user->user_password)) {
  
            // Gerar um token e inserir na session
            $token = $user->generateToken();
  
            $this->setTokenToSession($token, false);
  
            // Atualizar token no usuário
            $user->user_token = $token;
  
            $this->update($user, false);
  
            return true;
  
          } else {
            return false;
          }
  
        } else {
  
          return false;
  
        }
  
      }

    public function findByEmail($user_email) {

        if($user_email != "") {

            $stmt = $this->conn->prepare("SELECT * FROM users WHERE user_email = :user_email");
    
            $stmt->bindParam(":user_email", $user_email);
    
            $stmt->execute();
    
            if($stmt->rowCount() > 0) {
    
              $data = $stmt->fetch();
              $user = $this->buildUser($data);
              
              return $user;
    
            } else {
              return false;
            }
    
          } else {
            return false;
          }

    }

    public function findById($id) {
    }

    public function findByToken($user_token) {

      if($user_token != "") {

        $stmt = $this->conn->prepare("SELECT * FROM users WHERE user_token = :user_token");

        $stmt->bindParam(":user_token", $user_token);

        $stmt->execute();

        if($stmt->rowCount() > 0) {

          $data = $stmt->fetch();
          $user = $this->buildUser($data);
          
          return $user;

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

    public function changePassword(User $user) {

    }

  }
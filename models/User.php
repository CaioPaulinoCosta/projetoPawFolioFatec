<?php

  class User {

    public $user_id;
    public $user_name;
    public $user_lastname;
    public $user_email;
    public $user_password;
    public $user_birthday;
    public $user_phone;
    public $user_cpf;
    public $user_city;
    public $user_state;
    public $user_adress;
    public $user_token;

    public function getFullName($user) {
      return $user->user_name . " " . $user->user_lastname;
    }

    public function generateToken() {
      return bin2hex(random_bytes(50));
    }
    
    public function generatePassword($user_password) {
      return password_hash($user_password, PASSWORD_DEFAULT);
    }

  }

  interface UserDAOInterface {

    public function buildUser($data);
    public function create(User $user, $authUser = false);
    public function update(User $user, $redirect = true);
    public function verifyToken($protected = false);
    public function setTokenToSession($user_token, $redirect = true);
    public function authenticateUser($user_email, $user_password);
    public function findByEmail($user_email);
    public function findById($user_id);
    public function findByToken($user_token);
    public function destroyToken();
    public function changePassword(User $user);

  }
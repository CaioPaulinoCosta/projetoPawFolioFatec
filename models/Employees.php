<?php

  class Employees {

    public $employees_id; 
    public $employees_name; 
    public $employees_lastname; 
    public $employees_email; 
    public $employees_password; 
    public $employees_cpf; 
    public $employees_registration; 
    public $employees_token;

    public function getFullName($employees) {
      return $employees->employees_name . " " . $employees->employees_lastname;
    }

    public function generateToken() {
      return bin2hex(random_bytes(50));
    }
    
    public function generatePassword($employees_password) {
      return password_hash($employees_password, PASSWORD_DEFAULT);
    }

  }

  interface EmployeesDAOInterface {

    public function buildEmployees($data);
    public function create(Employees $employees, $authEmployees = false);
    public function update(Employees $employees, $redirect = true);
    public function verifyToken($protected = false);
    public function setTokenToSession($employees_token, $redirect = true);
    public function authenticateEmployees($employees_email, $employees_password);
    public function findByEmail($employees_email);
    public function findById($employees_id);
    public function findByToken($employees_token);
    public function destroyToken();
    public function changePassword(Employees $employees);

  }
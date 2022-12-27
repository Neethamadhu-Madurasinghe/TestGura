<?php

class ModelExampleUsers {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function register($data) {
        $this->db->query('INSERT INTO auth(name, email, password) VALUES (:name, :email, :password)');
        $this->db->bind('name', $data['name'], PDO::PARAM_STR);
        $this->db->bind('email', $data['email'], PDO::PARAM_STR);
        $this->db->bind('password', $data['password'], PDO::PARAM_STR);

        if($this->db->execute()) {
            return true;
        }else {
            return false;
        }
    }

    public function findUserByEmail($email) {
        $this->db->query('SELECT * FROM auth WHERE email=:email');
        $this->db->bind('email', $email, PDO::PARAM_STR);

        $row = $this->db->resultOne();

        if($this->db->rowCount() > 0) {
            return true;
        }else{
            return false;
        }
    }

//    Login the user
    public function login($email, $password) {
        $this->db->query('SELECT * FROM auth WHERE email=:email');
        $this->db->bind('email', $email, PDO::PARAM_STR);

        $row = $this->db->resultOne();

        $hashed_password = $row->password;
        if(password_verify($password, $hashed_password)) {
            return $row;
        }else {
            return false;
        }
    }
}
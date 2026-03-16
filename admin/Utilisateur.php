<?php

class Utilisateur {
    public $id;
    public $email;
    public $username;
    public $password_hash;
    public $role;

    public function __construct($id, $email, $username, $password_hash, $role = "joueur") {
        $this->id = $id;
        $this->email = $email;
        $this->username = $username;
        $this->password_hash = $password_hash;
        $this->role = $role;
    }

    public function isAdmin() {
        return $this->role == "administrateur";
    }
}
<?php

require_once "Utilisateur.php";

class Administrateur {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAll(){
        $listeUsers = [];
        $sql = 'SELECT * FROM utilisateurs';
        $stmt = $this->db->query($sql);
        $donnees = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($donnees as $ligne) {
            $user = new Utilisateur($ligne['id'], $ligne['email'], $ligne['username'], $ligne['password'], $ligne['role']);
            $listeUsers[] = $user;
        }

        return $listeUsers;
    }

    public function add(Utilisateur $user)
    {
        $sql = "INSERT INTO utilisateurs (username, email, password, role) VALUES (:username, :email, :password, :role)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'username' => $user->username,
            'email'    => $user->email,
            'password' => $user->password_hash,
            'role'     => $user->role
        ]);
    }

    public function delete($id) {
        $sql = "DELETE FROM utilisateurs WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'id' => $id,
        ]);
    }

    public function search($motCle) {
        $sql = "SELECT * FROM utilisateurs WHERE username LIKE :motCle";
        $stmt = $this->db->prepare($sql);
        $motCle = "%$motCle%";
        $stmt->bindParam(':motCle', $motCle);
        $stmt->execute();
        $donnees = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $listeResultats = [];
        foreach ($donnees as $ligne) {
            $user = new Utilisateur($ligne['id'], $ligne['email'], $ligne['username'], $ligne['password'], $ligne['role']);
            $listeResultats[] = $user;
        }
        return $listeResultats;
    }
}
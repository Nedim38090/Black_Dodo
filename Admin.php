<?php
require_once "Collaborateur.php";
class Administrateur {
    private $db;
    public function __construct($db) {
        $this->db = $db;
    }
    public function getAll(){

        $listeUtilisateurs = [];
        $sql = 'SELECT * FROM utilisateurs';
        $stmt = $this->db->query($sql);
        $donnees = $stmt->fetchAll(PDO::FETCH_ASSOC);



        foreach ($donnees as $ligne) {
            $utilisateur = new Utilisateurs ($ligne['pseudo'], $ligne['email'], $ligne['mdp'], $ligne['role'], $ligne['idUtilisateur'], $ligne['date_inscription']);
            $listeUtilisateurs[] = $utilisateur;
        }





        return $listeUtilisateurs;
    }
    public function add(Utilisateur $utilisateur)
    {
        $sql = "INSERT INTO utilisateurs (pseudo, email, mdp, role, description, date_inscription) VALUES (:pseudo, :email, :mdp, :role, :description, :date_inscription)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'pseudo' => $utilisateur->getpseudo(),
            'email' => $utilisateur->getemail(),
            'mdp' => $utilisateur->getmotdepasse(),
            'role' => $utilisateur->getrole(),
            'description' => $utilisateur->getdescription(),
            'date_inscription' => $utilisateur->getdateinscription()
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
        $sql = "SELECT * FROM utilisateurs WHERE nom LIKE :motCle";
        $stmt = $this->db->prepare($sql);
        $motCle = "%$motCle%";
        $stmt->bindParam(':motCle', $motCle);
        $stmt->execute();
        $donnees = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $utilisateur = [];
        foreach ($donnees as $ligne) {
            $utilisateur = new Utilisateur($ligne['pseudo'], $ligne['email'], $ligne['role'], $ligne['id'], $ligne['date_inscription']);

            $utilisateurs[] = $utilisateur;
        }
        return $utilisateurs;
    }





}
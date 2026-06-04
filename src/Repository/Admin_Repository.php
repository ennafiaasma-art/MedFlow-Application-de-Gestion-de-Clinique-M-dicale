<?php

class admin_repository 
{
    private PDO $db;
    public function __construct(PDO $dbConnection) 
    {
        $this->db = $dbConnection;
    }
    public function getAllDoctors() 
    {
        $sql = "SELECT m.*, COUNT(r.id) as total_rdv_termines 
                FROM medecins m 
                LEFT JOIN rendez_vous r ON m.id = r.medecin_id AND r.statut = 'termine' 
                GROUP BY m.id";  
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function createDoctor($nom, $email, $specialite_id, $statut)
    {
        $sql = "INSERT INTO medecins (nom, email, specialite_id, statut) VALUES (:nom, :email, :specialite_id, :statut)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nom' => $nom,
            ':email' => $email,
            ':specialite_id' => $specialite_id,
            ':statut' => $statut
        ]);
    }
    public function createSpeciality($nom_specialite, $description)
    {
        try{
            $sql = "INSERT INTO specialites (nom, description) VALUES (:nom, :description)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nom' => $nom_specialite,
            ':description' => $description
        ]);
        }catch(PDOException $e){
            die("auccun createSpeciality" .$e ->getMessage());
        }
        
    }

    public function GetAllspecialite(){
        try{
            $querySpec = "SELECT id, nom FROM specialite ORDER BY nom ASC";
        $stmtSpec = $this->db->prepare($querySpec);
        $stmtSpec->execute();
        $specialites = $stmtSpec->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            die('error ' . $e -> getMessage());
        }
    }
}
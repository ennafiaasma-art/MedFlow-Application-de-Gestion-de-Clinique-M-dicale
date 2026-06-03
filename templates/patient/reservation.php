<?php

require '../config/database.php';

$doctorId = $_GET['id'];

if(isset($_POST['reserver'])){

    $patientId = 1;

    $disponibiliteId = $_POST['disponibilite'];

    $sql = "
    INSERT INTO rendezvous
    (
        statut,
        patient_id,
        disponibilite_id
    )
    VALUES
    (
        'en_attente',
        ?,
        ?
    )
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $patientId,
        $disponibiliteId
    ]);

    echo "Rendez-vous réservé";
}
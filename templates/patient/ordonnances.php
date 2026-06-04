<?php

require '../config/database.php';

$patientId = 1;

$sql = "
SELECT
ordonnance.contenu,
ordonnance.dateCreation

FROM ordonnance

JOIN rendezvous
ON ordonnance.rendezVous_id = rendezvous.id

WHERE rendezvous.patient_id = ?
";

$stmt = $pdo->prepare($sql);

$stmt->execute([$patientId]);

$ordonnances = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($ordonnances as $o){

    echo "<h3>Ordonnance</h3>";

    echo $o['contenu'];

    echo "<hr>";
}
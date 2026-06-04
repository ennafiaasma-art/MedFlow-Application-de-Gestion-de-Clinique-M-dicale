<?php

require '../config/database.php';

$patientId = 1;

$sql = "
SELECT COUNT(*) total
FROM rendezvous
WHERE patient_id = ?
";

$stmt = $pdo->prepare($sql);

$stmt->execute([$patientId]);

$result = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<h1>Dashboard Patient</h1>

<h2>
Nombre de rendez-vous :
<?= $result['total']; ?>
</h2>

<a href="rechercher-medecin.php">
Rechercher médecin
</a>

<br><br>

<a href="mes-rdv.php">
Mes rendez-vous
</a>

<br><br>

<a href="ordonnances.php">
Mes ordonnances
</a>
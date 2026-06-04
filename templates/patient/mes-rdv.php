<?php

require '../config/database.php';

$patientId = 1;

$sql = "
SELECT
rendezvous.id,
rendezvous.statut,
rendezvous.dateCreation,
user.nom

FROM rendezvous

JOIN disponibilite
ON rendezvous.disponibilite_id = disponibilite.id

JOIN doctor
ON disponibilite.id_medcin = doctor.id_doctor

JOIN user
ON doctor.user_id = user.id

WHERE rendezvous.patient_id = ?
";

$stmt = $pdo->prepare($sql);

$stmt->execute([$patientId]);

$rdvs = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<table border='1'>

<tr>
<th>Médecin</th>
<th>Statut</th>
<th>Date</th>
</tr>

<?php foreach($rdvs as $rdv): ?>

<tr>

<td><?= $rdv['nom']; ?></td>

<td><?= $rdv['statut']; ?></td>

<td><?= $rdv['dateCreation']; ?></td>

</tr>

<?php endforeach; ?>

</table>
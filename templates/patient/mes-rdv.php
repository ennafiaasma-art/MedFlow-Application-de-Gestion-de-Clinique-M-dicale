<?php

require '../../config/database.php';

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

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Mes Rendez-vous</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="max-w-6xl mx-auto p-8">

<h1 class="text-4xl font-bold text-center text-green-600 mb-8">
Mes Rendez-vous
</h1>

<div class="bg-white rounded-xl shadow-lg overflow-hidden">

<table class="w-full">

<thead class="bg-green-500 text-white">

<tr>
<th class="p-4">Médecin</th>
<th class="p-4">Statut</th>
<th class="p-4">Date</th>
</tr>

</thead>

<tbody>

<?php foreach($rdvs as $rdv): ?>

<tr class="border-b">

<td class="p-4">
<?= $rdv['nom']; ?>
</td>

<td class="p-4">
<?= $rdv['statut']; ?>
</td>

<td class="p-4">
<?= $rdv['dateCreation']; ?>
</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

</div>

</body>
</html>
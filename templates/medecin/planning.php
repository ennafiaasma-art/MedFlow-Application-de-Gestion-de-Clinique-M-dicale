<?php
require_once '../../config/database.php';

$id_medcin = 1;

$stmt = $pdo->prepare("
SELECT *
FROM rendezvous
JOIN patient ON patient.id_patient = rendezvous.patient_id
JOIN user ON user.id = patient.user_id
JOIN disponibilite ON disponibilite.id = rendezvous.disponibilite_id
WHERE disponibilite.id_medcin = ?
");

$stmt->execute([$id_medcin]);

$couleurs = [
    'en_attente' => 'bg-yellow-100',
    'confirme'   => 'bg-green-100',
    'annule'     => 'bg-red-100',
    'termine'    => 'bg-blue-100'
];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Planning Médecin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-2xl mx-auto mt-6 bg-white p-4 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Planning Médecin</h2>

    <?php foreach($stmt as $r): ?>
        <div class="p-3 mb-2 rounded <?= $couleurs[$r['statut']] ?? 'bg-gray-100' ?>">
            <div class="font-semibold">
                <?=($r['nom']) ?>
            </div>

            <div>
                <?= ($r['date_debut']) ?>
            </div>

            <div class="text-sm">
                <?= ($r['statut']) ?>
            </div>
        </div>
    <?php endforeach; ?>

</div>

</body>
</html>
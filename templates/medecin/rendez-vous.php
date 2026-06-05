<?php
require_once '../../config/database.php';

$id_medcin = 1;
$id_rdv = $_GET['id'] ?? 0;

$stmt = $pdo->prepare("
SELECT *
FROM rendezvous
JOIN patient ON patient.id_patient = rendezvous.patient_id
JOIN user ON user.id = patient.user_id
JOIN disponibilite ON disponibilite.id = rendezvous.disponibilite_id
WHERE disponibilite.id_medcin = ?
");
$stmt->execute([$id_medcin]);
$rdvs = $stmt->fetchAll();

$detail = null;

foreach($rdvs as $r){
    if($r['id'] == $id_rdv){
        $detail = $r;
        break;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-6 bg-gray-100">

<div class="grid grid-cols-3 gap-4">

    <div class="col-span-2 bg-white p-4 rounded">
        <?php foreach($rdvs as $r): ?>
            <a href="?id=<?= $r['id'] ?>"
       class="block border p-2 mb-2 rounded hover:bg-gray-100 hover:border-blue-500">
                <?= $r['nom'] ?>
                <br>
                <?= $r['statut'] ?>
            </a>
        <?php endforeach; ?>
    </div>

    <div class="bg-white p-4 rounded">
        <?php if($detail): ?>
          <div class="space-y-2">



          

    <p class="flex justify-between border-b pb-2">
        <span class="font-semibold text-gray-700">Nom :</span>
        <span><?= $detail['nom'] ?></span>
    </p>

    <p class="flex justify-between border-b pb-2">
        <span class="font-semibold text-gray-700">Email :</span>
        <span><?= $detail['email'] ?></span>
    </p>

    <p class="flex justify-between">
        <span class="font-semibold text-gray-700">Statut :</span>
        <span class="px-2 py-1 rounded bg-blue-100 text-blue-700 text-sm">
            <?= $detail['statut'] ?>
        </span>
    </p>

</div>
        <?php else: ?>
            <p>Choisir un RDV</p>
        <?php endif; ?>
    </div>

</div>

</body>
</html>
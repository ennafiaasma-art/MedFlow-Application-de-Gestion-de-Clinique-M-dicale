<?php

require '../../config/database.php';

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

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Mes Ordonnances</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="max-w-5xl mx-auto p-8">

<h1 class="text-4xl font-bold text-center text-purple-600 mb-8">
Mes Ordonnances
</h1>

<div class="grid gap-6">

<?php foreach($ordonnances as $o): ?>

<div class="bg-white p-6 rounded-xl shadow-lg">

<h2 class="font-bold text-lg text-purple-600 mb-3">
Ordonnance
</h2>

<p class="text-gray-700">
<?= $o['contenu']; ?>
</p>

</div>

<?php endforeach; ?>

</div>

</div>

</body>
</html>
<?php

require '../../config/database.php';

$patientId = 1;

$sql = "
SELECT COUNT(*) AS total
FROM rendezvous
WHERE patient_id = ?
";

$stmt = $pdo->prepare($sql);
$stmt->execute([$patientId]);

$result = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Patient</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

<div class="max-w-6xl mx-auto p-8">

    <h1 class="text-4xl font-bold text-center text-blue-600 mb-10">
        Dashboard Patient
    </h1>

    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-700">
            Nombre de rendez-vous
        </h2>

        <p class="text-5xl font-bold text-blue-500 mt-4">
            <?= $result['total']; ?>
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <a href="rechercher-medecin.php"
           class="bg-blue-500 hover:bg-blue-600 text-white p-6 rounded-xl shadow-lg text-center transition">

            <div class="text-3xl mb-2">🔍</div>

            <h3 class="font-bold text-lg">
                Rechercher médecin
            </h3>

        </a>

        <a href="mes-rdv.php"
           class="bg-green-500 hover:bg-green-600 text-white p-6 rounded-xl shadow-lg text-center transition">

            <div class="text-3xl mb-2">📅</div>

            <h3 class="font-bold text-lg">
                Mes rendez-vous
            </h3>

        </a>

        <a href="ordonnances.php"
           class="bg-purple-500 hover:bg-purple-600 text-white p-6 rounded-xl shadow-lg text-center transition">

            <div class="text-3xl mb-2">📄</div>

            <h3 class="font-bold text-lg">
                Mes ordonnances
            </h3>

        </a>

    </div>

</div>

</body>
</html>
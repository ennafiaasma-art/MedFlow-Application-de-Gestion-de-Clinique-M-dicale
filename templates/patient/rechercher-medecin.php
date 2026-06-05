<?php

require '../../config/database.php';

$search = $_GET['search'] ?? '';

$sql = "
SELECT
    doctor.id_doctor,
    user.nom,
    specialite.nom AS specialite
FROM doctor
JOIN user ON doctor.user_id = user.id
JOIN specialite ON doctor.specialite_id = specialite.id
WHERE user.nom LIKE ?
OR specialite.nom LIKE ?
";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    "%$search%",
    "%$search%"
]);

$doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Recherche Médecin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

<div class="max-w-6xl mx-auto p-8">

    <h1 class="text-4xl font-bold text-center text-blue-600 mb-8">
        Recherche Médecin
    </h1>

    <form method="GET" class="mb-8">
        <div class="flex gap-4">

            <input
                type="text"
                name="search"
                value="<?= htmlspecialchars($search) ?>"
                placeholder="Nom ou spécialité"
                class="flex-1 p-3 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
            >

            <button
                type="submit"
                class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg shadow"
            >
                Rechercher
            </button>

        </div>
    </form>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <?php foreach ($doctors as $doctor): ?>

            <div class="bg-white rounded-xl shadow-lg p-6">

                <div class="text-center">

                    <div class="text-5xl mb-3">
                        👨‍⚕️
                    </div>

                    <h2 class="text-xl font-bold text-gray-800">
                        <?= htmlspecialchars($doctor['nom']) ?>
                    </h2>

                    <p class="text-gray-500 mt-2">
                        <?= htmlspecialchars($doctor['specialite']) ?>
                    </p>

                    <a
                        href="reservation.php?id=<?= $doctor['id_doctor'] ?>"
                        class="inline-block mt-4 bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded-lg"
                    >
                        Réserver
                    </a>

                </div>

            </div>

        <?php endforeach; ?>

    </div>

</div>

</body>
</html>
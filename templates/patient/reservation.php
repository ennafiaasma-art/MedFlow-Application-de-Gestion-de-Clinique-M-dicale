<?php

require '../../config/database.php';

$doctorId = $_GET['id'] ?? 0;

$sql = "
SELECT *
FROM disponibilite
WHERE id_medcin = ?
AND disponible = 1
";

$stmt = $pdo->prepare($sql);
$stmt->execute([$doctorId]);

$creneaux = $stmt->fetchAll(PDO::FETCH_ASSOC);

$message = "";

if (isset($_POST['reserver'])) {

    $patientId = 1; // temporaire

    $disponibiliteId = $_POST['disponibilite'];

    // Insertion rendez-vous
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

    // Créneau devient indisponible
    $sql = "
    UPDATE disponibilite
    SET disponible = 0
    WHERE id = ?
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $disponibiliteId
    ]);

    $message = "Rendez-vous réservé avec succès.";
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Réservation</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="w-full max-w-xl">

    <div class="bg-white p-8 rounded-xl shadow-lg">

        <h1 class="text-3xl font-bold text-center text-green-600 mb-6">
            Réserver un rendez-vous
        </h1>

        <?php if($message): ?>

            <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4">
                <?= $message ?>
            </div>

        <?php endif; ?>

        <?php if(count($creneaux) > 0): ?>

            <form method="POST">

                <label class="block mb-2 font-semibold">
                    Choisir un créneau
                </label>

                <select
                    name="disponibilite"
                    class="w-full border p-3 rounded-lg mb-6"
                    required>

                    <?php foreach($creneaux as $c): ?>

                        <option value="<?= $c['id']; ?>">
                            <?= $c['date_debut']; ?> → <?= $c['date_fin']; ?>
                        </option>

                    <?php endforeach; ?>

                </select>

                <button
                    type="submit"
                    name="reserver"
                    class="w-full bg-green-500 hover:bg-green-600 text-white p-3 rounded-lg">

                    Confirmer la réservation

                </button>

            </form>

        <?php else: ?>

            <div class="bg-red-100 text-red-700 p-3 rounded-lg">
                Aucun créneau disponible pour ce médecin.
            </div>

        <?php endif; ?>

    </div>

</div>

</body>
</html>
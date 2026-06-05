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

if (isset($_POST['reserver'])) {

    $patientId = 1; // temporaire

    $disponibiliteId = $_POST['disponibilite'];

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

    echo "<p>Rendez-vous réservé avec succès.</p>";
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Réservation</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="max-w-xl mx-auto mt-16">

<div class="bg-white p-8 rounded-xl shadow-lg">

<h1 class="text-3xl font-bold text-center text-green-600 mb-6">
Réserver un rendez-vous
</h1>

<form method="POST">

<label class="block mb-2 font-semibold">
Choisir un créneau
</label>

<select
name="disponibilite"
class="w-full border p-3 rounded-lg mb-6">

<?php foreach($creneaux as $c): ?>

<option value="<?= $c['id']; ?>">
<?= $c['date_debut']; ?>
</option>

<?php endforeach; ?>

</select>

<button
type="submit"
name="reserver"
class="w-full bg-green-500 text-white p-3 rounded-lg hover:bg-green-600">

Confirmer la réservation

</button>

</form>

</div>

</div>

</body>
</html>
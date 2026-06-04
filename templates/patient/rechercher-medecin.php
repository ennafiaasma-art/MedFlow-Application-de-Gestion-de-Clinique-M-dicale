<?php

require '../config/database.php';

$search = $_GET['search'] ?? '';

$sql = "
SELECT
doctor.id_doctor,
user.nom,
specialite.nom AS specialite

FROM doctor

JOIN user
ON doctor.user_id = user.id

JOIN specialite
ON doctor.specialite_id = specialite.id

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

<form method="GET">
    <input type="text" name="search" placeholder="Nom ou spécialité">
    <button>Rechercher</button>
</form>

<hr>

<?php foreach($doctors as $doctor): ?>

<h3><?= $doctor['nom']; ?></h3>

<p>
Spécialité :
<?= $doctor['specialite']; ?>
</p>

<a href="reservation.php?id=<?= $doctor['id_doctor']; ?>">
Réserver
</a>

<hr>

<?php endforeach; ?>

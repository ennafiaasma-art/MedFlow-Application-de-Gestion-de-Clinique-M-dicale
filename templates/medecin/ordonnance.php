
<?php
require_once __DIR__.'/../../config/database.php';

$id = $_GET['id'] ?? 0;

$q = $pdo->prepare("
SELECT *
FROM rendezvous
JOIN patient ON rendezvous.patient_id = patient.id_patient
JOIN user ON patient.user_id = user.id
LEFT JOIN ordonnance ON rendezvous.id = ordonnance.rendezVous_id
WHERE rendezvous.id = ?
");
$q->execute([$id]);
$rdv = $q->fetch();


?>

<!DOCTYPE html>
<html>
<head>
    <title>Ordonnance</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body
class="min-h-screen bg-cover bg-center flex items-center justify-center p-6"
style="background-image:url('https://images.unsplash.com/photo-1584982751601-97dcc096659c');"
>

<div class="absolute inset-0 bg-white/70"></div>

<div class="relative max-w-2xl w-full bg-white shadow-xl rounded-2xl p-8">


    <h1 class="text-3xl font-bold text-blue-600 mb-6 text-center">
        🩺 Ordonnance Médicale
    </h1>

    <p class="mb-4 text-gray-700">
        Patient :
        <b><?= $rdv['nom'] ?></b>
    </p>

    <form method="POST">

        <textarea
            name="contenu"
            rows="10"
            class="w-full border-2 border-blue-200 focus:border-blue-500 outline-none p-4 rounded-lg mb-4"
            placeholder="Écrire l'ordonnance..."
        ><?= $rdv['contenu'] ?? '' ?></textarea>

        <button
            type="submit"
            name="save"
            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg"
        >
            Enregistrer
        </button>
        <button
    onclick="window.print()"
    class="bg-green-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg"
>
    Imprimer
</button>

    </form>

</div>

</body>
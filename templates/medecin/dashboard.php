<?php
require_once __DIR__ . '/../../config/database.php';
session_start();
$id_medcin = $_SESSION['id_medcin'] ?? 1; 


$stmt = $pdo->prepare("
    SELECT COUNT(*) as total
    FROM rendezvous 
    JOIN disponibilite  ON rendezvous.disponibilite_id = disponibilite.id
    WHERE disponibilite.id_medcin = ?
");
$stmt->execute([$id_medcin]);
$rdv_today = $stmt->fetch()['total'];

$stmt = $pdo->prepare("
    SELECT COUNT(*) as total
    FROM rendezvous 
    JOIN disponibilite ON rendezvous.disponibilite_id = disponibilite.id
    WHERE disponibilite.id_medcin = ?  AND rendezvous.statut = 'en_attente'
");
$stmt->execute([$id_medcin]);
$en_attente = $stmt->fetch()['total'];


$stmt = $pdo->prepare("
 SELECT COUNT(*) as total
    FROM rendezvous 
    JOIN disponibilite ON rendezvous.disponibilite_id = disponibilite.id
    WHERE disponibilite.id_medcin = ?  AND rendezvous.statut = 'confirme'
    
");
$stmt->execute([$id_medcin]);
$confirme = $stmt->fetch()['total'];

$stmt = $pdo->prepare("
 SELECT COUNT(*) as total
    FROM rendezvous 
    JOIN disponibilite ON rendezvous.disponibilite_id = disponibilite.id
    WHERE disponibilite.id_medcin = ?  AND rendezvous.statut = 'annule'
");
$stmt->execute([$id_medcin]);
$annule = $stmt->fetch()['total'];

$stmt = $pdo->prepare("
 SELECT * FROM rendezvous 
JOIN patient  ON rendezvous.patient_id = patient.id_patient
JOIN user  ON patient.user_id = user.id
JOIN disponibilite  ON rendezvous.disponibilite_id = disponibilite.id
WHERE disponibilite.id_medcin = ?
ORDER BY disponibilite.date_debut
");
$stmt->execute([$id_medcin]);
$rdvs = $stmt->fetchAll(PDO::FETCH_ASSOC);

$badges = [
    'en_attente' => ['cls' => 'bg-yellow-100 text-yellow-700', 'label' => 'En attente'],
    'confirme'   => ['cls' => 'bg-green-100 text-green-700',  'label' => 'Confirmé'],
    'annule'     => ['cls' => 'bg-red-100 text-red-600',      'label' => 'Annulé'],
    'termine'    => ['cls' => 'bg-slate-100 text-slate-600',  'label' => 'Terminé'],
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Médecin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen">
<div class="max-w-7xl mx-auto p-6">

    <!-- HEADER -->
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-bold text-slate-800"> Dashboard Médecin</h1>
        <div class="flex gap-3">
            <a href="planning.php"
               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition text-sm">
                Planning
            </a>
            <a href="rendez-vous.php"
               class="bg-slate-600 text-white px-4 py-2 rounded-lg hover:bg-slate-700 transition text-sm">
                Rendez-vous
            </a>
        </div>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-10">
        <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-blue-500">
            <p class="text-sm text-slate-500 mb-1">RDV Aujourd'hui</p>
            <h2 class="text-4xl font-bold text-blue-600"><?= $rdv_today ?></h2>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-yellow-400">
            <p class="text-sm text-slate-500 mb-1">En attente</p>
            <h2 class="text-4xl font-bold text-yellow-500"><?= $en_attente ?></h2>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-green-500">
            <p class="text-sm text-slate-500 mb-1">Confirmés</p>
            <h2 class="text-4xl font-bold text-green-600"><?= $confirme ?></h2>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-red-400">
            <p class="text-sm text-slate-500 mb-1">Annulés</p>
            <h2 class="text-4xl font-bold text-red-500"><?= $annule ?></h2>
        </div>
    </div>

    <!-- TABLE RDV SEMAINE -->
    <div class="bg-white p-6 rounded-xl shadow-sm">
        <h2 class="text-xl font-bold mb-5 text-slate-800">Rendez-vous de la semaine</h2>

        <table class="w-full text-sm">
            <thead>
                <tr class="bg-slate-50 text-slate-500 uppercase text-xs">
                    <th class="text-left p-3">Jour</th>
                    <th class="text-left p-3">Heure</th>
                    <th class="text-left p-3">Patient</th>
                    <th class="text-left p-3">Statut</th>
                    <th class="text-left p-3">Actions</th>
                </tr>
            </thead>

  <tbody>

<?php foreach($rdvs as $rdv){ ?>

<tr class="border-b">
    
    <td class="p-3"><?= $rdv['date_debut'] ?></td>

    <td class="p-3"> <?= $rdv['date_fin'] ?></td>

    <td class="p-3"> <?= $rdv['nom'] ?> </td>

  <td class="p-3">
    <span class="<?= $badges[$rdv['statut']]['cls'] ?>">
        <?= $badges[$rdv['statut']]['label'] ?>
    </span>
</td>

    <td class="p-3">

        <?php if($rdv['statut'] == 'en_attente'){ ?>

            <a href="valider-rdv.php?id=<?= $rdv['id'] ?>"
               class="bg-green-500 text-white px-2 py-1 rounded">
               Valider
            </a>

            <a href="annuler-rdv.php?id=<?= $rdv['id'] ?>"
               class="bg-red-500 text-white px-2 py-1 rounded">
               Annuler
            </a>

        <?php } ?>

        <?php if($rdv['statut'] == 'confirme'){ ?>

            <a href="ordonnance.php?id=<?= $rdv['id'] ?>"
               class="bg-blue-500 text-white px-2 py-1 rounded">
               Ordonnance
            </a>

        <?php } ?>

    </td>

</tr>

<?php } ?>

<?php if(empty($rdvs)){ ?>

<tr>
    <td colspan="5" class="text-center p-4 text-gray-500">
        Aucun rendez-vous cette semaine
    </td>
</tr>

<?php } ?>

</tbody>
</html>
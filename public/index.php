<?php

require_once "../config/Database.php";

$pdo = Database::getInstance();

$sql = "
SELECT
    d.id_doctor,
    u.nom,
    u.email,
    s.nom AS specialite
FROM doctor d
INNER JOIN user u ON d.user_id = u.id
INNER JOIN specialite s ON d.specialite_id = s.id
";

$stmt = $pdo->query($sql);

$doctors = $stmt->fetchAll();

?>









<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedFlow</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

    <!-- Navbar -->
    <nav class="bg-blue-600 text-white">
        <div class="container mx-auto px-8 py-4 flex justify-between items-center">
            <h1 class="text-3xl font-bold">MedFlow</h1>

            <ul class="hidden md:flex gap-8">
                <li><a href="#" class="hover:text-blue-200">Accueil</a></li>
                <li><a href="#" class="hover:text-blue-200">Médecins</a></li>
                <li><a href="#" class="hover:text-blue-200">Spécialités</a></li>
                <li><a href="#" class="hover:text-blue-200">Contact</a></li>
            </ul>

            <button class="bg-white text-blue-600 px-5 py-2 rounded-lg font-semibold">
                Connexion
            </button>
        </div>
    </nav>

  
    <section class="bg-blue-600 overflow-hidden">
        <div class="container mx-auto px-8 py-20">

            <div class="grid md:grid-cols-2 items-center gap-12">

                
                <div class="text-white">
                    <h1 class="text-5xl md:text-6xl font-bold leading-tight mb-6">
                        Prenez soin de votre santé facilement
                    </h1>

                    <p class="text-xl text-blue-100 mb-8">
                        Trouvez un médecin, prenez rendez-vous et
                        gérez votre dossier médical depuis une seule plateforme.
                    </p>

                  
                    <div class="bg-white rounded-2xl shadow-xl flex flex-col md:flex-row overflow-hidden">

                        <input
                            type="text"
                            placeholder="Nom, spécialité, établissement..."
                            class="flex-1 p-5 outline-none text-gray-700"
                        >

                        <input
                            type="text"
                            placeholder="Ville..."
                            class="flex-1 p-5 outline-none border-l text-gray-700"
                        >

                        <button class="bg-blue-800 hover:bg-blue-900 text-white px-8 py-5 font-semibold">
                            Rechercher
                        </button>

                    </div>

                    <div class="flex gap-8 mt-8">
                        <div>
                            <h3 class="text-3xl font-bold">500+</h3>
                            <p>Médecins</p>
                        </div>

                        <div>
                            <h3 class="text-3xl font-bold">10K+</h3>
                            <p>Patients</p>
                        </div>

                        <div>
                            <h3 class="text-3xl font-bold">24/7</h3>
                            <p>Support</p>
                        </div>
                    </div>

                </div>

                
                <div class="flex justify-center">
                    <img
                        src="https://images.unsplash.com/photo-1584515933487-779824d29309"
                        alt="Doctor"
                        class="rounded-3xl shadow-2xl w-full max-w-lg"
                    >
                </div>

            </div>

        </div>
   <section class="py-20 bg-gray-50">
    <div class="container mx-auto px-8">

        <h2 class="text-4xl font-bold text-center mb-4">
            Nos Médecins
        </h2>

        <p class="text-center text-gray-500 mb-12">
            Découvrez nos spécialistes disponibles.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            <?php foreach ($doctors as $doctor): ?>

                <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition duration-300 p-6">

                    
                    <div class="flex justify-center mb-4">
                        <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center text-4xl">
                            👨‍⚕️
                        </div>
                    </div>

                   
                    <h3 class="text-xl font-bold text-center text-gray-800">
                        Dr. <?= htmlspecialchars($doctor['nom']) ?>
                    </h3>

                   
                    <div class="mt-3 text-center">
                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                            <?= htmlspecialchars($doctor['specialite']) ?>
                        </span>
                    </div>

                   
                    <p class="text-gray-500 text-center mt-4">
                        <?= htmlspecialchars($doctor['email']) ?>
                    </p>

                   
                    <div class="mt-6 text-center">
                        <a href="#"
                           class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg inline-block">
                            Prendre rendez-vous
                        </a>
                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </div>
</section>

   
    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto px-8 text-center">
            <h2 class="text-2xl font-bold mb-2">MedFlow</h2>
            <p class="text-gray-400">
                Gestion intelligente des rendez-vous médicaux.
            </p>
        </div>
    </footer>

</body>
</html>




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Médecin</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100">

    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-blue-600">
                MedFlow
            </h1>

            <div class="flex items-center gap-4">
                <span class="font-medium">
                    Dr. Ahmed Benali
                </span>

                <img
                    src="https://ui-avatars.com/api/?name=Ahmed+Benali"
                    class="w-10 h-10 rounded-full"
                    alt="">
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto p-6">

        <!-- Titre -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-800">
                Dashboard Médecin
            </h2>

            <p class="text-gray-500">
                Bienvenue dans votre espace professionnel.
            </p>
        </div>

        <!-- Statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="text-gray-500 text-sm">
                    RDV Aujourd'hui
                </h3>

                <p class="text-4xl font-bold text-blue-600 mt-2">
                    12
                </p>
            </div>

            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="text-gray-500 text-sm">
                    En attente
                </h3>

                <p class="text-4xl font-bold text-yellow-500 mt-2">
                    4
                </p>
            </div>

            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="text-gray-500 text-sm">
                    Confirmés
                </h3>

                <p class="text-4xl font-bold text-green-600 mt-2">
                    6
                </p>
            </div>

            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="text-gray-500 text-sm">
                    Terminés
                </h3>

                <p class="text-4xl font-bold text-purple-600 mt-2">
                    2
                </p>
            </div>

        </div>

        <!-- Actions Rapides -->
        <div class="bg-white rounded-xl shadow p-6 mb-10">

            <h3 class="text-xl font-bold mb-5">
                Actions Rapides
            </h3>

            <div class="flex flex-wrap gap-4">

                <a href="#"
                    class="bg-blue-600 text-white px-5 py-3 rounded-lg hover:bg-blue-700 transition">
                    Voir Planning
                </a>

                <a href="#"
                    class="bg-green-600 text-white px-5 py-3 rounded-lg hover:bg-green-700 transition">
                    Gérer les Rendez-vous
                </a>

                <a href="#"
                    class="bg-purple-600 text-white px-5 py-3 rounded-lg hover:bg-purple-700 transition">
                    Ordonnances
                </a>

            </div>
        </div>

        <!-- Rendez-vous du jour -->
        <div class="bg-white rounded-xl shadow p-6">

            <div class="flex justify-between items-center mb-6">

                <h3 class="text-xl font-bold">
                    Rendez-vous du Jour
                </h3>

                <span class="text-gray-500">
                    03 Juin 2026
                </span>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead>
                        <tr class="border-b bg-gray-50">
                            <th class="text-left p-4">Heure</th>
                            <th class="text-left p-4">Patient</th>
                            <th class="text-left p-4">Téléphone</th>
                            <th class="text-left p-4">Statut</th>
                            <th class="text-left p-4">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr class="border-b hover:bg-gray-50">

                            <td class="p-4">
                                09:00
                            </td>

                            <td class="p-4">
                                Amine Sakhri
                            </td>

                            <td class="p-4">
                                06 12 34 56 78
                            </td>

                            <td class="p-4">
                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                                    En attente
                                </span>
                            </td>

                            <td class="p-4">

                                <button class="bg-green-600 text-white px-4 py-2 rounded">
                                    Valider
                                </button>

                                <button class="bg-red-600 text-white px-4 py-2 rounded ml-2">
                                    Annuler
                                </button>

                            </td>

                        </tr>

                        <tr class="border-b hover:bg-gray-50">

                            <td class="p-4">
                                10:00
                            </td>

                            <td class="p-4">
                                Sara El Amrani
                            </td>

                            <td class="p-4">
                                06 11 22 33 44
                            </td>

                            <td class="p-4">
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                    Confirmé
                                </span>
                            </td>

                            <td class="p-4">
                                <button class="bg-blue-600 text-white px-4 py-2 rounded">
                                    Consulter
                                </button>
                            </td>

                        </tr>

                        <tr class="border-b hover:bg-gray-50">

                            <td class="p-4">
                                11:30
                            </td>

                            <td class="p-4">
                                Yassine Alaoui
                            </td>

                            <td class="p-4">
                                06 55 44 33 22
                            </td>

                            <td class="p-4">
                                <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-sm">
                                    Terminé
                                </span>
                            </td>

                            <td class="p-4">
                                <button class="bg-gray-700 text-white px-4 py-2 rounded">
                                    Voir
                                </button>
                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</body>
</html>
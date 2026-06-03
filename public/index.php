
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Clinique</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="flex h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-blue-900 text-white">
        <div class="p-6 text-2xl font-bold border-b border-blue-800">
            MedFlow
        </div>

        <nav class="mt-6">
            <a href="#" class="block px-6 py-3 bg-blue-800">
                Dashboard
            </a>

            <a href="#" class="block px-6 py-3 hover:bg-blue-800">
                Patients
            </a>

            <a href="#" class="block px-6 py-3 hover:bg-blue-800">
                Médecins
            </a>

            <a href="#" class="block px-6 py-3 hover:bg-blue-800">
                Rendez-vous
            </a>

            <a href="#" class="block px-6 py-3 hover:bg-blue-800">
                Spécialités
            </a>

            <a href="#" class="block px-6 py-3 hover:bg-blue-800">
                Paiements
            </a>

            <a href="#" class="block px-6 py-3 hover:bg-blue-800">
                Déconnexion
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto">

        <!-- Header -->
        <header class="bg-white shadow p-6 flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-800">
                Tableau de bord
            </h1>

            <div class="flex items-center gap-3">
                <img
                    src="https://via.placeholder.com/40"
                    class="rounded-full"
                    alt="Admin">
                <span class="font-semibold">
                    Administrateur
                </span>
            </div>
        </header>

        <!-- Stats -->
        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 p-6">

            <div class="bg-white rounded-xl shadow p-5">
                <h3 class="text-gray-500">Patients</h3>
                <p class="text-3xl font-bold text-blue-600 mt-2">1 245</p>
            </div>

            <div class="bg-white rounded-xl shadow p-5">
                <h3 class="text-gray-500">Médecins</h3>
                <p class="text-3xl font-bold text-green-600 mt-2">32</p>
            </div>

            <div class="bg-white rounded-xl shadow p-5">
                <h3 class="text-gray-500">RDV Aujourd'hui</h3>
                <p class="text-3xl font-bold text-orange-500 mt-2">58</p>
            </div>

            <div class="bg-white rounded-xl shadow p-5">
                <h3 class="text-gray-500">Revenus</h3>
                <p class="text-3xl font-bold text-purple-600 mt-2">45 000 DH</p>
            </div>

        </section>

        <!-- Recent Appointments -->
        <section class="px-6 pb-6">
            <div class="bg-white rounded-xl shadow">

                <div class="p-5 border-b">
                    <h2 class="text-xl font-bold">
                        Derniers Rendez-vous
                    </h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="p-4">Patient</th>
                                <th class="p-4">Médecin</th>
                                <th class="p-4">Date</th>
                                <th class="p-4">Statut</th>
                            </tr>
                        </thead>

                        <tbody>

                            <tr class="border-t">
                                <td class="p-4">Ahmed Alaoui</td>
                                <td class="p-4">Dr. Karim</td>
                                <td class="p-4">03/06/2026</td>
                                <td class="p-4">
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                        Confirmé
                                    </span>
                                </td>
                            </tr>

                            <tr class="border-t">
                                <td class="p-4">Sara Benali</td>
                                <td class="p-4">Dr. Youssef</td>
                                <td class="p-4">03/06/2026</td>
                                <td class="p-4">
                                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                                        En attente
                                    </span>
                                </td>
                            </tr>

                            <tr class="border-t">
                                <td class="p-4">Omar Naji</td>
                                <td class="p-4">Dr. Salma</td>
                                <td class="p-4">04/06/2026</td>
                                <td class="p-4">
                                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                        Annulé
                                    </span>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

            </div>
        </section>

    </main>

</div>

</body>
</html>
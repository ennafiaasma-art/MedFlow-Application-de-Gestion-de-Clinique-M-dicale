<?php 
require_once __DIR__ . '/../../config/database.php';
$querySpec = "SELECT id, nom FROM specialites ORDER BY nom ASC";
    $stmtSpec = $db->prepare($querySpec);
    $stmtSpec->execute();
    $specialites = $stmtSpec->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard & Configuration - MediClinic</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-50 font-sans text-slate-800 antialiased overflow-x-hidden">

    <div class="flex min-h-screen overflow-hidden">

        <!-- ASIDE (Sidebar) -->
        <aside class="fixed inset-y-0 left-0 z-40 w-64 transform bg-slate-900 text-slate-300 transition-transform duration-300 ease-in-out md:translate-x-0 md:static md:inset-0">
            <!-- Logo / Brand -->
            <div class="flex h-20 items-center justify-center border-b border-slate-800 px-6">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-teal-500 text-white shadow-lg shadow-teal-500/30">
                        <i class="fa-solid fa-house-medical text-lg"></i>
                    </div>
                    <span class="text-lg font-bold tracking-wider text-white">Medi<span class="text-teal-400">Clinic</span></span>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="space-y-1 px-4 py-6">
                <a href="#" class="flex items-center gap-3 rounded-xl bg-teal-600 px-4 py-3 text-white transition-all">
                    <i class="fa-solid fa-chart-pie w-5 text-center text-lg"></i>
                    <span class="font-medium">Vue Globale</span>
                </a>

                <a href="#" id="sidebar-add-doctor" class="flex items-center gap-3 rounded-xl px-4 py-3 hover:bg-slate-800 hover:text-white transition-all group">
                    <i class="fa-solid fa-user-doctor w-5 text-center text-lg text-slate-400 group-hover:text-teal-400"></i>
                    <span class="font-medium">Gestion Médecins</span>
                    <span class="ml-auto rounded-md bg-slate-800 px-2 py-0.5 text-xs text-slate-400 group-hover:bg-slate-700">US 3.1</span>
                </a>

                <a href="#" id="sidebar-add-specialty" class="flex items-center gap-3 rounded-xl px-4 py-3 hover:bg-slate-800 hover:text-white transition-all group">
                    <i class="fa-solid fa-stethoscope w-5 text-center text-lg text-slate-400 group-hover:text-teal-400"></i>
                    <span class="font-medium">Spécialités</span>
                    <span class="ml-auto rounded-md bg-slate-800 px-2 py-0.5 text-xs text-slate-400 group-hover:bg-slate-700">US 3.2</span>
                </a>

                <a href="#" class="flex items-center gap-3 rounded-xl px-4 py-3 hover:bg-slate-800 hover:text-white transition-all group">
                    <i class="fa-solid fa-calendar-check w-5 text-center text-lg text-slate-400 group-hover:text-teal-400"></i>
                    <span class="font-medium">Rendez-vous</span>
                </a>

                <div class="pt-6 my-6 border-t border-slate-800">
                    <span class="px-4 text-xs font-semibold tracking-wider text-slate-500 uppercase">Configuration</span>
                </div>

                <a href="#" class="flex items-center gap-3 rounded-xl px-4 py-3 hover:bg-slate-800 hover:text-white transition-all group">
                    <i class="fa-solid fa-gear w-5 text-center text-lg text-slate-400 group-hover:text-teal-400"></i>
                    <span class="font-medium">Paramètres</span>
                </a>
            </nav>

            <!-- User Profile Quick View (Bottom) -->
            <div class="absolute bottom-0 left-0 w-full border-t border-slate-800 p-4 bg-slate-950/40">
                <div class="flex items-center gap-3">
                    <div class="relative h-10 w-10 rounded-full bg-slate-700 flex items-center justify-center text-white font-bold border border-slate-600">
                        AD
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-white">Admin Principal</p>
                        <p class="text-xs text-slate-500">admin@clinic.com</p>
                    </div>
                    <button class="ml-auto text-slate-400 hover:text-rose-400 transition-colors">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </button>
                </div>
            </div>
        </aside>

        <!-- MAIN CONTENT AREA -->
        <div class="flex flex-1 flex-col overflow-y-auto h-screen">
            
            <!-- HEADER -->
            <header class="flex h-20 shrink-0 items-center justify-between border-b border-slate-200 bg-white px-6 md:px-8">
                <!-- Mobile Menu Button & Title -->
                <div class="flex items-center gap-4">
                    <button id="mobile-menu-toggle" class="text-slate-500 hover:text-slate-700 md:hidden">
                        <i class="fa-solid fa-bars text-xl"></i>
                    </button>
                    <div>
                        <h1 class="text-xl font-bold text-slate-900">Espace Administration</h1>
                        <p class="hidden text-xs text-slate-500 md:block">Indicateurs de performance et configuration de la clinique</p>
                    </div>
                </div>

                <!-- Header Actions -->
                <div class="flex items-center gap-4">
                    <!-- Notifications -->
                    <button class="relative rounded-xl border border-slate-200 p-2.5 text-slate-500 hover:bg-slate-50 transition-all">
                        <i class="fa-regular fa-bell text-lg"></i>
                        <span class="absolute top-2.5 right-2.5 h-2 w-2 rounded-full bg-rose-500"></span>
                    </button>
                    <!-- Date Badge -->
                    <div class="hidden items-center gap-2 rounded-xl bg-slate-100 px-4 py-2 text-sm font-medium text-slate-700 sm:flex">
                        <i class="fa-regular fa-calendar text-teal-600"></i>
                        <span>Aujourd'hui</span>
                    </div>
                </div>
            </header>

            <!-- MAIN BODY / PANELS -->
            <main class="flex-1 p-6 md:p-8 space-y-8 overflow-y-auto">

                <!-- 1. INDICATORS ROW (KPIs) -->
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    
                    <!-- KPI: RDV Totaux -->
                    <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-sm flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-500">Total Rendez-vous</p>
                            <h3 class="mt-2 text-3xl font-bold text-slate-900">1,248</h3>
                            <span class="mt-2 inline-flex items-center gap-1 text-xs font-medium text-emerald-600">
                                <i class="fa-solid fa-arrow-up"></i> +12% ce mois
                            </span>
                        </div>
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                            <i class="fa-regular fa-calendar-check text-xl"></i>
                        </div>
                    </div>

                    <!-- KPI: Taux d'annulation (Demandé dans US 3.3) -->
                    <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-sm flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-500">Taux d'Annulation</p>
                            <h3 class="mt-2 text-3xl font-bold text-slate-900">4.2%</h3>
                            <span class="mt-2 inline-flex items-center gap-1 text-xs font-medium text-emerald-600">
                                <i class="fa-solid fa-arrow-down"></i> -0.8% vs dérnier mois
                            </span>
                        </div>
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-rose-50 text-rose-600">
                            <i class="fa-solid fa-user-slash text-xl"></i>
                        </div>
                    </div>

                    <!-- KPI: Médecins Actifs -->
                    <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-sm flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-500">Médecins Actifs</p>
                            <h3 class="mt-2 text-3xl font-bold text-slate-900">24</h3>
                            <span class="mt-2 inline-flex items-center gap-1 text-xs font-medium text-slate-400">
                                <i class="fa-solid fa-circle text-[8px] text-emerald-500"></i> Tous opérationnels
                            </span>
                        </div>
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-teal-50 text-teal-600">
                            <i class="fa-solid fa-user-doctor text-xl"></i>
                        </div>
                    </div>

                    <!-- KPI: Spécialités -->
                    <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-sm flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-500">Spécialités Disponibles</p>
                            <h3 class="mt-2 text-3xl font-bold text-slate-900">12</h3>
                            <span class="mt-2 inline-flex items-center gap-1 text-xs font-medium text-slate-500">
                                Filtrage actif patient
                            </span>
                        </div>
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                            <i class="fa-solid fa-tags text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- 2. CORE FEATURES SECTION -->
                <div class="grid gap-8 lg:grid-cols-3">
                    
                    <!-- TABLE: RDV Terminés par Médecin (US 3.3) -->
                    <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-sm lg:col-span-2">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                            <div>
                                <h3 class="text-lg font-bold text-slate-900">Efficacité des Médecins</h3>
                                <p class="text-xs text-slate-500">Classement par nombre de consultations terminées</p>
                            </div>
                            <button class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2 text-xs font-semibold text-slate-700 shadow-sm hover:bg-slate-50 transition-all">
                                <i class="fa-solid fa-download text-slate-400"></i> Exporter
                            </button>
                        </div>

                        <!-- Table -->
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b border-slate-100 text-xs font-semibold uppercase tracking-wider text-slate-400">
                                        <th class="pb-3">Médecin</th>
                                        <th class="pb-3">Spécialité</th>
                                        <th class="pb-3 text-center">RDV Terminés</th>
                                        <th class="pb-3 text-right">Statut</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 text-sm">
                                    <tr>
                                        <td class="py-3.5 font-medium text-slate-900 flex items-center gap-3">
                                            <div class="h-8 w-8 rounded-full bg-slate-100 flex items-center justify-center font-bold text-xs text-teal-600">AH</div>
                                            Dr. Amine Hakimi
                                        </td>
                                        <td class="py-3.5 text-slate-500">Cardiologie</td>
                                        <td class="py-3.5 text-center font-semibold text-slate-700">142</td>
                                        <td class="py-3.5 text-right">
                                            <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700">
                                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> Actif
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-3.5 font-medium text-slate-900 flex items-center gap-3">
                                            <div class="h-8 w-8 rounded-full bg-slate-100 flex items-center justify-center font-bold text-xs text-teal-600">SB</div>
                                            Dr. Sarah Benani
                                        </td>
                                        <td class="py-3.5 text-slate-500">Pédiatrie</td>
                                        <td class="py-3.5 text-center font-semibold text-slate-700">128</td>
                                        <td class="py-3.5 text-right">
                                            <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700">
                                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> Actif
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-3.5 font-medium text-slate-900 flex items-center gap-3">
                                            <div class="h-8 w-8 rounded-full bg-slate-100 flex items-center justify-center font-bold text-xs text-teal-600">YJ</div>
                                            Dr. Youssef Jabri
                                        </td>
                                        <td class="py-3.5 text-slate-500">Dermatologie</td>
                                        <td class="py-3.5 text-center font-semibold text-slate-700">94</td>
                                        <td class="py-3.5 text-right">
                                            <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 px-2.5 py-1 text-xs font-medium text-amber-700">
                                                <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span> En Congé
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- QUICK ACTIONS & CONTEXT (US 3.1 & 3.2) -->
                    <div class="space-y-6">
                        <!-- Action Card -->
                        <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-sm">
                            <h3 class="text-lg font-bold text-slate-900 mb-4">Actions Rapides</h3>
                            
                            <div class="space-y-3">
                                <!-- Button Ajouter Médecin -->
                                <button id="btn-add-doctor" class="flex w-full items-center gap-3 rounded-xl bg-slate-900 p-3.5 text-left text-sm font-semibold text-white shadow-sm hover:bg-slate-850 hover:scale-[1.01] active:scale-[0.99] transition-all duration-250">
                                    <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-slate-800 text-teal-400">
                                        <i class="fa-solid fa-user-plus"></i>
                                    </span>
                                    <div>
                                        <p>Ajouter un Médecin</p>
                                        <p class="text-xs font-normal text-slate-400">Créer un profil avec spécialité</p>
                                    </div>
                                    <i class="fa-solid fa-chevron-right ml-auto text-slate-500 text-xs"></i>
                                </button>

                                <!-- Button Gérer les spécialités -->
                                <button id="btn-add-specialty" class="flex w-full items-center gap-3 rounded-xl border border-slate-200 bg-white p-3.5 text-left text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 hover:scale-[1.01] active:scale-[0.99] transition-all duration-250">
                                    <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-slate-100 text-teal-600">
                                        <i class="fa-solid fa-folder-plus"></i>
                                    </span>
                                    <div>
                                        <p>Nouvelle Spécialité</p>
                                        <p class="text-xs font-normal text-slate-400">Mettre à jour les filtres de recherche</p>
                                    </div>
                                    <i class="fa-solid fa-chevron-right ml-auto text-slate-400 text-xs"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Mini Liste des Spécialités Actives -->
                        <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-sm">
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="text-sm font-bold text-slate-900">Spécialités Populaires</h4>
                                <a href="#" class="text-xs font-semibold text-teal-600 hover:underline">Voir tout</a>
                            </div>
                            <div class="flex flex-wrap gap-2">
                                <span class="inline-flex items-center gap-1.5 rounded-xl bg-slate-100 px-3 py-1.5 text-xs font-medium text-slate-600">Cardiologie</span>
                                <span class="inline-flex items-center gap-1.5 rounded-xl bg-slate-100 px-3 py-1.5 text-xs font-medium text-slate-600">Pédiatrie</span>
                                <span class="inline-flex items-center gap-1.5 rounded-xl bg-slate-100 px-3 py-1.5 text-xs font-medium text-slate-600">Dentaire</span>
                                <span class="inline-flex items-center gap-1.5 rounded-xl bg-slate-100 px-3 py-1.5 text-xs font-medium text-slate-600">Ophtalmologie</span>
                            </div>
                        </div>

                    </div>
                </div>

            </main>
        </div>
    </div>

    <!-- ======================================================== -->
    <!-- MODAL 1: ADD DOCTOR (US 3.1)                             -->
    <!-- ======================================================== -->
    <div id="modal-doctor" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-md hidden transition-opacity duration-300">
        <div class="relative w-full max-w-lg rounded-2xl border border-slate-100 bg-white p-6 shadow-2xl transform scale-95 transition-transform duration-300 ease-out">
            
            <!-- Header Modal -->
            <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-5">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-teal-50 text-teal-600">
                        <i class="fa-solid fa-user-doctor text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Nouveau Médecin</h3>
                        <p class="text-xs text-slate-500">Créer un compte praticien pour votre clinique</p>
                    </div>
                </div>
                <button id="close-doctor-modal" class="text-slate-400 hover:text-slate-600 hover:bg-slate-100 p-2 rounded-lg transition-all">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <!-- Form -->
            <form id="form-doctor" class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <!-- Nom complet -->
                    <div class="col-span-2">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-1">Nom Complet</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                                <i class="fa-regular fa-user"></i>
                            </span>
                            <input type="text" required placeholder="Dr. Prénom Nom" class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-4 text-sm outline-none transition-all focus:border-teal-500 focus:bg-white focus:ring-4 focus:ring-teal-500/10">
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="col-span-2">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-1">Adresse E-mail</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                                <i class="fa-regular fa-envelope"></i>
                            </span>
                            <input type="email" required placeholder="nom@medirest.com" class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-4 text-sm outline-none transition-all focus:border-teal-500 focus:bg-white focus:ring-4 focus:ring-teal-500/10">
                        </div>
                    </div>

                    <!-- Spécialité (Association Obligatoire) -->
                    <div class="col-span-2 sm:col-span-1">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-1">Spécialité <span class="text-rose-500">*</span></label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                                <i class="fa-solid fa-stethoscope"></i>
                            </span>
                            <select required class="w-full appearance-none rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-8 text-sm outline-none transition-all focus:border-teal-500 focus:bg-white focus:ring-4 focus:ring-teal-500/10">
                               <option value="">Choisir la spécialité...</option>
                                        <?php if (!empty($specialites)): ?>
                                            <?php foreach ($specialites as $spec): ?>
                                                <option value="<?php echo htmlspecialchars($spec['id']); ?>">
                                                    <?php echo htmlspecialchars($spec['nom']); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <option value="" disabled>Aucune spécialité trouvée</option>
                                        <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <!-- Statut initial -->
                    <div class="col-span-2 sm:col-span-1">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-1">Statut Initial</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                                <i class="fa-solid fa-toggle-on"></i>
                            </span>
                            <select class="w-full appearance-none rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-8 text-sm outline-none transition-all focus:border-teal-500 focus:bg-white focus:ring-4 focus:ring-teal-500/10">
                                <option value="actif">Actif d'office</option>
                                <option value="desactive">Désactivé (Brouillon)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Footer Modal -->
                <div class="flex items-center justify-end gap-3 border-t border-slate-100 pt-5 mt-6">
                    <button type="button" id="cancel-doctor-modal" class="rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 active:scale-[0.98] transition-all">
                        Annuler
                    </button>
                    <button type="submit" class="rounded-xl bg-teal-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-teal-500/20 hover:bg-teal-700 hover:shadow-teal-500/30 active:scale-[0.98] transition-all">
                        Créer le Compte
                    </button>
                </div>
            </form>
        </div>
    </div>


    <!-- ======================================================== -->
    <!-- MODAL 2: ADD SPECIALTY (US 3.2)                          -->
    <!-- ======================================================== -->
    <div id="modal-specialty" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-md hidden transition-opacity duration-300">
        <div class="relative w-full max-w-md rounded-2xl border border-slate-100 bg-white p-6 shadow-2xl transform scale-95 transition-transform duration-300 ease-out">
            
            <!-- Header Modal -->
            <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-5">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-teal-50 text-teal-600">
                        <i class="fa-solid fa-stethoscope text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Nouvelle Spécialité</h3>
                        <p class="text-xs text-slate-500">Ajouter pour le filtrage de recherche patients</p>
                    </div>
                </div>
                <button id="close-specialty-modal" class="text-slate-400 hover:text-slate-600 hover:bg-slate-100 p-2 rounded-lg transition-all">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <!-- Form -->
            <form action="../../src/Controller/admin_controller.php" method="POST" id="form-specialty" class="space-y-4">
                <!-- Nom de la Spécialité -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-1">Nom de la Spécialité</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                            <i class="fa-solid fa-tag"></i>
                        </span>
                        <input type="text" name="specialite_name" required placeholder="Ex: Gynécologie, Ophtalmologie" class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-4 text-sm outline-none transition-all focus:border-teal-500 focus:bg-white focus:ring-4 focus:ring-teal-500/10">
                    </div>
                </div>

                <!-- Footer Modal -->
                <div class="flex items-center justify-end gap-3 border-t border-slate-100 pt-5 mt-6">
                    <button type="button" id="cancel-specialty-modal" class="rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 active:scale-[0.98] transition-all">
                        Annuler
                    </button>
                    <button name="add_spécialité" type="submit" class="rounded-xl bg-teal-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-teal-500/20 hover:bg-teal-700 hover:shadow-teal-500/30 active:scale-[0.98] transition-all">
                        Ajouter
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ======================================================== -->
    <!-- JAVASCRIPT LOGIC                                         -->
    <!-- ======================================================== -->
    <script>
        // DOM Elements
        const addDoctorBtn = document.getElementById('btn-add-doctor');
        const sidebarDoctorBtn = document.getElementById('sidebar-add-doctor');
        
        const addSpecialtyBtn = document.getElementById('btn-add-specialty');
        const sidebarSpecialtyBtn = document.getElementById('sidebar-add-specialty');

        const modalDoctor = document.getElementById('modal-doctor');
        const modalSpecialty = document.getElementById('modal-specialty');

        const closeDoctor = document.getElementById('close-doctor-modal');
        const cancelDoctor = document.getElementById('cancel-doctor-modal');

        const closeSpecialty = document.getElementById('close-specialty-modal');
        const cancelSpecialty = document.getElementById('cancel-specialty-modal');

        const openModal = (modal) => {
            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
            setTimeout(() => {
                modal.querySelector('.transform').classList.remove('scale-95');
                modal.querySelector('.transform').classList.add('scale-100');
            }, 10);
        };

        const closeModal = (modal) => {
            modal.querySelector('.transform').classList.remove('scale-100');
            modal.querySelector('.transform').classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }, 150);
        };

        addDoctorBtn.addEventListener('click', () => openModal(modalDoctor));
        sidebarDoctorBtn.addEventListener('click', (e) => { e.preventDefault(); openModal(modalDoctor); });
        closeDoctor.addEventListener('click', () => closeModal(modalDoctor));
        cancelDoctor.addEventListener('click', () => closeModal(modalDoctor));

        addSpecialtyBtn.addEventListener('click', () => openModal(modalSpecialty));
        sidebarSpecialtyBtn.addEventListener('click', (e) => { e.preventDefault(); openModal(modalSpecialty); });
        closeSpecialty.addEventListener('click', () => closeModal(modalSpecialty));
        cancelSpecialty.addEventListener('click', () => closeModal(modalSpecialty));

        window.addEventListener('click', (e) => {
            if (e.target === modalDoctor) closeModal(modalDoctor);
            if (e.target === modalSpecialty) closeModal(modalSpecialty);
        });

        document.getElementById('form-doctor').addEventListener('submit', (e) => {
            e.preventDefault();
            alert('Médecin créé avec succès (US 3.1) !');
            closeModal(modalDoctor);
        });

        document.getElementById('form-specialty').addEventListener('submit', (e) => {
            e.preventDefault();
            alert('Spécialité ajoutée avec succès (US 3.2) !');
            closeModal(modalSpecialty);
        });
    </script>
</body>
</html>
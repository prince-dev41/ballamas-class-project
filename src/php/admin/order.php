<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commandes - Ballamas Sport</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #858796;
            --success-color: #1cc88a;
            --info-color: #36b9cc;
            --warning-color: #f6c23e;
            --danger-color: #e74a3b;
        }

        body {
            background-color: #f8f9fc;
            font-family: 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }

        .sidebar {
            background: linear-gradient(180deg, var(--primary-color) 10%, #224abe 100%);
            min-height: 100vh;
            position: fixed;
            transition: all 0.3s ease-in-out;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 1rem 1.5rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .sidebar .nav-link:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
            margin: 0 0.5rem;
        }

        .sidebar .nav-link.active {
            color: #fff;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 5px;
            margin: 0 0.5rem;
        }

        .main-content {
            margin-left: 250px;
            padding: 1.5rem;
        }

        .card {
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 0.15rem 1.75rem rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
        }

        .card:hover {
            transform: translateY(-3px);
        }

        .navbar {
            box-shadow: 0 0.15rem 1.75rem rgba(0, 0, 0, 0.15);
            background: white !important;
            padding: 1rem;
        }

        .navbar-brand {
            color: var(--primary-color) !important;
            font-weight: 700;
            font-size: 1.5rem;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 0.15rem 1.75rem rgba(0, 0, 0, 0.15);
        }

        .progress {
            height: 0.5rem;
            border-radius: 0.25rem;
        }

        /* Hamburger Menu */
        .hamburger {
            width: 30px;
            height: 30px;
            position: relative;
            cursor: pointer;
            display: none;
            z-index: 1000;
        }

        .hamburger span {
            display: block;
            position: absolute;
            height: 3px;
            width: 100%;
            background: var(--primary-color);
            border-radius: 3px;
            transition: all 0.3s ease;
        }

        .hamburger span:nth-child(1) { top: 0; }
        .hamburger span:nth-child(2) { top: 10px; }
        .hamburger span:nth-child(3) { top: 20px; }

        .hamburger.active span:nth-child(1) {
            transform: rotate(45deg);
            top: 10px;
        }

        .hamburger.active span:nth-child(2) {
            opacity: 0;
        }

        .hamburger.active span:nth-child(3) {
            transform: rotate(-45deg);
            top: 10px;
        }

        @media (max-width: 991px) {
            .hamburger {
                display: block;
            }
        }

        @media (max-width: 767.98px) {
            .main-content {
                margin-left: 0;
            }
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.show {
                transform: translateX(0);
            }
        }

        /* Animations */
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Modal Styles */
        .modal-dialog {
            max-width: 600px;
        }

        .modal-header {
            background-color: var(--primary-color);
            color: white;
        }

        .modal-footer {
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="navbar navbar-expand navbar-light sticky-top">
        <div class="d-flex align-items-center">
            <div class="hamburger d-lg-none">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <a class="navbar-brand" href="/app-sport/home">
                <i class="fas fa-running me-2"></i>
                Ballamas
            </a>
        </div>
        <div class="ms-auto d-flex align-items-center">
            <div class="dropdown">
                <a class="btn btn-link text-dark dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                    <i class="fas fa-bell"></i>
                    <span class="badge bg-danger">3</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">Nouvelle commande #123</a></li>
                    <li><a class="dropdown-item" href="#">Stock faible: Maillot XL</a></li>
                    <li><a class="dropdown-item" href="#">5 nouveaux clients</a></li>
                </ul>
            </div>
            <div class="dropdown ms-3">
                <a class="btn btn-link text-dark dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                    <img src="https://ui-avatars.com/api/?name=Admin&background=4e73df&color=fff" class="rounded-circle me-2" width="32" height="32">
                    <span>Admin</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="setting"><i class="fas fa-user fa-fw me-2"></i>Profil</a></li>
                    <li><a class="dropdown-item" href="setting"><i class="fas fa-cog fa-fw me-2"></i>Paramètres</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="logout"><i class="fas fa-sign-out-alt fa-fw me-2"></i>Déconnexion</a></li>
                </ul>
            </div>
        </div>
    </header>

    <!-- Overlay pour mobile -->
    <div class="sidebar-overlay"></div>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebarMenu" class="col-md-3 z-3 col-lg-2 sidebar">
                <div class="position-sticky pt-4">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard">
                                <i class="fas fa-home fa-fw me-2"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="order">
                                <i class="fas fa-shopping-bag fa-fw me-2"></i>
                                Commandes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="products">
                                <i class="fas fa-tshirt fa-fw me-2"></i>
                                Produits
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="categories">
                                <i class="fas fa-users fa-fw me-2"></i>
                                Catégories
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="customers">
                                <i class="fas fa-users fa-fw me-2"></i>
                                Clients
                            </a>
                        </li>
                        <li class="nav-item mt-2">
                            <a class="nav-link" href="setting">
                                <i class="fas fa-cog fa-fw me-2"></i>
                                Paramètres
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout">
                                <i class="fas fa-sign-out-alt fa-fw me-2"></i>
                                Déconnexion
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="main-content col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                    <div>
                        <h1 class="h3 mb-0 text-gray-800">Commandes</h1>
                        <p class="text-muted">Gérez vos commandes ici</p>
                    </div>
                </div>

                <!-- Commandes Table -->
                <div class="card mb-4 fade-in">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Liste des Commandes</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Client</th>
                                        <th>Produit</th>
                                        <th>Adresse</th>
                                        <th>Statut</th>
                                        <th>Montant</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="commandes-table">
                                    <!-- Les commandes seront affichées ici -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Modal pour modifier le statut -->
    <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusModalLabel">Modifier le Statut</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="statusForm">
                        <input type="hidden" id="commande-id">
                        <div class="mb-3">
                            <label for="statut" class="form-label">Statut</label>
                            <select class="form-select" id="statut" required>
                                <option value="En cours">En cours</option>
                                <option value="Préparation">Préparation</option>
                                <option value="Livré">Livré</option>
                                <option value="Annulé">Annulé</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Modifier</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal pour confirmer la suppression -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmer la Suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Voulez-vous vraiment supprimer cette commande ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Supprimer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
        // Fonction pour afficher les détails d'une commande
        function viewCommande(id) {
            alert('Voir les détails de la commande #' + id);
        }

        // Fonction pour modifier le statut d'une commande
        function editStatus(id, currentStatus) {
            const commandeIdInput = document.getElementById('commande-id');
            const statutSelect = document.getElementById('statut');
            const statusModal = new bootstrap.Modal(document.getElementById('statusModal'));

            commandeIdInput.value = id;
            statutSelect.value = currentStatus;
            statusModal.show();
        }

        // Fonction pour confirmer la suppression d'une commande
        function confirmDelete(id) {
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            const confirmDeleteButton = document.getElementById('confirmDelete');
            let commandeIdToDelete = id;

            deleteModal.show();

            confirmDeleteButton.addEventListener('click', function() {
                fetch('http://localhost/app-sport/src/php/api/delete_order.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ id: commandeIdToDelete })
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    deleteModal.hide();
                    loadCommandes();
                });
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const commandesTable = document.getElementById('commandes-table');
            const statusForm = document.getElementById('statusForm');
            const commandeIdInput = document.getElementById('commande-id');
            const statutSelect = document.getElementById('statut');

            // Fonction pour charger les commandes
            function loadCommandes() {
                fetch('http://localhost/app-sport/src/php/api/get_orders.php')
                    .then(response => response.json())
                    .then(data => {
                        commandesTable.innerHTML = '';
                        data.forEach(commande => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td>#${commande.id}</td>
                                <td>${commande.client_nom} ${commande.client_prenom}</td>
                                <td>${commande.produits}</td>
                                <td>${commande.adresse_livraison}</td>
                                <td><span class="badge bg-${getBadgeClass(commande.statut)}">${commande.statut}</span></td>
                                <td>${commande.total} €</td>
                                <td>${new Date(commande.date_commande).toLocaleDateString()}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning me-1" onclick="editStatus(${commande.id}, '${commande.statut}')">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" onclick="confirmDelete(${commande.id})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            `;
                            commandesTable.appendChild(row);
                        });
                    });
            }

            // Fonction pour obtenir la classe de badge en fonction du statut
            function getBadgeClass(statut) {
                switch (statut) {
                    case 'Livré':
                        return 'success';
                    case 'En cours':
                        return 'warning';
                    case 'Préparation':
                        return 'info';
                    case 'Annulé':
                        return 'danger';
                    default:
                        return 'secondary';
                }
            }

            // Écouteur pour le formulaire de modification du statut
            statusForm.addEventListener('submit', function(event) {
                event.preventDefault();
                const id = commandeIdInput.value;
                const statut = statutSelect.value;

                fetch('http://localhost/app-sport/src/php/api/update_order_status.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ id, statut })
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    const statusModal = new bootstrap.Modal(document.getElementById('statusModal'));
                    statusModal.hide();
                    loadCommandes();
                });
            });

            // Charger les commandes au chargement de la page
            loadCommandes();

            // Hamburger Menu Toggle
            const hamburger = document.querySelector('.hamburger');
            const sidebar = document.querySelector('.sidebar');
            const mainContent = document.querySelector('.main-content');
            const overlay = document.querySelector('.sidebar-overlay');

            hamburger.addEventListener('click', function() {
                hamburger.classList.toggle('active');
                sidebar.classList.toggle('show');
                overlay.classList.toggle('show');
            });

            // Fermer le menu au clic sur l'overlay
            overlay.addEventListener('click', function() {
                hamburger.classList.remove('active');
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
            });
        });
    </script>
</body>
</html>

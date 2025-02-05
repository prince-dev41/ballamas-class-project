<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord - Ballamas Sport</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Chart.js -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.css">
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

        .stats-card {
            position: relative;
            overflow: hidden;
        }

        .stats-card .icon {
            position: absolute;
            right: 1rem;
            bottom: 1rem;
            opacity: 0.3;
            font-size: 2rem;
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
                            <a class="nav-link active" href="dashboard">
                                <i class="fas fa-home fa-fw me-2"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="order">
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
                        <h1 class="h3 mb-0 text-gray-800">Tableau de Bord</h1>
                        <p class="text-muted">Vue d'ensemble de votre boutique</p>
                    </div>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-download fa-fw me-1"></i>Rapport
                            </button>
                        </div>
                        <a href="products">
                            <button type="button" class="btn btn-sm btn-primary">
                                <i class="fas fa-plus fa-fw me-1"></i>Nouveau Produit
                            </button>
                        </a>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="row fade-in">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card stats-card h-100 py-2 bg-primary text-white">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <div class="text-xs font-weight-bold text-uppercase mb-1">Ventes Mensuelles</div>
                                        <div class="h5 mb-0 font-weight-bold" id="totalSales">40,000 €</div>
                                        <div class="mt-2 text-white-50 small">
                                            <i class="fas fa-arrow-up me-1"></i>3.48% depuis le mois dernier
                                        </div>
                                    </div>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-euro-sign"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card stats-card h-100 py-2 bg-success text-white">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <div class="text-xs font-weight-bold text-uppercase mb-1">Commandes</div>
                                        <div class="h5 mb-0 font-weight-bold" id="totalOrders">215</div>
                                        <div class="mt-2 text-white-50 small">
                                            <i class="fas fa-arrow-up me-1"></i>12% cette semaine
                                        </div>
                                    </div>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card stats-card h-100 py-2 bg-info text-white">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <div class="text-xs font-weight-bold text-uppercase mb-1">Clients</div>
                                        <div class="h5 mb-0 font-weight-bold" id="totalCustomers">573</div>
                                        <div class="mt-2 text-white-50 small">
                                            <i class="fas fa-user-plus me-1"></i>18 nouveaux aujourd'hui
                                        </div>
                                    </div>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card stats-card h-100 py-2 bg-warning text-white">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <div class="text-xs font-weight-bold text-uppercase mb-1">Produits</div>
                                        <div class="h5 mb-0 font-weight-bold" id="totalProducts">120</div>
                                        <div class="mt-2 text-white-50 small">
                                            <i class="fas fa-exclamation-triangle me-1"></i>5 en stock faible
                                        </div>
                                    </div>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-box"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Row -->
                <div class="row fade-in">
                    <div class="col-xl-8 col-lg-7">
                        <div class="card mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Aperçu des Ventes</h6>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-link text-muted" type="button" data-bs-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Cette Semaine</a>
                                        <a class="dropdown-item" href="#">Ce Mois</a>
                                        <a class="dropdown-item" href="#">Cette Année</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="salesChart" height="300"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-5">
                        <div class="card mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Répartition des Ventes</h6>
                            </div>
                            <div class="card-body">
                                <canvas id="pieChart" height="300"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Orders -->
                <div class="card mb-4 fade-in">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Commandes Récentes</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="recentOrdersTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Client</th>
                                        <th>Adresse de Livraison</th>
                                        <th>Produits</th>
                                        <th>Statut</th>
                                        <th>Montant</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Les commandes seront ajoutées ici dynamiquement -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Fetch orders from API
        fetch('http://localhost/app-sport/src/php/api/get_orders.php')
            .then(response => response.json())
            .then(data => {
                const recentOrdersTableBody = document.querySelector('#recentOrdersTable tbody');
                recentOrdersTableBody.innerHTML = '';
                data.slice(0, 5).forEach(order => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>#${order.id}</td>
                        <td>${order.client_nom} ${order.client_prenom}</td>
                        <td>${order.adresse_livraison}</td>
                        <td>${order.produits}</td>
                        <td><span class="badge bg-${order.statut.toLowerCase() === 'livré' ? 'success' : order.statut.toLowerCase() === 'annulé' ? 'danger' : 'warning'}">${order.statut}</span></td>
                        <td>${order.total} €</td>
                        <td>${new Date(order.date_commande).toLocaleDateString()}</td>
                    `;
                    recentOrdersTableBody.appendChild(row);
                });

                // Calculate total sales
                const totalSales = data.reduce((sum, order) => sum + parseFloat(order.total), 0);
                document.getElementById('totalSales').textContent = `${totalSales.toFixed(2)} €`;

                // Calculate total orders
                const totalOrders = data.length;
                document.getElementById('totalOrders').textContent = totalOrders;
            })
            .catch(error => {
                console.error('Error:', error);
            });

        // Fetch customers from API
        fetch('http://localhost/app-sport/src/php/api/get_customers.php')
            .then(response => response.json())
            .then(data => {
                const totalCustomers = data.length;
                document.getElementById('totalCustomers').textContent = totalCustomers;
            })
            .catch(error => {
                console.error('Error:', error);
            });

        // Fetch products from API
        fetch('http://localhost/app-sport/src/php/api/products.php')
            .then(response => response.json())
            .then(data => {
                const totalProducts = data.length;
                document.getElementById('totalProducts').textContent = totalProducts;

                // Calculate low stock products
                const lowStockProducts = data.filter(product => product.stock < 10).length;
                document.querySelector('#totalProducts + .small').textContent = `${lowStockProducts} en stock faible`;
            })
            .catch(error => {
                console.error('Error:', error);
            });

        // Fetch sales by category from API
        fetch('http://localhost/app-sport/src/php/api/get_sales_by_category.php')
            .then(response => response.json())
            .then(data => {
                const labels = data.map(item => item.categorie_nom);
                const values = data.map(item => item.total_ventes);

                // Pie Chart
                const pieCtx = document.getElementById('pieChart').getContext('2d');
                new Chart(pieCtx, {
                    type: 'doughnut',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: values,
                            backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e'],
                            hoverOffset: 4
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
            })
            .catch(error => {
                console.error('Error:', error);
            });

        // Fetch sales by month from API
        fetch('http://localhost/app-sport/src/php/api/get_sales_by_month.php')
            .then(response => response.json())
            .then(data => {
                const labels = data.map(item => item.month);
                const values = data.map(item => item.total_sales);

                // Sales Chart
                const salesCtx = document.getElementById('salesChart').getContext('2d');
                new Chart(salesCtx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Ventes 2023',
                            data: values,
                            borderColor: '#4e73df',
                            tension: 0.3,
                            fill: true,
                            backgroundColor: 'rgba(78, 115, 223, 0.05)'
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    borderDash: [2],
                                    drawBorder: false
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            })
            .catch(error => {
                console.error('Error:', error);
            });

        // Fade in animation for cards
        document.addEventListener('DOMContentLoaded', function() {
            const fadeElements = document.querySelectorAll('.fade-in');
            fadeElements.forEach((element, index) => {
                element.style.animationDelay = `${index * 0.1}s`;
            });
        });

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
    </script>
</body>
</html>

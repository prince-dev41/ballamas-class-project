<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: http://localhost/app-sport/admin/login');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catégories - Ballamas Sport</title>
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
                    <span class="badge bg-danger">1</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="orders">Commande</a></li>
                    <li><a class="dropdown-item" href="customes">Clients</a></li>
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
                            <a class="nav-link active" href="categories">
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
                                <i class="fas fa-cog fa-fw me-2"></i>
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
                        <h1 class="h3 mb-0 text-gray-800">Catégories</h1>
                        <p class="text-muted">Gérez vos catégories ici</p>
                    </div>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                            <i class="fas fa-plus fa-fw me-1"></i>Nouvelle Catégorie
                        </button>
                    </div>
                </div>

                <!-- Catégories Table -->
                <div class="card mb-4 fade-in">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Liste des Catégories</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="categoryTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nom</th>
                                        <th>Image</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Les catégories seront ajoutées ici dynamiquement -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Ajouter une Catégorie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addCategoryForm">
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Nom de la Catégorie</label>
                            <input type="text" class="form-control" id="categoryName" required>
                        </div>
                        <div class="mb-3">
                            <label for="categoryImage" class="form-label">Image de la Catégorie</label>
                            <input type="file" class="form-control" id="categoryImage" accept="image/*">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" id="addCategoryButton">Ajouter</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryModalLabel">Modifier une Catégorie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editCategoryForm">
                        <input type="hidden" id="editCategoryId">
                        <div class="mb-3">
                            <label for="editCategoryName" class="form-label">Nom de la Catégorie</label>
                            <input type="text" class="form-control" id="editCategoryName" required>
                        </div>
                        <div class="mb-3">
                            <label for="editCategoryImage" class="form-label">Image de la Catégorie</label>
                            <input type="file" class="form-control" id="editCategoryImage" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <img id="editCategoryImagePreview" src="" alt="Image Preview" class="img-fluid">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" id="editCategoryButton">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Category Modal -->
    <div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteCategoryModalLabel">Supprimer une Catégorie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr de vouloir supprimer cette catégorie ?</p>
                    <input type="hidden" id="deleteCategoryId">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-danger" id="deleteCategoryButton">Supprimer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
    // Définir les fonctions deleteCategory et editCategory en dehors de l'événement DOMContentLoaded
    function deleteCategory(id) {
        document.getElementById('deleteCategoryId').value = id;
        console.log(id);
    }

    function editCategory(id) {
        fetch(`http://localhost/app-sport/src/php/api/get_category.php?id=${id}`)
            .then(response => response.json())
            .then(category => {
                document.getElementById('editCategoryId').value = category.id;
                document.getElementById('editCategoryName').value = category.nom;
                if (category.image) {
                    document.getElementById('editCategoryImagePreview').src = category.image;
                } else {
                    document.getElementById('editCategoryImagePreview').src = '';
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const fadeElements = document.querySelectorAll('.fade-in');
        fadeElements.forEach((element, index) => {
            element.style.animationDelay = `${index * 0.1}s`;
        });

        // Fetch categories from API
        fetch('http://localhost/app-sport/src/php/api/get_categories.php')
            .then(response => response.json())
            .then(data => {
                const categoryTableBody = document.querySelector('#categoryTable tbody');
                categoryTableBody.innerHTML = '';
                data.forEach(category => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>#${category.id}</td>
                        <td>${category.nom}</td>
                        <td><img src="${category.image || ''}" alt="Category Image" class="img-fluid" style="max-width: 100px;"></td>
                        <td>
                            <button class="btn btn-sm btn-info me-1" data-bs-toggle="modal" data-bs-target="#editCategoryModal" onclick="editCategory(${category.id})">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal" onclick="deleteCategory(${category.id})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    `;
                    categoryTableBody.appendChild(row);
                });
            })
            .catch(error => {
                console.error('Error:', error);
            });

        // Handle add category form submission
        document.getElementById('addCategoryButton').addEventListener('click', function() {
            const name = document.getElementById('categoryName').value;
            const imageInput = document.getElementById('categoryImage');
            let image = null;

            if (imageInput.files && imageInput.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    image = e.target.result.split(',')[1]; // Obtenir la partie base64

                    const data = {
                        nom: name,
                        image: image
                    };

                    fetch('http://localhost/app-sport/src/php/api/add_category.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(data)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Catégorie ajoutée avec succès');
                            location.reload();
                        } else {
                            alert('Erreur lors de l\'ajout de la catégorie');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                };
                reader.readAsDataURL(imageInput.files[0]);
            } else {
                const data = {
                    nom: name
                };

                fetch('http://localhost/app-sport/src/php/api/add_category.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Catégorie ajoutée avec succès');
                        location.reload();
                    } else {
                        alert('Erreur lors de l\'ajout de la catégorie');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        });

        // Handle edit category form submission
        document.getElementById('editCategoryButton').addEventListener('click', function() {
            const id = document.getElementById('editCategoryId').value;
            const name = document.getElementById('editCategoryName').value;
            const imageInput = document.getElementById('editCategoryImage');
            let image = null;

            if (imageInput.files && imageInput.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    image = e.target.result.split(',')[1]; // Obtenir la partie base64

                    const data = {
                        id: id,
                        nom: name,
                        image: image
                    };

                    fetch('http://localhost/app-sport/src/php/api/update_category.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(data)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Catégorie mise à jour avec succès');
                            location.reload();
                        } else {
                            alert('Erreur lors de la mise à jour de la catégorie');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                };
                reader.readAsDataURL(imageInput.files[0]);
            } else {
                const data = {
                    id: id,
                    nom: name
                };

                fetch('http://localhost/app-sport/src/php/api/update_category.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Catégorie mise à jour avec succès');
                        location.reload();
                    } else {
                        alert('Erreur lors de la mise à jour de la catégorie');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        });

        // Handle delete category button click
        document.getElementById('deleteCategoryButton').addEventListener('click', function() {
            const categoryId = document.getElementById('deleteCategoryId').value;
            const data = { id: categoryId };

            fetch('http://localhost/app-sport/src/php/api/delete_category.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Catégorie supprimée avec succès');
                    location.reload();
                } else {
                    alert('Erreur lors de la suppression de la catégorie');
                }
            })
            .catch(error => {
                console.error('Error:', error);
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
    });
</script>

</body>
</html>

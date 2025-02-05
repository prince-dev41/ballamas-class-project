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
    <title>Produits - Ballamas Sport</title>
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
                            <a class="nav-link" href="order">
                                <i class="fas fa-shopping-bag fa-fw me-2"></i>
                                Commandes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="products">
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
                        <h1 class="h3 mb-0 text-gray-800">Produits</h1>
                        <p class="text-muted">Gérez vos produits ici</p>
                    </div>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                            <i class="fas fa-plus fa-fw me-1"></i>Nouveau Produit
                        </button>
                    </div>
                </div>

                <!-- Produits Table -->
                <div class="card mb-4 fade-in">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Liste des Produits</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="productTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nom</th>
                                        <th>Prix</th>
                                        <th>Stock</th>
                                        <th>Catégorie</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Les produits seront ajoutés ici dynamiquement -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Add Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Ajouter un Produit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addProductForm">
                        <div class="mb-3">
                            <label for="productName" class="form-label">Nom du Produit</label>
                            <input type="text" class="form-control" id="productName" required>
                        </div>
                        <div class="mb-3">
                            <label for="productPrice" class="form-label">Prix</label>
                            <input type="number" class="form-control" id="productPrice" required>
                        </div>
                        <div class="mb-3">
                            <label for="productStock" class="form-label">Stock</label>
                            <input type="number" class="form-control" id="productStock" required>
                        </div>
                        <div class="mb-3">
                            <label for="productDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="productDescription" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="productCategory" class="form-label">Catégorie</label>
                            <select class="form-control" id="productCategory" required>
                                <!-- Les catégories seront ajoutées ici dynamiquement -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="productImage" class="form-label">Image</label>
                            <input type="file" class="form-control" id="productImage" accept="image/*">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" id="addProductButton">Ajouter</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Product Modal -->
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductModalLabel">Modifier un Produit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editProductForm">
                        <input type="hidden" id="editProductId">
                        <div class="mb-3">
                            <label for="editProductName" class="form-label">Nom du Produit</label>
                            <input type="text" class="form-control" id="editProductName" required>
                        </div>
                        <div class="mb-3">
                            <label for="editProductPrice" class="form-label">Prix</label>
                            <input type="number" class="form-control" id="editProductPrice" required>
                        </div>
                        <div class="mb-3">
                            <label for="editProductStock" class="form-label">Stock</label>
                            <input type="number" class="form-control" id="editProductStock" required>
                        </div>
                        <div class="mb-3">
                            <label for="editProductDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="editProductDescription" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editProductCategory" class="form-label">Catégorie</label>
                            <select class="form-control" id="editProductCategory" required>
                                <!-- Les catégories seront ajoutées ici dynamiquement -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editProductImage" class="form-label">Image</label>
                            <input type="file" class="form-control" id="editProductImage" accept="image/*">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" id="editProductButton">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Product Modal -->
    <div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteProductModalLabel">Supprimer un Produit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr de vouloir supprimer ce produit ?</p>
                    <input type="hidden" id="deleteProductId">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-danger" id="deleteProductButton">Supprimer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
        // Fade in animation for cards
        document.addEventListener('DOMContentLoaded', function() {
            const fadeElements = document.querySelectorAll('.fade-in');
            fadeElements.forEach((element, index) => {
                element.style.animationDelay = `${index * 0.1}s`;
            });

            // Fetch categories from API
            fetch('http://localhost/app-sport/src/php/api/get_categories.php')
                .then(response => response.json())
                .then(data => {
                    const addCategorySelect = document.getElementById('productCategory');
                    const editCategorySelect = document.getElementById('editProductCategory');
                    data.forEach(category => {
                        const option = document.createElement('option');
                        option.value = category.id;
                        option.textContent = category.nom;
                        addCategorySelect.appendChild(option);
                        editCategorySelect.appendChild(option.cloneNode(true));
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                });

            // Fetch products from API
            fetch('http://localhost/app-sport/src/php/api/products.php')
                .then(response => response.json())
                .then(data => {
                    const productTableBody = document.querySelector('#productTable tbody');
                    productTableBody.innerHTML = '';
                    data.forEach(product => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>#${product.id}</td>
                            <td>${product.nom}</td>
                            <td>${product.prix} €</td>
                            <td>${product.stock}</td>
                            <td>${product.categorie_nom}</td>
                            <td>
                                <button class="btn btn-sm btn-info me-1" data-bs-toggle="modal" data-bs-target="#editProductModal" onclick="editProduct(${product.id})">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteProductModal" onclick="deleteProduct(${product.id})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        `;
                        productTableBody.appendChild(row);
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                });

            // Handle add product form submission
            document.getElementById('addProductButton').addEventListener('click', async function() {
                const name = document.getElementById('productName').value;
                const price = document.getElementById('productPrice').value;
                const productDescription = document.getElementById('productDescription').value;
                const productStock = document.getElementById('productStock').value;
                const imageInput = document.getElementById('productImage');
                const image = imageInput.files[0] ? await toBase64(imageInput.files[0]) : null;
                const productCategory = document.getElementById('productCategory').value;

                const data = {
                    nom: name,
                    prix: price,
                    stock: productStock,
                    image: image,
                    description: productDescription,
                    categorie_id: productCategory
                };

                fetch('http://localhost/app-sport/src/php/api/add_product.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Produit ajouté avec succès');
                        location.reload();
                    } else {
                        alert('Erreur lors de l\'ajout du produit');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });

            // Handle edit product form submission
            document.getElementById('editProductButton').addEventListener('click', async function() {
                const editId = document.getElementById('editProductId').value;
                const name = document.getElementById('editProductName').value;
                const price = document.getElementById('editProductPrice').value;
                const productDescription = document.getElementById('editProductDescription').value;
                const productStock = document.getElementById('editProductStock').value;
                const imageInput = document.getElementById('editProductImage');
                const image = imageInput.files[0] ? await toBase64(imageInput.files[0]) : null;
                const productCategory = document.getElementById('editProductCategory').value;

                const data = {
                    id: editId,
                    nom: name,
                    prix: price,
                    stock: productStock,
                    image: image,
                    description: productDescription,
                    categorie_id: productCategory
                };

                fetch('http://localhost/app-sport/src/php/api/update_product.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Produit mis à jour avec succès');
                        location.reload();
                    } else {
                        alert('Erreur lors de la mise à jour du produit');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });

            // Handle delete product button click
            document.getElementById('deleteProductButton').addEventListener('click', function() {
                const productId = document.getElementById('deleteProductId').value;
                const data = { id: productId };

                fetch('http://localhost/app-sport/src/php/api/delete_product.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Produit supprimé avec succès');
                        location.reload();
                    } else {
                        alert('Erreur lors de la suppression du produit');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        });

        // Function to convert image to base64
        async function toBase64(file) {
            return new Promise((resolve, reject) => {
                const reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = () => resolve(reader.result.split(',')[1]);
                reader.onerror = error => reject(error);
            });
        }

        // Function to set edit product form values
        function editProduct(id) {
            fetch(`http://localhost/app-sport/src/php/api/get_product.php?id=${id}`)
                .then(response => response.json())
                .then(product => {
                    document.getElementById('editProductId').value = product.product.id;
                    document.getElementById('editProductName').value = product.product.nom;
                    document.getElementById('editProductPrice').value = product.product.prix;
                    document.getElementById('editProductStock').value = product.product.stock;
                    document.getElementById('editProductDescription').value = product.product.description;
                    document.getElementById('editProductCategory').value = product.product.categories_id;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        // Function to set delete product id
        function deleteProduct(id) {
            document.getElementById('deleteProductId').value = id;
        }

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

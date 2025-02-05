document.addEventListener('DOMContentLoaded', function() {
    // Fonction pour charger les produits
    function loadProducts(categoryId = null) {
        const url = categoryId
            ? `http://localhost/app-sport/src/php/api/products_by_category.php?id=${categoryId}`
            : 'http://localhost/app-sport/src/php/api/products.php';

        fetch(url)
            .then(response => response.json())
            .then(data => {
                const productsContainer = document.getElementById('products-container');
                productsContainer.innerHTML = ''; // Vider le conteneur avant d'ajouter de nouveaux éléments

                data.forEach(product => {
                    const productCard = `
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <img src="${product.image}" class="card-img-top" alt="${product.nom}" style="height: 320px;">
                                <div class="card-body">
                                    <h5 class="card-title">${product.nom} - ${product.prix} €</h5>
                                    <div class="d-flex align-items-center gap-3">
                                        <a href="/app-sport/product-detail?product=${product.id}" class="btn btn-secondary">Description</a>
                                        <button class="btn btn-success add-to-cart" data-id="${product.id}" data-name="${product.nom}" data-price="${product.prix}" data-image="${product.image}">Ajouter au panier</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    productsContainer.innerHTML += productCard;
                });

                // Ajouter les écouteurs d'événements pour les boutons "Ajouter au panier" après l'ajout des produits
                const addToCartButtons = document.querySelectorAll('.add-to-cart');
                addToCartButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        const productId = button.getAttribute('data-id');
                        const productName = button.getAttribute('data-name');
                        const productPrice = button.getAttribute('data-price');
                        const productImage = button.getAttribute('data-image');
                        addToCart(productId, productName, productPrice, productImage);
                    });
                });
            })
            .catch(error => console.error('Erreur lors du chargement des produits:', error));
    }

    // Fonction pour charger les catégories
    function loadCategories() {
        fetch('http://localhost/app-sport/src/php/api/get_categories.php')
            .then(response => response.json())
            .then(data => {
                const categoriesContainer = document.getElementById('categories-container');
                categoriesContainer.innerHTML = ''; // Vider le conteneur avant d'ajouter de nouveaux éléments

                data.forEach(category => {
                    const categoryCard = `
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                ${category.image ? `<img src="${category.image}" class="card-img-top" alt="${category.nom}">` : ''}
                                <div class="card-body">
                                    <h5 class="card-title">${category.nom}</h5>
                                    <a target=_blank" href="/app-sport/products?category_id=${category.id}" class="btn btn-primary view-category" data-id="${category.id}">Voir les produits</a>
                                </div>
                            </div>
                        </div>
                    `;
                    categoriesContainer.innerHTML += categoryCard;
                });

                // Ajouter les écouteurs d'événements pour les boutons "Voir les produits" après l'ajout des catégories
                const viewCategoryButtons = document.querySelectorAll('.view-category');
                viewCategoryButtons.forEach(button => {
                    button.addEventListener('click', (event) => {
                        event.preventDefault();
                        const categoryId = button.getAttribute('data-id');
                        loadProducts(categoryId);
                    });
                });
            })
            .catch(error => console.error('Erreur lors du chargement des catégories:', error));
    }

    // Charger les produits et les catégories au chargement de la page
    const urlParams = new URLSearchParams(window.location.search);
    const categoryId = urlParams.get('category_id');
    console.log(categoryId);
    loadProducts(categoryId);
    loadCategories();

    // Fonction pour ajouter un produit au panier
    function addToCart(id, name, price, image) {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        const product = { id, name, price, image, quantity: 1 };

        const existingProduct = cart.find(item => item.id === id);
        if (existingProduct) {
            existingProduct.quantity += 1;
        } else {
            cart.push(product);
        }

        localStorage.setItem('cart', JSON.stringify(cart));
        alert('Produit ajouté au panier !');
    }
});

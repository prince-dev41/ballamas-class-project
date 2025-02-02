document.addEventListener('DOMContentLoaded', function() {
    // Fonction pour charger les produits
    function loadProducts() {
        fetch('http://localhost/app-sport/src/php/api/products.php') // Remplacez par votre endpoint API
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
                                    <h5 class="card-title">${product.nom} - ${product.prix} $</h5>
                                    <div class="d-flex align-items-center gap-3">
                                        <a href="/app-sport/product-detail/${product.id}" class="btn btn-primary">Acheter</a>
                                        <a href="/app-sport/product-detail?product=${product.id}" class="btn btn-secondary">Description</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    productsContainer.innerHTML += productCard;
                });
            })
            .catch(error => console.error('Erreur lors du chargement des produits:', error));
    }

    // Fonction pour charger les catégories
    function loadCategories() {
        fetch('http://localhost/app-sport/src/php/api/get_categories.php') // Remplacez par votre endpoint API
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
                                    <a href="/app-sport/products/?categorie${category.id}" class="btn btn-primary">Voir les produits</a>
                                </div>
                            </div>
                        </div>
                    `;
                    categoriesContainer.innerHTML += categoryCard;
                });
            })
            .catch(error => console.error('Erreur lors du chargement des catégories:', error));
    }

    // Charger les produits et les catégories au chargement de la page
    loadProducts();
    loadCategories();
});
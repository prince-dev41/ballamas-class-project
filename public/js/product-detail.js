document.addEventListener('DOMContentLoaded', function() {
    // Récupérer l'ID du produit depuis l'URL
    const urlParams = new URLSearchParams(window.location.search);
    const productId = urlParams.get('product');

    if (!productId) {
        alert('ID du produit manquant');
        return;
    }

    // Récupérer les détails du produit et les produits recommandés depuis l'API
    fetch(`http://localhost/app-sport/src/php/api/get_product.php?id=${productId}`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
                return;
            }

            const product = data.product;
            const randomProducts = data.randomProducts;

            // Afficher les détails du produit
            const productImage = document.getElementById('product-image');
            const productName = document.getElementById('product-name');
            const productPrice = document.getElementById('product-price');
            const productDescription = document.getElementById('product-description');

            productImage.src = product.image;
            productName.textContent = product.nom;
            productPrice.textContent = `${product.prix} $`;
            productDescription.textContent = product.description;

            // Afficher les produits recommandés
            const randomProductsContainer = document.getElementById('random-products-container');
            randomProductsContainer.innerHTML = ''; // Vider le conteneur avant d'ajouter de nouveaux éléments

            randomProducts.forEach(randomProduct => {
                const productCard = `
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="${randomProduct.image}" class="card-img-top" alt="${randomProduct.nom}" style="height: 200px;">
                            <div class="card-body">
                                <h5 class="card-title">${randomProduct.nom}</h5>
                                <p class="card-text">${randomProduct.prix} $</p>
                                <a href="/app-sport/product-detail?product=${randomProduct.id}" class="btn btn-primary">Voir les détails</a>
                            </div>
                        </div>
                    </div>
                `;
                randomProductsContainer.innerHTML += productCard;
            });
        })
        .catch(error => console.error('Erreur lors du chargement des détails du produit:', error));
});
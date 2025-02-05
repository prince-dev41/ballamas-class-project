document.addEventListener('DOMContentLoaded', function() {
    // Afficher le toast automatiquement lorsque la page se charge
    var toastElList = [].slice.call(document.querySelectorAll('.toast'));
    var toastList = toastElList.map(function(toastEl) {
        return new bootstrap.Toast(toastEl);
    });
    toastList.forEach(toast => toast.show());

    // Gérer la soumission du formulaire d'inscription à la newsletter
    document.getElementById('newsletterForm').addEventListener('submit', function(event) {
        event.preventDefault();

        var email = document.getElementById('newsletterEmail').value;
        var messageDiv = document.getElementById('newsletterMessage');

        fetch('/app-sport/src/php/api/subscribe.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ email: email, created_at: new Date() })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                messageDiv.innerHTML = '<div class="alert alert-success fade-show" role="alert">' + data.message + '</div>';
            } else {
                messageDiv.innerHTML = '<div class="alert alert-danger" role="alert">' + data.message + '</div>';
            }
        })
        .catch(error => {
            messageDiv.innerHTML = '<div class="alert alert-danger" role="alert">Une erreur est survenue. Veuillez réessayer plus tard.</div>';
            console.error('Error:', error);
        });
    });

    // Charger les produits en vedette
    const productsContainer = document.querySelector('#products-container .row');
    console.log(productsContainer);

    fetch('http://localhost/app-sport/src/php/api/products.php')
        .then(response => response.json())
        .then(data => {
            // Limiter à 6 produits
            const products = data.slice(0, 6);
            console.log(products);

            // Vider le conteneur avant d'ajouter de nouveaux éléments
            productsContainer.innerHTML = '';

            products.forEach(product => {
                const productCard = document.createElement('div');
                productCard.className = 'col-md-4 mb-4';
                productCard.innerHTML = `
                    <div class="card">
                        <img src="${product.image}" class="card-img-top" alt="${product.nom}" style="height: 320px;">
                        <div class="card-body">
                            <h5 class="card-title">${product.nom} - ${product.prix} $</h5>
                            <div class="d-flex align-items-center gap-3">
                                <a href="/app-sport/product-detail.php?product=${product.id}" class="btn btn-secondary">Description</a>
                                <button class="btn btn-success add-to-cart" data-id="${product.id}" data-name="${product.nom}" data-price="${product.prix}" data-image="${product.image}">Ajouter au panier</button>
                            </div>
                        </div>
                    </div>
                `;
                productsContainer.appendChild(productCard);
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
        .catch(error => {
            console.error('Error:', error);
            productsContainer.innerHTML = '<p class="text-center">Une erreur est survenue lors du chargement des produits.</p>';
        });

    // Charger les catégories
    const categoriesContainer = document.getElementById('categories-container');
    const loader = document.getElementById('loader');

    // Afficher l'indicateur de chargement
    loader.style.display = 'flex';

    fetch('http://localhost/app-sport/src/php/api/get_categories.php')
        .then(response => response.json())
        .then(data => {
            // Masquer l'indicateur de chargement
            loader.style.display = 'none';

            data.forEach(category => {
                const categoryDiv = document.createElement('div');
                categoryDiv.className = 'col-md-4 mb-4';
                categoryDiv.innerHTML = `
                    <div class="card">
                        ${category.image ? `<img src="${category.image}" class="card-img-top" alt="${category.nom}">` : ''}
                        <div class="card-body">
                            <h5 class="card-title">${category.nom}</h5>
                            <p class="card-text">${category.description}</p>
                            <a href="/app-sport/products?category_id=${category.id}" class="btn btn-primary">Voir la Catégorie</a>
                        </div>
                    </div>
                `;
                categoriesContainer.appendChild(categoryDiv);
            });
        })
        .catch(error => {
            console.error('Error:', error);
            // Masquer l'indicateur de chargement en cas d'erreur
            loader.style.display = 'none';
            categoriesContainer.innerHTML = '<p class="text-center">Une erreur est survenue lors du chargement des catégories.</p>';
        });
});

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

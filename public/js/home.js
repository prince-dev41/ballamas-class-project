// home.js

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

    // Charger les catégories dynamiquement
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
                            <a href="/app-sport/produits?category_id=${category.id}" class="btn btn-primary">Voir la Catégorie</a>
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

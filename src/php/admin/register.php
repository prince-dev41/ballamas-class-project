<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Utilisateur</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: "Fredoka";
            background-color: #F8F9FA;
        }
        .form-container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2 class="text-center mb-4 ">Bienvenue sur Ballamas !</h2>
        <p class="text-center mb-4">Avant de commencer. Créeons votre compte.</p>
        <form id="createUserForm">
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="first_name" class="form-label">Prénom:</label>
                <input type="text" class="form-control" id="first_name" name="first_name" required>
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Nom:</label>
                <input type="text" class="form-control" id="last_name" name="last_name" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Créer</button>
        </form>
        <div id="message" class="mt-3 text-center text-danger"></div>
    </div>

    <script>
        document.getElementById('createUserForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);
            const data = {
                email: formData.get('email'),
                password: formData.get('password'),
                first_name: formData.get('first_name'),
                last_name: formData.get('last_name'),
            };

            fetch('http://localhost/app-sport/src/php/api/create_admin.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('message').innerText = data.message;
                if (data.success) {
                    // Rediriger vers la page de connexion après la création du compte
                    window.location.href = 'login';
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
            });
        });
    </script>
</body>
</html>

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
    <title>Tableau de Bord</title>
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
        .dashboard-container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
        }
    </style>
</head>
<body>
    <div id="dashboard" class="dashboard-container">
        <h2 id="welcomeMessage" class="text-center mb-4">Bienvenue sur votre Tableau de Bord, <?php echo $_SESSION['user_id']; ?>!</h2>
        <p class="text-center mb-4">Gérez vos produits et vos commandes ici.</p>
        <a href="logout" class="btn btn-danger w-100">Déconnexion</a>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var userId = <?php echo json_encode($_SESSION['user_id']); ?>;
            fetch('http://localhost/app-sport/src/php/api/get_user.php')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('welcomeMessage').innerText = 'Bienvenue sur votre Tableau de Bord, ' + data.user.username + '!';
                    console.log(data)
                } else {
                    console.error('Erreur:', data.message);
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
            });
        });
    </script>
</body>
</html>

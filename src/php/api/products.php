<?php
header('Content-Type: application/json');

// Connexion à la base de données
$host = 'localhost'; // Adresse du serveur MySQL
$dbname = 'app-vente'; // Nom de la base de données
$username = 'root'; // Nom d'utilisateur MySQL
$password = ''; // Mot de passe MySQL

try {
    // Connexion à la base de données avec PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête pour récupérer tous les produits avec le nom de la catégorie
    $query = "
        SELECT p.id, p.stock, p.nom, p.prix, p.description, p.image, c.nom AS categorie_nom
        FROM produits p
        JOIN categorie c ON p.categories_id = c.id
    ";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    // Récupérer les résultats sous forme de tableau associatif
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Convertir les images BLOB en base64 avec leur type MIME
    foreach ($products as &$product) {
        if (!empty($product['image'])) {
            // Détecter le type MIME de l'image
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mimeType = $finfo->buffer($product['image']);

            // Encoder l'image en base64 et ajouter le type MIME
            $product['image'] = 'data:' . $mimeType . ';base64,' . base64_encode($product['image']);
        }
    }

    // Renvoyer les produits au format JSON
    echo json_encode($products);
} catch (PDOException $e) {
    // En cas d'erreur, renvoyer un message d'erreur
    http_response_code(500);
    echo json_encode(['error' => 'Erreur de connexion à la base de données : ' . $e->getMessage()]);
}
?>

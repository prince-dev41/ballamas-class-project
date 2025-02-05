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

    // Vérifier si l'ID de la catégorie est passé en paramètre
    if (!isset($_GET['id'])) {
        http_response_code(400);
        echo json_encode(['error' => 'ID de la catégorie manquant']);
        exit;
    }

    $categoryId = $_GET['id'];

    // Requête pour récupérer les produits de la catégorie spécifiée
    $query = "SELECT p.*, c.nom AS categorie_nom FROM produits p JOIN categorie c ON p.categories_id = c.id WHERE p.categories_id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $categoryId, PDO::PARAM_INT);
    $stmt->execute();

    // Récupérer les produits sous forme de tableau associatif
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$products) {
        http_response_code(404);
        echo json_encode(['error' => 'Aucun produit trouvé pour cette catégorie']);
        exit;
    }

    // Convertir les images BLOB en base64 avec leur type MIME
    foreach ($products as &$product) {
        if (!empty($product['image'])) {
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mimeType = $finfo->buffer($product['image']);
            $product['image'] = 'data:' . $mimeType . ';base64,' . base64_encode($product['image']);
        }
    }

    // Renvoi des produits au format JSON
    echo json_encode($products, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
} catch (PDOException $e) {
    // En cas d'erreur, renvoyer un message d'erreur
    http_response_code(500);
    echo json_encode(['error' => 'Erreur de connexion à la base de données : ' . $e->getMessage()]);
}
?>

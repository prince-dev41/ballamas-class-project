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

    // Vérifier si l'ID du produit est passé en paramètre
    if (!isset($_GET['id'])) {
        http_response_code(400);
        echo json_encode(['error' => 'ID du produit manquant']);
        exit;
    }

    $productId = $_GET['id'];

    // Requête pour récupérer les détails du produit
    $query = "SELECT * FROM produits WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $productId, PDO::PARAM_INT);
    $stmt->execute();

    // Récupérer le produit sous forme de tableau associatif
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        http_response_code(404);
        echo json_encode(['error' => 'Produit non trouvé']);
        exit;
    }

    // Convertir l'image BLOB en base64 avec son type MIME
    if (!empty($product['image'])) {
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->buffer($product['image']);
        $product['image'] = 'data:' . $mimeType . ';base64,' . base64_encode($product['image']);
    }

    // Récupérer 3 produits aléatoires (sauf le produit actuel)
    $queryRandom = "SELECT * FROM produits WHERE id != :id ORDER BY RAND() LIMIT 3";
    $stmtRandom = $pdo->prepare($queryRandom);
    $stmtRandom->bindParam(':id', $productId, PDO::PARAM_INT);
    $stmtRandom->execute();

    $randomProducts = $stmtRandom->fetchAll(PDO::FETCH_ASSOC);

    // Convertir les images BLOB en base64 avec leur type MIME
    foreach ($randomProducts as &$randomProduct) {
        if (!empty($randomProduct['image'])) {
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mimeType = $finfo->buffer($randomProduct['image']);
            $randomProduct['image'] = 'data:' . $mimeType . ';base64,' . base64_encode($randomProduct['image']);
        }
    }

    // Renvoyer les détails du produit et les produits aléatoires au format JSON
    echo json_encode([
        'product' => $product,
        'randomProducts' => $randomProducts
    ]);
} catch (PDOException $e) {
    // En cas d'erreur, renvoyer un message d'erreur
    http_response_code(500);
    echo json_encode(['error' => 'Erreur de connexion à la base de données : ' . $e->getMessage()]);
}
?>
<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

include '../includes/db.php'; // Assurez-vous d'inclure votre fichier de connexion à la base de données

// Calculer le total des ventes pour toutes les catégories
$totalSalesQuery = "
    SELECT
        SUM(p.prix * pc.quantite) AS total_sales
    FROM
        commandes o
    JOIN
        produits_commandes pc ON o.id = pc.commande_id
    JOIN
        produits p ON pc.produit_id = p.id
";

$totalSalesResult = $conn->query($totalSalesQuery);
$totalSales = $totalSalesResult->fetch_assoc()['total_sales'];

// Obtenir les ventes par catégorie
$query = "
    SELECT
        c.nom AS categorie_nom,
        SUM(p.prix * pc.quantite) AS total_ventes
    FROM
        commandes o
    JOIN
        produits_commandes pc ON o.id = pc.commande_id
    JOIN
        produits p ON pc.produit_id = p.id
    JOIN
        categorie c ON p.categories_id = c.id
    GROUP BY
        c.nom
    ORDER BY
        total_ventes DESC
";

$result = $conn->query($query);

$salesByCategory = [];
while ($row = $result->fetch_assoc()) {
    $row['percent'] = round(($totalSales > 0) ? (($row['total_ventes'] / $totalSales) * 100) : 0);
    $salesByCategory[] = $row;
}

echo json_encode($salesByCategory);
?>

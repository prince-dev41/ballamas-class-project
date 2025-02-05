<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

include '../includes/db.php'; // Assurez-vous d'inclure votre fichier de connexion à la base de données

// Calculer les ventes totales pour chaque mois de l'année
$query = "
    SELECT
        MONTH(o.date_commande) AS month,
        SUM(p.prix * pc.quantite) AS total_sales
    FROM
        commandes o
    JOIN
        produits_commandes pc ON o.id = pc.commande_id
    JOIN
        produits p ON pc.produit_id = p.id
    WHERE
        YEAR(o.date_commande) = YEAR(CURDATE())
    GROUP BY
        MONTH(o.date_commande)
    ORDER BY
        MONTH(o.date_commande)
";

$result = $conn->query($query);

$salesByMonth = [];
$monthNames = ["JAN", "FEV", "MAR", "AVR", "MAI", "JUIN", "JUIL", "AOUT", "SEPT", "OCT", "NOV", "DEC"];

// Initialiser le tableau avec tous les mois et leurs ventes à zéro
for ($i = 1; $i <= 12; $i++) {
    $salesByMonth[$i] = [
        'month' => $monthNames[$i - 1],
        'total_sales' => 0
    ];
}

// Mettre à jour le tableau avec les données réelles
while ($row = $result->fetch_assoc()) {
    $monthIndex = $row['month'];
    $salesByMonth[$monthIndex]['total_sales'] = $row['total_sales'];
}

// Convertir le tableau associatif en tableau indexé pour le JSON
$salesByMonth = array_values($salesByMonth);

echo json_encode($salesByMonth);
?>

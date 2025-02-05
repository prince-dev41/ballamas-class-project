<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

include '../includes/db.php'; // Assurez-vous d'inclure votre fichier de connexion à la base de données

$query = "
    SELECT
        o.id,
        o.client_id,
        c.nom AS client_nom,
        c.prenom AS client_prenom,
        c.adresse AS adresse_livraison,
        o.total,
        o.date_commande,
        o.statut,
        GROUP_CONCAT(CONCAT(p.nom, ' (', pc.quantite, ')') SEPARATOR ', ') AS produits
    FROM
        commandes o
    JOIN
        clients c ON o.client_id = c.id
    LEFT JOIN
        produits_commandes pc ON o.id = pc.commande_id
    LEFT JOIN
        produits p ON pc.produit_id = p.id
    GROUP BY
        o.id
    ORDER BY
        o.date_commande DESC
";

$result = $conn->query($query);

$orders = [];
while ($row = $result->fetch_assoc()) {
    $orders[] = $row;
}

echo json_encode($orders);
?>

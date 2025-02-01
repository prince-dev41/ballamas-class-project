```mermaid
graph TD;
    A[Début] --> B[Connexion Admin];
    B --> C[Gestion des Produits];
    C --> D[Ajouter Produit];
    C --> E[Modifier Produit];
    C --> F[Supprimer Produit];
    D --> G[Fin];
    E --> G;
    F --> G;

```
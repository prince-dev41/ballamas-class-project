```mermaid
sequenceDiagram
    participant Client
    participant Serveur
    Client->>Serveur: Requête de connexion
    Serveur-->>Client: Réponse de connexion
    Client->>Serveur: Requête de produits
    Serveur-->>Client: Liste des produits
    Client->>Serveur: Ajouter au panier
    Serveur-->>Client: Confirmation d'ajout

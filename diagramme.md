```mermaid
classDiagram
    class Admin {
        +int id
        +String nom
        +String email
        +String motDePasse
        +gererProduits()
        +gererCommandes()
    }

    class Newsletter {
        +int id
        +String email
        +Date dateInscription
    }

    class Commande {
        +int id
        +Date dateCommande
        +double total
        +List<Produit> produits
        +Client client
        +ajouterProduit(Produit produit)
        +calculerTotal()
    }

    class Produit {
        +int id
        +String nom
        +double prix
        +String description
        +Categorie categorie
        +ajouterAuPanier()
    }

    class Categorie {
        +int id
        +String nom
        +String description
        +List<Produit> produits
    }

    class Client {
        +int id
        +String nom
        +String email
        +String motDePasse
        +List<Commande> commandes
        +passerCommande(Commande commande)
    }

    class Panier {
        +int id
        +List<Produit> produits
        +double total
        +ajouterProduit(Produit produit)
        +calculerTotal()
    }

    Admin "1" -- "0..*" Produit : gère
    Admin "1" -- "0..*" Commande : gère
    Client "1" -- "0..*" Commande : passe
    Commande "1" -- "0..*" Produit : contient
    Produit "1" -- "1" Categorie : appartient à
    Newsletter "1" -- "1" Client : abonné
    Produit "1" -- "0..*" Panier : contient

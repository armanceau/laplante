
# 🌱 LaPlante

Bienvenue sur LaPlante - Styliser votre espace avec de l'air frais  ! 🚀

## Description
LaPlante est une application web développée en Symfony 6 qui vous permet de voyager dans un espace plus zen en achetant vos nouvelles plantes intérieures en un clin d'œil !

## Fonctionnalités
- **Admin** : 

    🌱 Produits :
    - 📇 Ajoutez des produits avec facilité
    - ✏️ Modifiez un produit
    - ❌ Supprimez des produits
    - 🔍 Consultez les détails complets de chaque produit

    🧑‍💻 Utilisateurs :
    - 📇 Ajoutez des utilisateurs avec facilité
    - ✏️ Modifiez un utilisateur
    - ❌ Supprimez des utilisateurs
    - 🔍 Consultez les détails complets de chaque utilisateur

- **Utilisateur** : 

    - 🔐 Inscription et connexion sécurisée
    - ✏️ Modifier son profil
    - 🛒 Ajouter des produits à son panier
    - 🔍 Consultez les détails complets de chaque produit

    🧑‍💻 Utilisateurs :
    - 📇 Ajoutez des utilisateurs avec facilité
    - ✏️ Modifiez un utilisateur
    - ❌ Supprimez des utilisateurs
    - 🔍 Consultez les détails complets de chaque utilisateur


## 🛠️ Prérequis

### 💻 Technologies
- Symfony 6.0
- Php 8.0
- WampServer
- Mailtrap

## 🧑‍💻 Installations

1. Se rendre dans le projet :

    ```bash
    cd laplante
    ```
2. Créer la base de données :

    ```bash
    php bin/console doctrine:database:create
    ```
3. Réaliser la migration des données :

    ```bash
    php bin/console make:migration
    ```

    ```bash
    php bin/console doctrine:migrations:migrate
    ```

## 🚀 Lancer le projet 

```bash
symfony serve
```

## Documentation

- [Symfony](https://symfony.com/)
- [Mailtrap](https://mailtrap.io/)
- [WampServer](https://www.wampserver.com/)


## Authors

- [@armanceau](https://www.github.com/armanceau)
- [![linkedin](https://img.shields.io/badge/linkedin-0A66C2?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/arthur-manceau/)


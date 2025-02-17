<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boutique E-commerce</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Navigation bar -->
    <nav class="navbar" id="navbar">
        <div class="brand">y-commerce.</div>
        <div class="search-bar">
            <input type="text" class="search-input" placeholder="Rechercher un produit...">
            <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
        </div>
    </nav>
    
    <!-- Main content -->
    <div class="main-content">
        <!-- Filters section -->
        <!-- <div class="filters">
            <h2 class="filter-title">Filtres</h2>
            
            <div class="filter-group">
                <h3 class="filter-group-title">Catégories</h3>
                <div class="filter-option">
                    <input type="checkbox" id="category1" class="filter-checkbox">
                    <label for="category1">Vêtements</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="category2" class="filter-checkbox">
                    <label for="category2">Électronique</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="category3" class="filter-checkbox">
                    <label for="category3">Maison</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="category4" class="filter-checkbox">
                    <label for="category4">Beauté</label>
                </div>
            </div>
            
            <div class="filter-group">
                <h3 class="filter-group-title">Prix</h3>
                <div class="filter-option">
                    <input type="checkbox" id="price1" class="filter-checkbox">
                    <label for="price1">Moins de 20€</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="price2" class="filter-checkbox">
                    <label for="price2">20€ - 50€</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="price3" class="filter-checkbox">
                    <label for="price3">50€ - 100€</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="price4" class="filter-checkbox">
                    <label for="price4">Plus de 100€</label>
                </div>
            </div>
            
            <div class="filter-group">
                <h3 class="filter-group-title">Évaluation</h3>
                <div class="filter-option">
                    <input type="checkbox" id="rating1" class="filter-checkbox">
                    <label for="rating1">4 étoiles et plus</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="rating2" class="filter-checkbox">
                    <label for="rating2">3 étoiles et plus</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="rating3" class="filter-checkbox">
                    <label for="rating3">2 étoiles et plus</label>
                </div>
            </div>
        </div> -->
        
        <!-- Products section -->
        <div class="products">
            <!-- Product card 1 -->
            <div class="product-card">
                <img src="images/test_image.jpg" alt="Produit 1" class="product-image">
                <div class="product-info">
                    <h3 class="product-name">Chemise blanche élégante</h3>
                    <p class="product-price">39.99€</p>
                    <button class="add-to-cart">Ajouter au panier</button>
                </div>
            </div>
            
            <!-- Product card 2 -->
            <div class="product-card">
                <img src="images/test_image.jpg" alt="Produit 2" class="product-image">
                <div class="product-info">
                    <h3 class="product-name">Écouteurs sans fil premium</h3>
                    <p class="product-price">129.99€</p>
                    <button class="add-to-cart">Ajouter au panier</button>
                </div>
            </div>
            
            <!-- Product card 3 -->
            <div class="product-card">
                <img src="images/test_image.jpg" alt="Produit 3" class="product-image">
                <div class="product-info">
                    <h3 class="product-name">Lampe de bureau design</h3>
                    <p class="product-price">59.99€</p>
                    <button class="add-to-cart">Ajouter au panier</button>
                </div>
            </div>
            
            <!-- Product card 4 -->
            <div class="product-card">
                <img src="images/test_image.jpg" alt="Produit 4" class="product-image">
                <div class="product-info">
                    <h3 class="product-name">Crème hydratante visage</h3>
                    <p class="product-price">24.99€</p>
                    <button class="add-to-cart">Ajouter au panier</button>
                </div>
            </div>
            
            <!-- Product card 5 -->
            <div class="product-card">
                <img src="images/test_image.jpg" alt="Produit 5" class="product-image">
                <div class="product-info">
                    <h3 class="product-name">Jean slim coupe moderne</h3>
                    <p class="product-price">49.99€</p>
                    <button class="add-to-cart">Ajouter au panier</button>
                </div>
            </div>
            
            <!-- Product card 6 -->
            <div class="product-card">
                <img src="images/test_image.jpg" alt="Produit 6" class="product-image">
                <div class="product-info">
                    <h3 class="product-name">Montre connectée sport</h3>
                    <p class="product-price">89.99€</p>
                    <button class="add-to-cart">Ajouter au panier</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
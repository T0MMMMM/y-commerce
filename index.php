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
    <?php include "includes/navbar.php"; ?>
    
    <!-- Main content -->
    <div class="main-content">
        <!-- Filters section -->
        
        <!-- Products section -->
        <div class="products">
            <!-- Product card 1 -->
            <div class="product-card">
                <img src="images/test_image.jpg" alt="Produit 1" class="product-image">
                <div class="product-info">
                    <div>
                        <h3 class="product-name">Chemise blanche élégante</h3>
                        <p class="product-price">39.99€</p>
                    </div>
                    
                    <button class="add-to-cart">Ajouter au panier</button>
                </div>
            </div>
            
            <!-- Product card 2 -->
            <div class="product-card">
                <img src="images/test_image.jpg" alt="Produit 2" class="product-image">
                <div class="product-info">
                    <div>
                        <h3 class="product-name">Écouteurs sans fil premium</h3>
                        <p class="product-price">129.99€</p>
                    </div>
                    
                    <button class="add-to-cart">Ajouter au panier</button>
                </div>
            </div>
            
            <!-- Product card 3 -->
            <div class="product-card">
                <img src="images/test_image.jpg" alt="Produit 3" class="product-image">
                <div class="product-info">
                    <div>
                        <h3 class="product-name">Lampe de bureau design</h3>
                        <p class="product-price">59.99€</p>
                    </div>
                    
                    <button class="add-to-cart">Ajouter au panier</button>
                </div>
            </div>
            
            <!-- Product card 4 -->
            <div class="product-card">
                <img src="images/test_image.jpg" alt="Produit 4" class="product-image">
                <div class="product-info">
                    <div>
                        <h3 class="product-name">Crème hydratante visage</h3>
                        <p class="product-price">24.99€</p>
                    </div>
                    
                    <button class="add-to-cart">Ajouter au panier</button>
                </div>
            </div>
            
            <!-- Product card 5 -->
            <div class="product-card">
                <img src="images/test_image.jpg" alt="Produit 5" class="product-image">
                <div class="product-info">
                    <div>
                        <h3 class="product-name">Jean slim coupe moderne</h3>
                        <p class="product-price">49.99€</p>
                    </div>
                    
                    <button class="add-to-cart">Ajouter au panier</button>
                </div>
            </div>
            
            <!-- Product card 6 -->
            <div class="product-card">
                <img src="images/test_image.jpg" alt="Produit 6" class="product-image">
                <div class="product-info">
                    <div>
                        <h3 class="product-name">Montre connectée sport</h3>
                        <p class="product-price">89.99€</p>
                    </div>
                    
                    <button class="add-to-cart">Ajouter au panier</button>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
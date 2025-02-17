<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier - y-commerce</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Navigation bar -->
    <?php include 'includes/navbar.php'; ?>
    
    <!-- Main content -->
    <div class="cart-container">
        <div class="cart-header">
            <h1 class="cart-title">Votre Panier</h1>
            <span class="cart-count">4 articles</span>
        </div>
        
        <div class="cart-content">
            <div class="cart-items">
                <!-- Cart item 1 -->
                <div class="cart-item">
                    <div class="cart-item-image">
                        <img src="images/test_image.jpg" alt="Chemise blanche élégante">
                    </div>
                    <div class="cart-item-details">
                        <h3 class="cart-item-name">Chemise blanche élégante</h3>
                        <p class="cart-item-price">39.99€</p>
                        <div class="cart-item-quantity">
                            <button class="quantity-btn minus">-</button>
                            <input type="text" value="1" min="1" class="quantity-input" disabled>
                            <button class="quantity-btn plus">+</button>
                        </div>
                    </div>
                    <div class="cart-item-subtotal">
                        <p>39.99€</p>
                    </div>
                    <button class="remove-item">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
                
                <!-- Cart item 2 -->
                <div class="cart-item">
                    <div class="cart-item-image">
                        <img src="images/test_image.jpg" alt="Écouteurs sans fil premium">
                    </div>
                    <div class="cart-item-details">
                        <h3 class="cart-item-name">Écouteurs sans fil premium</h3>
                        <p class="cart-item-price">129.99€</p>
                        <div class="cart-item-quantity">
                            <button class="quantity-btn minus">-</button>
                            <input type="text" value="1" min="1" class="quantity-input" disabled>
                            <button class="quantity-btn plus">+</button>
                        </div>
                    </div>
                    <div class="cart-item-subtotal">
                        <p>129.99€</p>
                    </div>
                    <button class="remove-item">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
                
                <!-- Cart item 3 -->
                <div class="cart-item">
                    <div class="cart-item-image">
                        <img src="images/test_image.jpg" alt="Lampe de bureau design">
                    </div>
                    <div class="cart-item-details">
                        <h3 class="cart-item-name">Lampe de bureau design</h3>
                        <p class="cart-item-price">59.99€</p>
                        <div class="cart-item-quantity">
                            <button class="quantity-btn minus">-</button>
                            <input type="text" value="1" min="1" class="quantity-input" disabled>
                            <button class="quantity-btn plus">+</button>
                        </div>
                    </div>
                    <div class="cart-item-subtotal">
                        <p>119.98€</p>
                    </div>
                    <button class="remove-item">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
                
                <!-- Cart item 4 -->
                <div class="cart-item">
                    <div class="cart-item-image">
                        <img src="images/test_image.jpg" alt="Crème hydratante visage">
                    </div>
                    <div class="cart-item-details">
                        <h3 class="cart-item-name">Crème hydratante visage</h3>
                        <p class="cart-item-price">24.99€</p>
                        <div class="cart-item-quantity">
                            <button class="quantity-btn minus">-</button>
                            <input type="text" value="1" min="1" class="quantity-input" disabled>
                            <button class="quantity-btn plus">+</button>
                        </div>
                    </div>
                    <div class="cart-item-subtotal">
                        <p>24.99€</p>
                    </div>
                    <button class="remove-item">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            </div>
            
            <!-- Order summary -->
            <div class="order-summary">
                <h2 class="summary-title">Récapitulatif</h2>
                
                <div class="summary-row">
                    <span>Sous-total</span>
                    <span>314.95€</span>
                </div>
                
                <div class="summary-row">
                    <span>Frais de livraison</span>
                    <span>Gratuit</span>
                </div>
                
                <div class="summary-row total">
                    <span>Total</span>
                    <span>314.95€</span>
                </div>
                
                <div class="promo-code">
                    <input type="text" placeholder="Code promo">
                    <button class="apply-code">Appliquer</button>
                </div>
                
                <button class="checkout-btn">Passer votre commande</button>
                
                <!-- <div class="secure-payment">
                    <i class="fas fa-lock"></i>
                    <span>Paiement sécurisé</span>
                </div> -->
                
                <div class="continue-shopping">
                    <a href="index.php">
                        <i class="fas fa-arrow-left"></i>
                        &nbsp;Continuer vos achats
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>
    
    <!-- Font Awesome pour les icônes -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    
    <script>
        // Quantity buttons functionality
        document.querySelectorAll('.quantity-btn').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.parentNode.querySelector('.quantity-input');
                const currentValue = parseInt(input.value);
                
                if (this.classList.contains('plus')) {
                    input.value = currentValue + 1;
                } else if (this.classList.contains('minus') && currentValue > 1) {
                    input.value = currentValue - 1;
                }
                
                // Here you would update the subtotal and total
                // This is a placeholder for actual implementation
            });
        });
        
        // Remove item functionality
        document.querySelectorAll('.remove-item').forEach(button => {
            button.addEventListener('click', function() {
                this.closest('.cart-item').remove();
                // Here you would update the cart count and totals
            });
        });
    </script>
</body>
</html>
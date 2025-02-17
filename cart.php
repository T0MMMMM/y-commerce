<?php session_start(); ?>
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

                <?php

                    require_once 'api/cart.php';

                    $cart = getCart();

                    $total = 0;

                    foreach ($cart as $article):
                        $total += $article['Price']*$_SESSION["cart"][$article["Id"]]["quantity"];
                ?>
                <!-- Cart item 1 -->
                <div class="cart-item">
                    <div class="cart-item-image">
                        <img src="images/test_image.jpg" alt="Chemise blanche élégante">
                    </div>
                    <div class="cart-item-details">
                        <h3 class="cart-item-name"><?= $article["Name"] ?></h3>
                        <p class="cart-item-price"><?= $article["Price"] ?> €</p>
                        <div class="cart-item-quantity">
                            <form method="post" action="api/cart.php">
                                <input type="hidden" name="path" value="/cart.php" ?>
                                <?= '<input type="hidden" name="quantity" value="' . htmlspecialchars($_SESSION["cart"][$article["Id"]]["quantity"]-1) . '">' ?>
                                <?= '<input type="hidden" name="product_id" value="' . htmlspecialchars($article['Id']) . '">' ?>
                                <button class="quantity-btn minus" name="action" value="update_cart">-</button>
                            </form>
                            <?= '<input type="text" value="' . $_SESSION["cart"][$article["Id"]]["quantity"] . '" min="1" class="quantity-input" disabled>' ?>
                            <form method="post" action="api/cart.php">
                                <input type="hidden" name="path" value="/cart.php" ?>
                                <?= '<input type="hidden" name="product_id" value="' . htmlspecialchars($article['Id']) . '">' ?>
                                <button class="quantity-btn plus" name="action" value="add_to_cart">+</button>
                            </form>
                        </div>
                    </div>
                    <div class="cart-item-subtotal">
                        <p><?= $article["Price"]*$_SESSION["cart"][$article["Id"]]["quantity"] ?> €</p>
                    </div>
                    <form method="post" action="api/cart.php">
                        <input type="hidden" name="path" value="/cart.php" ?>
                        <?= '<input type="hidden" name="product_id" value="' . htmlspecialchars($article['Id']) . '">' ?>
                        <button class="remove-item" name="action" value="remove_from_cart"><i class="fas fa-trash-alt"></i></button>
                    </form>
                    
                </div>

                <?php endforeach; ?>

            </div>
            <!-- Order summary -->
            <div class="order-summary">
                <h2 class="summary-title">Récapitulatif</h2>
                
                <div class="summary-row">
                    <span>Sous-total</span>
                    <span><?= $total ?> €</span>
                </div>
                
                <div class="summary-row">
                    <span>Frais de livraison</span>
                    <span>Gratuit</span>
                </div>
                
                <div class="summary-row total">
                    <span>Total</span>
                    <span><?= $total ?> €</span>
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
        // document.querySelectorAll('.quantity-btn').forEach(button => {
        //     button.addEventListener('click', function() {
        //         const input = this.parentNode.querySelector('.quantity-input');
        //         const currentValue = parseInt(input.value);
                
        //         if (this.classList.contains('plus')) {
        //             input.value = currentValue + 1;
        //         } else if (this.classList.contains('minus') && currentValue > 1) {
        //             input.value = currentValue - 1;
        //         }
                
        //         // Here you would update the subtotal and total
        //         // This is a placeholder for actual implementation
        //     });
        // });
        
    </script>
</body>
</html>
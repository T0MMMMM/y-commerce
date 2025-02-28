<?php
session_start();
require_once 'includes/auth_check.php';
require_once "api/crud/crud_article.php";
require_once "api/crud/crud_command.php";
require_once "api/crud/crud_user.php";
require_once 'api/utils/cart_utils.php';
?>
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
            <span class="cart-count"><?= count($_SESSION["cart"] ?? []) ?> articles</span>
        </div>
        
        <div class="cart-content">
                <?php

                    $cart = getCart();

                    $total = 0;

                    if (empty($cart)) {
                        echo '<div class="cart-items" style="display: contents;">';
                        echo '<p style="display: flex; justify-content: center; align-items: center;">Votre panier est vide.</p>';
                    } else {

                    echo '<div class="cart-items">';

                    foreach ($cart as $article):
                        $total += $article['price']*$_SESSION["cart"][$article["id"]]["quantity"];
                ?>
                <!-- Cart item 1 -->
                <div class="cart-item">
                    <div class="cart-item-image">
                        <img src="<?= htmlspecialchars($article['image_link']) ?>" alt="Chemise blanche élégante">
                    </div>
                    <div class="cart-item-details">
                        <h3 class="cart-item-name"><?= $article["name"] ?></h3>
                        <p class="cart-item-price"><?= $article["price"] ?> €</p>
                        <div class="cart-item-quantity">
                            <button class="quantity-btn-cart minus" onclick="updateCart(<?= htmlspecialchars($article['id']) ?>, -1)">-</button>
                            <input type="text" value="<?= $_SESSION["cart"][$article["id"]]["quantity"] ?>" min="1" class="quantity-input" disabled>
                            <button class="quantity-btn-cart plus" onclick="updateCart(<?= htmlspecialchars($article['id']) ?>, 1)">+</button>
                        </div>
                    </div>
                    <div class="cart-item-subtotal">
                        <p><?= $article["price"]*$_SESSION["cart"][$article["id"]]["quantity"] ?> €</p>
                    </div>
                    <button class="remove-item" onclick="removeFromCart(<?= htmlspecialchars($article['id']) ?>)"><i class="fas fa-trash-alt"></i></button>
                    
                </div>

                <?php endforeach; } ?>

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
                
                <button class="checkout-btn" onclick="window.location.href='confirm_command.php'">Passez votre commande</button>
                
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
    <script src="javascript/cart_actions.js"></script>
</body>
</html>
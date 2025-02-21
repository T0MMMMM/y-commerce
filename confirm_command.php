<?php
session_start();
require_once 'includes/auth_check.php';
require_once "api/crud/crud_article.php";
require_once "api/crud/crud_command.php";
require_once "api/crud/crud_user.php";
require_once 'api/utils/cart_utils.php';

// Récupérer les articles du panier
$cart = getCart();
$total = 0;
foreach ($cart as $article) {
    $total += $article['price'] * $_SESSION["cart"][$article["id"]]["quantity"];
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finaliser votre commande - y-commerce</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/confirmation.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <!-- Navigation bar -->
    <?php include 'includes/navbar.php'; ?>
    
    <!-- Main content -->
    <div class="confirmation-container">
        <h1 class="confirmation-title">Finaliser votre commande</h1>
        
        <div class="confirmation-content">
            <!-- Delivery Address Section -->
            <div class="address-section">
                <h2><i class="fas fa-map-marker-alt"></i> Adresse de livraison</h2>
                
                <form method="post" action="process_order.php" class="address-form">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="firstname">Prénom</label>
                            <input type="text" id="firstname" name="firstname" required>
                        </div>
                        <div class="form-group">
                            <label for="lastname">Nom</label>
                            <input type="text" id="lastname" name="lastname" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="street">Adresse</label>
                        <input type="text" id="street" name="street" required>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="postal_code">Code postal</label>
                            <input type="text" id="postal_code" name="postal_code" required>
                        </div>
                        <div class="form-group">
                            <label for="city">Ville</label>
                            <input type="text" id="city" name="city" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="country">Pays</label>
                        <select id="country" name="country" required>
                            <option value="France">France</option>
                            <option value="Belgique">Belgique</option>
                            <option value="Suisse">Suisse</option>
                            <option value="Luxembourg">Luxembourg</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Téléphone</label>
                        <input type="tel" id="phone" name="phone" required>
                    </div>
                    
                    <div class="form-group checkbox-group">
                        <input type="checkbox" id="save_address" name="save_address">
                        <label for="save_address">Sauvegarder cette adresse</label>
                    </div>
                </form>
            </div>
            
            <!-- Order Summary Section -->
            <div class="order-summary">
                <h2>Récapitulatif de commande</h2>
                
                <div class="summary-items">
                    <?php foreach ($cart as $article): ?>
                    <div class="summary-item">
                        <div class="item-info">
                            <span class="item-name"><?= htmlspecialchars($article['name']) ?></span>
                            <span class="item-quantity">Qté: <?= $_SESSION["cart"][$article["id"]]["quantity"] ?></span>
                        </div>
                        <span class="item-price"><?= number_format($article['price'] * $_SESSION["cart"][$article["id"]]["quantity"], 2) ?> €</span>
                    </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="summary-total">
                    <div class="total-row">
                        <span>Sous-total</span>
                        <span><?= number_format($total, 2) ?> €</span>
                    </div>
                    <div class="total-row">
                        <span>Livraison</span>
                        <span>Gratuit</span>
                    </div>
                    <div class="total-row final-total">
                        <span>Total</span>
                        <span><?= number_format($total, 2) ?> €</span>
                    </div>
                </div>

                <form action="api/actions/command_actions.php" method="post" class="confirm-button" onclick="this.submit()">
                        <input type="hidden" name="id" value="<?= $order['id'] ?>">
                        <i class="fas fa-edit"></i> Confirmer la commande
                </form>
                                
                <a href="cart.php" class="back-link">
                    <i class="fas fa-arrow-left"></i> Retour au panier
                </a>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>
</body>
</html>
<?php
session_start();
require_once 'includes/auth_check.php';
require_once "api/crud/crud_article.php";
require_once "api/crud/crud_command.php";
require_once "api/crud/crud_user.php";
require_once 'api/utils/cart_utils.php';

$cart = getCart();
$total = 0;
$user = getUserById($_SESSION['user']);

// Rediriger si panier vide
if (empty($cart)) {
    header('Location: cart.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de commande - y-commerce</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <div class="confirm-container">
        <div class="confirm-content">
            <div class="shipping-details">
                <h2>Adresse de livraison</h2>
                <form id="shipping-form" class="shipping-form">
                    <div class="form-group">
                        <input type="text" id="address" name="address" placeholder="Adresse" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <input type="text" id="city" name="city" placeholder="Ville" required>
                        </div>
                        <div class="form-group">
                            <input type="text" id="postal_code" name="postal_code" placeholder="Code postal" required pattern="[0-9]{5}">
                        </div>
                    </div>
                </form>
            </div>

            <div class="order-review">
                <h2>Récapitulatif de la commande</h2>
                <div class="order-items">
                    <?php foreach ($cart as $article): 
                        $total += $article['price'] * $_SESSION["cart"][$article["id"]]["quantity"];
                    ?>
                    <div class="order-item">
                        <img src="<?= htmlspecialchars($article['image_link']) ?>" alt="<?= htmlspecialchars($article['name']) ?>">
                        <div class="item-details">
                            <h3><?= htmlspecialchars($article['name']) ?></h3>
                            <p>Quantité: <?= $_SESSION["cart"][$article["id"]]["quantity"] ?></p>
                            <p>Prix unitaire: <?= htmlspecialchars($article['price']) ?> €</p>
                            <p>Sous-total: <?= $article['price'] * $_SESSION["cart"][$article["id"]]["quantity"] ?> €</p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="order-summary">
                    <div class="summary-row">
                        <span>Sous-total:</span>
                        <span><?= $total ?> €</span>
                    </div>
                    <div class="summary-row">
                        <span>Livraison:</span>
                        <span>Gratuit</span>
                    </div>
                    <div class="summary-row total">
                        <span>Total:</span>
                        <span><?= $total ?> €</span>
                    </div>
                    <div class="summary-row balance">
                        <span>Votre solde:</span>
                        <span><?= $user['balance'] ?> €</span>
                    </div>
                </div>

                <button class="confirm-btn" onclick="createCommand()">
                    Confirmer la commande
                </button>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
    <script src="javascript/actions.js"></script>
</body>
</html>
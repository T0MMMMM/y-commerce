<?php
session_start();
require_once 'api/crud.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$article = getArticleById($_GET['id']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($article['Name']) ?> - y-commerce</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Navigation bar -->
    <?php include 'includes/navbar.php'; ?>
    
    <!-- Main content -->
    <div class="main-content">
        <div class="product-card">
            <img src="images/test_image.jpg" alt="<?= htmlspecialchars($article['Name']) ?>" class="product-image">
            <div class="product-info">
                <h3 class="product-name"><?= htmlspecialchars($article['Name']) ?></h3>
                <p class="product-price"><?= htmlspecialchars($article['Price']) ?> €</p>
                <p class="product-description"><?= htmlspecialchars($article['Description']) ?></p>
                <button class="add-to-cart" onclick="addToCart(<?= htmlspecialchars($article['Id']) ?>)">Ajouter au panier</button>
                <button class="add-to-wishlist" onclick="addToWishlist(<?= htmlspecialchars($article['Id']) ?>)">Ajouter à la wishlist</button>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>

    <script src="javascript/actions.js"></script>
</body>
</html>

<?php
session_start();

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

require_once "api/crud.php";

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
    <?php include 'includes/navbar.php'; ?>
    
    <div class="single-article-container">
        <div class="article-image-container">
            <img src="images/test_image.jpg" alt="<?= htmlspecialchars($article['Name']) ?>" class="single-article-image">
        </div>
        <div class="article-info-container">
            <h1 class="single-article-title"><?= htmlspecialchars($article['Name']) ?></h1>
            <div class="single-article-price"><?= htmlspecialchars($article['Price']) ?> €</div>
            <div class="single-article-description">
                <?= htmlspecialchars($article['Description']) ?>
            </div>
            <div class="single-article-actions">
                <button class="add-to-cart-btn" onclick="addToCart(<?= htmlspecialchars($article['Id']) ?>)">
                    Ajouter au panier
                </button>
                <button class="add-to-wishlist-btn" onclick="addToWishlist(<?= htmlspecialchars($article['Id']) ?>)">
                    Ajouter aux favoris
                </button>
            </div>
        </div>
    </div>
    
    <?php include 'includes/footer.php'; ?>
    <script src="javascript/actions.js"></script>
</body>
</html>

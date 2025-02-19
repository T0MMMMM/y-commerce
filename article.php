<?php
session_start();
require_once "api/crudArticles.php";
require_once "api/crudCommands.php";
require_once "api/crudUser.php";

require_once 'utils/utils.php';

if (!isset($_GET['id']) || !isset($_GET['slug'])) {
    header("Location: index.php");
    exit();
}

$article = getArticleById($_GET['id']);

// Vérification si le slug dans l'URL correspond au slug de l'article
if ($article['Slug'] !== $_GET['slug'] || $article["Id"] !== (int) $_GET['id']) {
    header("Location: index.php");
    exit();
}
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
            <div class="article-metadata">
                <span class="article-author">Par <a href="/y-commerce/user.php?id=<?= htmlspecialchars($article['AuthorId']) ?>"><?= htmlspecialchars($article['Author']) ?></a></span>
                <span class="article-date">Publié le <?= date('d/m/Y', strtotime($article['Publication_date'])) ?></span>
                <span class="article-slug">#<?= htmlspecialchars($article['Slug']) ?></span>
            </div>
            <div class="single-article-price"><?= htmlspecialchars($article['Price']) ?> €</div>
            <div class="single-article-description"><?= htmlspecialchars($article['Description']) ?></div>
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

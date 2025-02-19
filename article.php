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
    <title>Article - y-commerce</title>
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
                <span class="article-author">Par <a href="/y-commerce/user.php?u=<?= htmlspecialchars($article['Author']) ?>"><?= htmlspecialchars($article['Author']) ?></a></span>
                <span class="article-date">Publié le <?= date('d/m/Y', strtotime($article['Publication_date'])) ?></span>
                <span class="article-slug">#<?= htmlspecialchars($article['Slug']) ?></span>
            </div>
            <div class="single-article-price"><?= htmlspecialchars($article['Price']) ?> €</div>
            <div class="single-article-description"><?= htmlspecialchars($article['Description']) ?></div>
            <div class="single-article-actions">
                <?php if (isset($_SESSION['cart'][$article['Id']])): ?>
                    <div class="cart-controls">
                        <button class="quantity-btn" onclick="updateCart(<?= $article['Id'] ?>, -1)">
                            <i class="fas fa-minus"></i>
                        </button>
                        <span class="quantity"><?= $_SESSION['cart'][$article['Id']]['quantity'] ?></span>
                        <button class="quantity-btn" onclick="updateCart(<?= $article['Id'] ?>, 1)">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                <?php else: ?>
                    <button class="add-to-cart-btn" onclick="addToCart(<?= htmlspecialchars($article['Id']) ?>)">
                        <i class="fas fa-shopping-cart"></i> Ajouter au panier
                    </button>
                <?php endif; ?>
                <div class="secondary-actions">
                    <button class="add-to-wishlist-btn" onclick="addToWishlist(<?= htmlspecialchars($article['Id']) ?>)" 
                            style="<?= !isset($_SESSION['user']) || $_SESSION['user'] !== $article['Id_owner'] ? 'width: 100%;' : '' ?>">
                        <i class="fas fa-heart"></i> Ajouter aux favoris
                    </button>
                    <?php if (isset($_SESSION['user']) && ($_SESSION['user'] === $article['Id_owner'] || isAdmin())): ?>
                        <form action="edit_article.php" method="post" class="edit-article-btn" onclick="this.submit()">
                            <input type="hidden" name="id" value="<?= $article['Id'] ?>">
                            <i class="fas fa-edit"></i> Modifier
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    
    <?php include 'includes/footer.php'; ?>
    <script src="javascript/actions.js"></script>
</body>
</html>

<?php
    session_start();
    require_once "api/crud/crud_article.php";
    require_once "api/crud/crud_command.php";
    require_once "api/crud/crud_user.php";
    require_once "api/utils/admin_utils.php";


    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>y-commerce</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            <?php

            
            if (isset($_GET["search-bar"])) {
                $articles = getArticlesByName($_GET["search-bar"]);
            } else {
                $articles = getAllArticles();
            }
            

            foreach ($articles as $article):
            ?>
            <!-- Product card -->
            <div class="product-card" onclick="window.location.href='article.php?id=<?= htmlspecialchars($article['id']) ?>&slug=<?= htmlspecialchars($article['slug']) ?>'">
                <img src="<?= htmlspecialchars($article['image_link']) ?>" alt="<?= htmlspecialchars($article['name']) ?>" class="product-image">
                <div class="product-info">
                    <div>
                        <h3 class="product-name"><?= htmlspecialchars($article["name"]) ?></h3>
                        <p class="product-price"><?= htmlspecialchars($article["price"]) ?> €</p>
                    </div>
                    <?php if (isset($_SESSION['cart'][$article['id']])): ?>
                        <div class="cart-controls" onclick="event.stopPropagation();">
                            <button class="quantity-btn quantity-btn-card" onclick="updateCart(<?= $article['id'] ?>, -1)">
                                <i class="fas fa-minus"></i>
                            </button>
                            <span class="quantity"><?= $_SESSION['cart'][$article['id']]['quantity'] ?></span>
                            <button class="quantity-btn quantity-btn-card" onclick="updateCart(<?= $article['id'] ?>, 1)">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    <?php else: ?>
                        <button class="add-to-cart" onclick="event.stopPropagation(); addToCart(<?= htmlspecialchars($article['id']) ?>)">
                            <i class="fas fa-shopping-cart"></i> Ajouter au panier
                        </button>
                    <?php endif; ?>
                </div>
            </div>

            <?php endforeach; ?>
            
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
    <script src="javascript/actions.js"></script>
    <script src="javascript/cart_actions.js"></script>

</body>
</html>
<?php 
    session_start();
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boutique E-commerce</title>
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

            usort($articles, function($a, $b) {
                return $b["Publication_date"] <=> $a["Publication_date"];  // "<=>" retourne -1, 0 ou 1 selon la comparaison
            });
            

            foreach ($articles as $article):
            ?>
            <!-- Product card -->
            <div class="product-card" onclick="window.location.href='article.php?id=<?= htmlspecialchars($article['Id']) ?>'">
                <img src="images/test_image.jpg" alt="Produit 1" class="product-image">
                <div class="product-info">
                    <div>
                        <h3 class="product-name"><?= $article["Name"] ?></h3>
                        <p class="product-price"><?= $article["Price"] ?> €</p>
                    </div>
                    <form method="post" action="api/cart.php">
                        <input type="hidden" name="path" value="/" ?>
                        <?= '<input type="hidden" name="product_id" value="' . htmlspecialchars($article['Id']) . '">' ?>
                        <button class="add-to-cart" value="add_to_cart" name="action" >Ajouter au panier</button>
                    </form>
                    
                </div>
            </div>

            <?php endforeach; ?>
            
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
<?php 
    session_start();
    require_once "utils/utils.php";
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
                return $b["Publication_date"] <=> $a["Publication_date"];
            });
            

            foreach ($articles as $article):
            ?>
            <!-- Product card -->
            <div class="product-card" onclick="window.location.href='article.php?id=<?= htmlspecialchars($article['Id']) ?>&slug=<?= htmlspecialchars($article['Slug']) ?>'">
                <img src="<?= htmlspecialchars($article['Image_link']) ?>" alt="<?= htmlspecialchars($article['Name']) ?>" class="product-image">
                <div class="product-info">
                    <div>
                        <h3 class="product-name"><?= htmlspecialchars($article["Name"]) ?></h3>
                        <p class="product-price"><?= htmlspecialchars($article["Price"]) ?> €</p>
                    </div>
                    <button class="add-to-cart" onclick="event.stopPropagation(); addToCart(<?= htmlspecialchars($article['Id']) ?>)">
                        <i class="fas fa-shopping-cart"></i> Ajouter au panier
                    </button>
                </div>
            </div>

            <?php endforeach; ?>
            
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
    <script src="javascript/actions.js"></script>
</body>
</html>
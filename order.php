<?php
session_start();
require_once 'includes/auth_check.php';
require_once "api/crudArticles.php";
require_once "api/crudCommands.php";
require_once "api/crudUser.php";
require_once "api/command.php";

$user = getUserById($_SESSION['user']);
$orders = getAllCommandsByUserId($user['id']);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vos Commandes - y-commerce</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <?php include 'includes/navbar.php'; ?>

    <div class="cmd-dashboard-wrapper">
        <header class="cmd-dashboard-header">
            <div class="cmd-spacer">&nbsp;</div>
        </header>
        
        <main class="cmd-orders-panel">
            <div class="cmd-panel-header">
                <h2>Vos Commandes</h2>
                <span class="cmd-order-count"><?= count($orders) ?> commande(s)</span>
            </div>
            
            <div class="cmd-orders-grid">
                <?php foreach ($orders as $order): ?>
                <div class="cmd-order-box">
                    <div class="cmd-order-header">
                        <div class="cmd-order-meta">
                            <div class="cmd-meta-item"><i class="fas fa-calendar"></i> <?= htmlspecialchars($order['transaction_date']) ?></div>
                            <div class="cmd-meta-item"><i class="fas fa-tag"></i> <?= htmlspecialchars($order['total_price']) ?> €</div>
                        </div>
                        <div class="cmd-order-address">
                            <i class="fas fa-home"></i> <?= htmlspecialchars($order['adress']) ?>
                        </div>
                    </div>
                    
                    <div class="cmd-products-list">
                        <?php foreach ($order['article_list'] as $article): ?>
                            <?php $orderdetails = getOrderDetailsById($article); ?>
                            <?php $article = getArticleById($orderdetails['article_id']); ?>
                            <div class="cmd-product-card">
                                <div class="cmd-product-thumb">
                                    <img src="<?= htmlspecialchars($article['image_link']) ?>" alt="<?= htmlspecialchars($article['name']) ?>">
                                </div>
                                <div class="cmd-product-info">
                                    <h3 class="cmd-product-name"><?= htmlspecialchars($article['slug']) ?></h3>
                                    <div class="cmd-product-details">
                                        <span class="cmd-product-price"><?= htmlspecialchars($article['price']) ?> €</span>
                                        <span class="cmd-product-quantity">x<?= htmlspecialchars($orderdetails['quantity']) ?></span>
                                        <span class="cmd-product-total"><?= htmlspecialchars($article['price'] * $orderdetails['quantity']) ?> €</span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </main>
    </div>
    
    <?php include 'includes/footer.php'; ?>
</body>
</html>
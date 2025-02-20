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
    <link rel="stylesheet" href="css/test.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="dashboard-wrapper">
        <header class="dashboard-header">
            <h1>Administration</h1>
        </header>
        
        <main class="orders-panel">
            <div class="panel-header">
                <h2>Vos Commandes</h2>
                <span class="order-count"><?= count($orders) ?> commande(s)</span>
            </div>
            
            <div class="orders-grid">
                <?php foreach ($orders as $order): ?>
                <div class="order-box">
                    <div class="order-header">
                        <div class="order-meta">
                            <div class="meta-item"><i class="fas fa-calendar"></i> <?= htmlspecialchars($order['transaction_date']) ?></div>
                            <div class="meta-item"><i class="fas fa-tag"></i> <?= htmlspecialchars($order['total_price']) ?> €</div>
                        </div>
                        <div class="order-address">
                            <i class="fas fa-home"></i> <?= htmlspecialchars($order['adress']) ?>
                        </div>
                    </div>
                    
                    <div class="products-list">
                        <?php foreach ($order['article_list'] as $article): ?>
                            <?php $orderdetails = getOrderDetailsById($article); ?>
                            <?php $article = getArticleById($orderdetails['article_id']); ?>
                            <div class="product-card">
                                <div class="product-thumb">
                                    <img src="<?= htmlspecialchars($article['image_link']) ?>" alt="<?= htmlspecialchars($article['name']) ?>">
                                </div>
                                <div class="product-info">
                                    <h3 class="product-name"><?= htmlspecialchars($article['name']) ?></h3>
                                    <div class="product-details">
                                        <span class="product-price"><?= htmlspecialchars($article['price']) ?> €</span>
                                        <span class="product-quantity">x<?= htmlspecialchars($orderdetails['quantity']) ?></span>
                                        <span class="product-total"><?= htmlspecialchars($article['price'] * $orderdetails['quantity']) ?> €</span>
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
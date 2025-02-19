<?php
session_start();
require_once 'includes/auth_check.php';
require_once 'api/crud.php';
require_once 'utils/utils.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un article - y-commerce</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <?php include 'includes/navbar.php'; ?>
    
    <div class="create-article-container">
        <div class="create-article-card">
            <h1>Créer un nouvel article</h1>
            
            <form onsubmit="event.preventDefault(); createArticle(this)" class="create-article-form">
                <div class="form-group">
                    <label for="name">Nom de l'article*</label>
                    <input type="text" id="name" name="name" required class="form-input">
                </div>

                <div class="form-group">
                    <label for="description">Description*</label>
                    <textarea id="description" name="description" required class="form-input" rows="5"></textarea>
                </div>

                <div class="form-group">
                    <label for="price">Prix (€)*</label>
                    <input type="number" id="price" name="price" step="0.01" min="0" required class="form-input">
                </div>

                <div class="form-group">
                    <label for="image_link">Lien de l'image</label>
                    <input type="url" id="image_link" name="image_link" class="form-input">
                </div>

                <button type="submit" class="create-article-btn">
                    <i class="fas fa-plus"></i> Publier l'article
                </button>
            </form>
        </div>
    </div>
    
    <?php include 'includes/footer.php'; ?>
    <script src="javascript/article_actions.js"></script>
</body>
</html>

<?php
session_start();
require_once 'includes/auth_check.php';
require_once "api/crudArticles.php";
require_once "api/crudCommands.php";
require_once "api/crudUser.php";
require_once "api/command.php";
require_once 'utils/utils.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$article = getArticleById($_GET['id']);

// Vérifier si l'utilisateur est le propriétaire de l'article
if (!$article || $article['Id_owner'] !== $_SESSION['user']) {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'article - y-commerce</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'includes/navbar.php'; ?>
    
    <div class="create-article-container">
        <div class="create-article-card">
            <h1>Modifier l'article</h1>
            
            <form onsubmit="event.preventDefault(); updateArticle(this, <?= $article['id'] ?>)" class="create-article-form">
                <div class="form-group">
                    <label for="name">Nom de l'article*</label>
                    <input type="text" id="name" name="name" required class="form-input" 
                           value="<?= htmlspecialchars($article['name']) ?>">
                </div>

                <div class="form-group">
                    <label for="description">Description*</label>
                    <textarea id="description" name="description" required class="form-input" 
                              rows="5"><?= htmlspecialchars($article['description']) ?></textarea>
                </div>

                <div class="form-group">
                    <label for="price">Prix (€)*</label>
                    <input type="number" id="price" name="price" step="0.01" min="0" required 
                           class="form-input" value="<?= htmlspecialchars($article['price']) ?>">
                </div>

                <div class="form-group">
                    <label for="image_link">Lien de l'image</label>
                    <input type="url" id="image_link" name="image_link" class="form-input" 
                           value="<?= htmlspecialchars($article['image_link']) ?>">
                </div>

                <button type="submit" class="create-article-btn">
                    Enregistrer les modifications
                </button>
            </form>
        </div>
    </div>
    
    <?php include 'includes/footer.php'; ?>
    <script src="javascript/article_actions.js"></script>
</body>
</html>

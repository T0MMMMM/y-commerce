<?php
session_start();
require_once 'api/crud.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = getUserById($_SESSION['user']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilisateur - y-commerce</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Navigation bar -->
    <?php include 'includes/navbar.php'; ?>
    
    <!-- Main content -->
    <div class="auth-container">
        <div class="auth-card">
            <h2 class="auth-title">Profil Utilisateur</h2>
            <div class="form-group">
                <label>Nom d'utilisateur:</label>
                <p><?= htmlspecialchars($user['Username']) ?></p>
            </div>
            <div class="form-group">
                <label>Balance:</label>
                <p><?= htmlspecialchars($user['Balance']) ?> €</p>
            </div>
            <div class="form-group">
                <label>Rôle:</label>
                <p><?= htmlspecialchars($user['Role']) ?></p>
            </div>
            <div class="form-group">
                <label>Wishlist:</label>
                <p><?= htmlspecialchars($user['Wishlist']) ?></p>
            </div>
            <div class="form-group">
                <a href="edit_profile.php" class="edit-profile-button">Modifier le profil</a>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>
</body>
</html>

function deleteArticle(article_id) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cet article ?')) {

        fetch('api/actions/admin_actions.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                article_id: article_id,
                action: 'delete_article'
            })
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data.success) {
                location.reload();
            } else {
                alert("Erreur lors de la suppression de l'article");
            }
        });
    }
}

function deleteUser(user_id) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')) {

        fetch('api/actions/admin_actions.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                    user_id: user_id,
                    action: 'delete_user'
          })
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data.success) {
                location.reload();
            } else {
                alert("Erreur lors de la suppression de l'utilisateur");
            }
        });
    }
}

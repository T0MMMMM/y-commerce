function createArticle(form) {
    fetch('api/article_actions.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        credentials: 'include',
        body: new URLSearchParams({
            'action': 'create',
            'name': form.name.value,
            'description': form.description.value,
            'price': form.price.value,
            'image_link': form.image_link.value
        })
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
        const response = JSON.parse(data);
        if (response.success) {
            window.location.href = `article.php?id=${response.id}&slug=${response.slug}`;
        } else {
            alert(response.error || 'Erreur lors de la création de l\'article');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Erreur lors de la création de l\'article');
    });
}

function updateArticle(form, articleId) {
    fetch('api/article_actions.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        credentials: 'include',
        body: new URLSearchParams({
            'action': 'update',
            'id': articleId,
            'name': form.name.value,
            'description': form.description.value,
            'price': form.price.value,
            'image_link': form.image_link.value
        })
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
        const response = JSON.parse(data);
        if (response.success) {
            window.location.href = `article.php?id=${articleId}&slug=${response.slug}`;
        } else {
            alert(response.error || 'Erreur lors de la modification de l\'article');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Erreur lors de la modification de l\'article');
    });
}

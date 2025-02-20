function createArticle(form) {
    fetch('api/actions/article_actions.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        credentials: 'include',
        body: JSON.stringify({
            action: 'create_article',
            name: form.name.value,
            description: form.description.value,
            price: form.price.value,
            image_link: form.image_link.value
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        window.location.href = 'index.php';
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Erreur lors de la création de l\'article');
    });
}

function updateArticle(form, article_id) {
    fetch('api/actions/article_actions.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        credentials: 'include',
        body: JSON.stringify({
            action: 'update_article',
            id: article_id,
            name: form.name.value,
            description: form.description.value,
            price: form.price.value,
            image_link: form.image_link.value
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        window.location.href = 'index.php';
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Erreur lors de la modification de l\'article');
    });
}

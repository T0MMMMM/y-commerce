function addToCart(productId) {
    console.log('Action: add_to_cart'); // Log action
    fetch('api/cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        credentials: 'include', // Include cookies in the request
        body: new URLSearchParams({
            'product_id': productId,
            'action': 'add_to_cart'
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        location.reload();
    })
    .catch(error => console.error('Error:', error));
}

function handleAuth(event, action) {
    event.preventDefault();
    console.log('Action:', action); // Log action
    const form = event.target;
    const formData = new FormData(form);
    formData.append('action', action);

    fetch('api/register.php', {
        method: 'POST',
        credentials: 'include', // Include cookies in the request
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        if (!data.success) {
            alert("Erreur : " + data.error);
        } else {
            window.location.href = 'index.php';
        }
    })
    .catch(error => console.error('Error:', error));
}

function updateCart(productId, quantityChange) {
    console.log('Action: update_cart'); // Log action
    fetch('api/cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        credentials: 'include', // Include cookies in the request
        body: new URLSearchParams({
            'product_id': productId,
            'quantity_change': quantityChange,
            'action': 'update_cart'
        })
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
        location.reload();
    })
    .catch(error => console.error('Error:', error));
}

function removeFromCart(productId) {
    console.log('Action: remove_from_cart'); // Log action
    fetch('api/cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        credentials: 'include', // Include cookies in the request
        body: new URLSearchParams({
            'product_id': productId,
            'action': 'remove_from_cart'
        })
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
        location.reload();
    })
    .catch(error => console.error('Error:', error));
}

function createCommand() {
    console.log('Action: create_command'); // Log action
    fetch('api/command.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        credentials: 'include', // Include cookies in the request
        body: new URLSearchParams({
            'action': "create_command"
        })
    })
    .then(response => response.json())
    .then(data => {
        if (!data.success) {
            alert("Erreur : " + data.error);
        } else {
            location.reload();;
        };        
    })
    .catch(error => console.error('Error:', error));
}

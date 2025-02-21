function addToCart(product_id) {
    fetch('api/actions/cart_actions.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        credentials: 'include',
        body: JSON.stringify({
            product_id: product_id,
            action: 'add_to_cart'
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
    const form = event.target;
    const formData = new FormData(form);
    const jsonObject = {};

    formData.forEach((value, key) => {
        jsonObject[key] = value;
    });
    jsonObject['action'] = action;

    fetch('api/actions/auth_actions.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        credentials: 'include',
        body: JSON.stringify(jsonObject)
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

function updateCart(product_id, quantity_change) {
    fetch('api/actions/cart_actions.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        credentials: 'include',
        body: JSON.stringify({
            product_id: product_id,
            quantity_change: quantity_change,
            action: 'update_cart'
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        location.reload();
    })
    .catch(error => console.error('Error:', error));
}

function removeFromCart(product_id) {
    fetch('api/actions/cart_actions.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        credentials: 'include',
        body: JSON.stringify({
            product_id: product_id,
            action: 'remove_from_cart'
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        location.reload();
    })
    .catch(error => console.error('Error:', error));
}

function createCommand() {
    fetch('api/actions/command_actions.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        credentials: 'include',
        body: JSON.stringify({
            action: 'create_command'
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        if (!data.success) {
            alert("Erreurs : " + data.error);
        } else {
            location.reload();;
        };        
    })
    .catch(error => console.error('Error:', error));
}

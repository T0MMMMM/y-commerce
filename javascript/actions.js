
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

function createCommand() {
    const form = document.getElementById('shipping-form');
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    const address = document.getElementById('address').value;
    const city = document.getElementById('city').value;
    const postalCode = document.getElementById('postal_code').value;

    fetch('api/actions/command_actions.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        credentials: 'include',
        body: JSON.stringify({
            action: 'create_command',
            shipping_address: {
                address: address,
                city: city,
                postal_code: postalCode
            }
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

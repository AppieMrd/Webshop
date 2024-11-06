<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Winkelwagentje</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .cart {
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin: 10px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        button {
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background-color: #ff1a1a;
        }
        .checkout-button {
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .checkout-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<header>
    <h1>Winkelwagentje</h1>
    <nav>
        <a href="index.php">Home</a>
    </nav>
</header>

<section class="cart">
    <h2>Je winkelwagentje</h2>
    <ul id="cartItems"></ul>
    <p>Totaal: €<span id="totalPrice">0.00</span></p>
    <button id="checkoutButton" class="checkout-button">Afrekenen</button>
</section>

<script src="script.js"></script>
<script>
    // Initialize cart if it doesn't exist
    if (!localStorage.getItem('cart')) {
        localStorage.setItem('cart', JSON.stringify([]));
    }

    // Load cart from localStorage
    let cart = JSON.parse(localStorage.getItem('cart'));
    displayCart();

    function displayCart() {
        const cartItemsElement = document.getElementById("cartItems");
        const totalPriceElement = document.getElementById("totalPrice");
        cartItemsElement.innerHTML = '';
        let total = 0;

        if (cart.length === 0) {
            cartItemsElement.innerHTML = '<li>Je winkelwagentje is leeg.</li>';
        } else {
            cart.forEach((item, index) => {
                let li = document.createElement("li");
                li.textContent = item.name + " - €" + item.price.toFixed(2);

                // Create a delete button
                let deleteButton = document.createElement("button");
                deleteButton.textContent = "Verwijder";
                deleteButton.onclick = function() {
                    removeFromCart(index);
                };

                li.appendChild(deleteButton);
                cartItemsElement.appendChild(li);
                total += item.price;
            });
        }

        totalPriceElement.textContent = total.toFixed(2); // Format total to 2 decimal places
    }

    function removeFromCart(index) {
        cart.splice(index, 1); // Remove item from cart
        localStorage.setItem('cart', JSON.stringify(cart)); // Update localStorage
        displayCart(); // Refresh cart display
    }

    // Checkout functionality
    document.getElementById("checkoutButton").onclick = function() {
        if (cart.length === 0) {
            alert("Je winkelwagentje is leeg! Voeg items toe voordat je afrekent.");
            return;
        }
        // Redirect to checkout page or implement checkout logic here
        alert("Afrekenen is nog niet geïmplementeerd. Dit is een voorbeeld.");
        // Example: window.location.href = "checkout.php"; // Uncomment to redirect
    };
</script>
</body>
</html>
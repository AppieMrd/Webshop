let cart = JSON.parse(localStorage.getItem('cart')) || [];
let cartCount = document.getElementById("cart-count");
let cartItems = document.getElementById("cart-items");
let totalPrice = document.getElementById("total-price");
let cartModal = document.getElementById("cart-modal");
let closeBtn = document.querySelector(".close");

document.getElementById("cart-link").addEventListener("click", openCartModal);
closeBtn.addEventListener("click", closeCartModal);

// Function to add item to cart
function addToCart(productName, price) {
    cart.push({ name: productName, price: price });
    updateLocalStorage();
    updateCart();
}

// Function to update localStorage
function updateLocalStorage() {
    localStorage.setItem('cart', JSON.stringify(cart));
}

// Function to update cart display
function updateCart() {
    cartCount.textContent = cart.length;
    cartItems.innerHTML = '';
    let total = 0;

    cart.forEach((item, index) => {
        let li = document.createElement("li");
        li.textContent = item.name + " - €" + item.price.toFixed(2); // Format price

        let deleteButton = document.createElement("button");
        deleteButton.textContent = "Verwijder";
        deleteButton.onclick = function() {
            removeFromCart(index);
        };

        li.appendChild(deleteButton);
        cartItems.appendChild(li);
        total += item.price;
    });

    totalPrice.textContent = total.toFixed(2); // Format total price
}

// Function to display cart on cart page
function displayCartOnCartPage() {
    if (window.location.href.includes("cart.php")) {
        updateCart(); // Reuse the updateCart function
    }
}

// Function to remove item from cart
function removeFromCart(index) {
    cart.splice(index, 1);
    updateLocalStorage(); // Update localStorage
    updateCart(); // Refresh cart display
}

// Function to open cart modal
function openCartModal() {
    cartModal.style.display = "block";
}

// Function to close cart modal
function closeCartModal() {
    cartModal.style.display = "none";
}

// Initial display of cart on page load
updateCart();
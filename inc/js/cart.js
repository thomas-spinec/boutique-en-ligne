let cart = {
    items: [],
    total: 0
};

// Define a function to show or hide the size input depending on the product category (eg. accessory)
function toggleSizeInput($product) {
    let sizeInput = document.getElementById("size");
    if ($product.category == 1) {
        sizeInput.style.display = "none";
    } else {
        sizeInput.style.display = "block";
    }
}

function saveCart() {
    localStorage.setItem('cart', JSON.stringify(cart));
}

function loadCart() {
    cart = JSON.parse(localStorage.getItem('cart')) || {
        items: [],
        total: 0
    };
}

function addItem(id, name, price, qty = 1) {
    // Check if item already exists in the cart
    let item = cart.items.find(item => item.id === id);
    if($product['category'] == 1){
        $size = "N/A";
    }
    
    if (item) {
        // Increase quantity of existing item
        item.qty += qty;
    } else {
        // Add new item to cart list
        cart.items.push({ id, name, price, qty });
    }
    
    // Update cart total
    cart.total += price * qty;
    
    // Save cart to localStorage
    saveCart();
}

function removeItem(id) {
    // Find item in the cart
    let item = cart.items.find(item => item.id === id);
    
    if (item) {
        // Update cart total
        cart.total -= item.qty * item.price;
        
        // Remove item from cart list
        cart.items = cart.items.filter(item => item.id !== id);
        
        // Save cart to localStorage
        saveCart();
    }
}

// Event listeners
document.getElementById("add_to_cart").addEventListener("click", function() {
    // get the size input
    let sizeInput = document.getElementById("size");
    let size = sizeInput.value;
    // get the quantity input
    let qtyInput = document.getElementById("quantity");
    let qty = qtyInput.value;
    // Create a JSON object with the order data
    $id = $_GET['id_product'];
    $name = $_GET['name'];
    $price = $_GET['price'];

    let orderData = {
        "size": size,
        "quantity": qty,
        "id_product": $id,
        "name": $name,
        "price": $price
    };
    // Send an HTTP POST request to the server-side endpoint using fetch()
    fetch('inc/php/process-order.php', {
        method: 'POST',
        headers: {
        'Content-Type': 'application/json'
        },
        body: JSON.stringify(orderData)
    })
    .then(response => response.json())
    .then(data => {
        // Handle response data from the server
    })
    .catch(error => {
        console.error('Error:', error);
    });

});

loadCart();
<?php
require_once 'includes/utils.php';
require_once 'config/database.php';

// Require login to access orders
requireLogin();

// Handle order submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    $items = json_decode($_POST['cart_items'], true);
    $table_number = (int)$_POST['table_number'];
    $notes = sanitize($_POST['notes']);
    $total_amount = 0;

    if (!empty($items)) {
        // Start transaction
        $conn->begin_transaction();

        try {
            // Create order
            $order_stmt = $conn->prepare("INSERT INTO orders (user_id, table_number, total_amount, notes) VALUES (?, ?, ?, ?)");
            
            // Calculate total amount
            foreach ($items as $item) {
                $total_amount += $item['price'] * $item['quantity'];
            }

            $order_stmt->bind_param("iids", $_SESSION['user_id'], $table_number, $total_amount, $notes);
            $order_stmt->execute();
            $order_id = $conn->insert_id;

            // Insert order items
            $item_stmt = $conn->prepare("INSERT INTO order_items (order_id, menu_item_id, quantity, price) VALUES (?, ?, ?, ?)");
            
            foreach ($items as $item) {
                $item_stmt->bind_param("iiid", $order_id, $item['id'], $item['quantity'], $item['price']);
                $item_stmt->execute();
            }

            $conn->commit();
            $success_message = "Order placed successfully!";
            
            // Return JSON response for AJAX requests
            if (isset($_POST['ajax'])) {
                jsonResponse(true, $success_message, ['order_id' => $order_id]);
            }
        } catch (Exception $e) {
            $conn->rollback();
            $error_message = "Failed to place order. Please try again.";
            
            if (isset($_POST['ajax'])) {
                jsonResponse(false, $error_message);
            }
        }
    }
}

// Get user's order history
$history_stmt = $conn->prepare("
    SELECT o.*, 
           COUNT(oi.id) as item_count,
           GROUP_CONCAT(CONCAT(oi.quantity, 'x ', mi.name) SEPARATOR ', ') as items
    FROM orders o
    JOIN order_items oi ON o.id = oi.order_id
    JOIN menu_items mi ON oi.menu_item_id = mi.id
    WHERE o.user_id = ?
    GROUP BY o.id
    ORDER BY o.created_at DESC
");
$history_stmt->bind_param("i", $_SESSION['user_id']);
$history_stmt->execute();
$order_history = $history_stmt->get_result()->fetch_all(MYSQLI_ASSOC);

include 'includes/header.php';
?>

<div class="container mt-5">
    <div class="row">
        <!-- Shopping Cart -->
        <div class="col-md-8">
            <div class="card shadow-sm mb-4" data-aos="fade-up">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-shopping-cart"></i> Your Cart</h5>
                </div>
                <div class="card-body">
                    <div id="cartItems">
                        <!-- Cart items will be loaded here via JavaScript -->
                    </div>
                    <div id="emptyCartMessage" class="text-center py-4" style="display: none;">
                        <i class="fas fa-shopping-basket fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Your cart is empty</p>
                        <a href="menu.php" class="btn btn-primary">Browse Menu</a>
                    </div>
                </div>
            </div>

            <!-- Order Form -->
            <div id="orderForm" class="card shadow-sm" data-aos="fade-up" style="display: none;">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-file-alt"></i> Order Details</h5>
                </div>
                <div class="card-body">
                    <form id="placeOrderForm" onsubmit="return submitOrder(event)">
                        <input type="hidden" name="ajax" value="1">
                        <input type="hidden" name="place_order" value="1">
                        <input type="hidden" name="cart_items" id="cartItemsInput">

                        <div class="mb-3">
                            <label for="table_number" class="form-label">Table Number</label>
                            <input type="number" class="form-control" id="table_number" name="table_number" 
                                   min="1" required>
                        </div>

                        <div class="mb-3">
                            <label for="notes" class="form-label">Special Instructions</label>
                            <textarea class="form-control" id="notes" name="notes" rows="3" 
                                    placeholder="Any special requests or allergies?"></textarea>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <h5>Total: <span class="text-primary" id="orderTotal">$0.00</span></h5>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-check-circle"></i> Place Order
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Order History -->
        <div class="col-md-4">
            <div class="card shadow-sm" data-aos="fade-left">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-history"></i> Order History</h5>
                </div>
                <div class="card-body p-0">
                    <?php if (empty($order_history)): ?>
                        <div class="text-center py-4">
                            <p class="text-muted mb-0">No order history yet</p>
                        </div>
                    <?php else: ?>
                        <div class="list-group list-group-flush">
                            <?php foreach ($order_history as $order): ?>
                                <div class="list-group-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="mb-1">Order #<?php echo $order['id']; ?></h6>
                                        <small class="text-muted">
                                            <?php echo date('M d, Y H:i', strtotime($order['created_at'])); ?>
                                        </small>
                                    </div>
                                    <p class="mb-1 text-muted"><?php echo $order['items']; ?></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-<?php 
                                            echo match($order['status']) {
                                                'pending' => 'warning',
                                                'processing' => 'info',
                                                'completed' => 'success',
                                                'cancelled' => 'danger',
                                                default => 'secondary'
                                            };
                                        ?>">
                                            <?php echo ucfirst($order['status']); ?>
                                        </span>
                                        <strong>$<?php echo number_format($order['total_amount'], 2); ?></strong>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Update cart display when page loads
document.addEventListener('DOMContentLoaded', function() {
    updateCartDisplay();
});

function updateCartDisplay() {
    const cartItems = cart.items;
    const cartItemsDiv = document.getElementById('cartItems');
    const emptyCartMessage = document.getElementById('emptyCartMessage');
    const orderForm = document.getElementById('orderForm');
    const cartItemsInput = document.getElementById('cartItemsInput');
    
    if (cartItems.length === 0) {
        cartItemsDiv.innerHTML = '';
        emptyCartMessage.style.display = 'block';
        orderForm.style.display = 'none';
        return;
    }

    let total = 0;
    let html = '<div class="table-responsive"><table class="table">';
    html += '<thead><tr><th>Item</th><th>Price</th><th>Quantity</th><th>Subtotal</th><th></th></tr></thead><tbody>';

    cartItems.forEach(item => {
        const subtotal = item.price * item.quantity;
        total += subtotal;
        html += `
            <tr>
                <td>${item.name}</td>
                <td>$${item.price.toFixed(2)}</td>
                <td>
                    <div class="input-group input-group-sm" style="width: 100px;">
                        <button class="btn btn-outline-secondary" type="button" 
                                onclick="updateQuantity(${item.id}, ${item.quantity - 1})">-</button>
                        <input type="number" class="form-control text-center" value="${item.quantity}" min="1"
                               onchange="updateQuantity(${item.id}, this.value)">
                        <button class="btn btn-outline-secondary" type="button"
                                onclick="updateQuantity(${item.id}, ${item.quantity + 1})">+</button>
                    </div>
                </td>
                <td>$${subtotal.toFixed(2)}</td>
                <td>
                    <button class="btn btn-danger btn-sm" onclick="cart.removeItem(${item.id})">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>`;
    });

    html += '</tbody></table></div>';
    cartItemsDiv.innerHTML = html;
    emptyCartMessage.style.display = 'none';
    orderForm.style.display = 'block';
    
    // Update total and cart items input
    document.getElementById('orderTotal').textContent = `$${total.toFixed(2)}`;
    cartItemsInput.value = JSON.stringify(cartItems);
}

function updateQuantity(itemId, newQuantity) {
    cart.updateQuantity(itemId, newQuantity);
    updateCartDisplay();
}

function submitOrder(event) {
    event.preventDefault();
    if (cart.items.length === 0) {
        cart.showToast('Your cart is empty');
        return false;
    }

    const form = event.target;
    const formData = new FormData(form);

    fetch('order.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            cart.clearCart();
            updateCartDisplay();
            cart.showToast(data.message);
            setTimeout(() => window.location.reload(), 2000);
        } else {
            cart.showToast(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        cart.showToast('An error occurred while placing your order');
    });

    return false;
}

// Update cart display when cart changes
document.addEventListener('cartUpdated', updateCartDisplay);
</script>

<style>
.card {
    overflow: hidden;
}

.list-group-item {
    transition: background-color 0.3s ease;
}

.list-group-item:hover {
    background-color: rgba(0,0,0,0.02);
}

.input-group input[type="number"] {
    appearance: textfield;
    -moz-appearance: textfield;
}

.input-group input[type="number"]::-webkit-outer-spin-button,
.input-group input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
</style>

<?php include 'includes/footer.php'; ?>

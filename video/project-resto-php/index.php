<?php
require_once 'includes/utils.php';
require_once 'config/database.php';

// Get featured menu items
$stmt = $conn->prepare("SELECT m.*, c.name as category_name 
                       FROM menu_items m 
                       JOIN menu_categories c ON m.category_id = c.id 
                       WHERE m.is_available = 1 
                       LIMIT 6");
$stmt->execute();
$featured_items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

include 'includes/header.php';
?>

<!-- Hero Section -->
<div class="hero-section">
    <div class="container">
        <h1 class="display-4" data-aos="fade-down">Welcome to RestoPHP</h1>
        <p class="lead" data-aos="fade-up">Discover our delicious menu and enjoy the best dining experience</p>
        <a href="menu.php" class="btn btn-primary btn-lg mt-3" data-aos="zoom-in">
            <i class="fas fa-utensils"></i> View Menu
        </a>
    </div>
</div>

<!-- Featured Menu Section -->
<div class="container">
    <h2 class="text-center mb-5" data-aos="fade-up">Featured Menu Items</h2>
    <div class="row">
        <?php foreach ($featured_items as $item): ?>
            <div class="col-md-4 mb-4">
                <div class="card menu-card h-100" data-aos="fade-up">
                    <img src="<?php echo $item['image'] ? 'uploads/' . $item['image'] : 'images/default-food.jpg'; ?>" 
                         class="card-img-top" alt="<?php echo htmlspecialchars($item['name']); ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($item['name']); ?></h5>
                        <p class="card-text text-muted"><?php echo htmlspecialchars($item['category_name']); ?></p>
                        <p class="card-text"><?php echo htmlspecialchars($item['description']); ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">$<?php echo number_format($item['price'], 2); ?></h6>
                            <button class="btn btn-primary btn-sm" onclick="cart.addItem({
                                id: <?php echo $item['id']; ?>,
                                name: '<?php echo addslashes($item['name']); ?>',
                                price: <?php echo $item['price']; ?>
                            })">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Features Section -->
<div class="container mt-5">
    <div class="row">
        <div class="col-md-4 mb-4" data-aos="fade-right">
            <div class="text-center">
                <i class="fas fa-clock fa-3x mb-3 text-primary"></i>
                <h4>Fast Service</h4>
                <p>Quick and efficient service for your convenience</p>
            </div>
        </div>
        <div class="col-md-4 mb-4" data-aos="fade-up">
            <div class="text-center">
                <i class="fas fa-star fa-3x mb-3 text-primary"></i>
                <h4>Quality Food</h4>
                <p>Made with the finest ingredients for the best taste</p>
            </div>
        </div>
        <div class="col-md-4 mb-4" data-aos="fade-left">
            <div class="text-center">
                <i class="fas fa-truck fa-3x mb-3 text-primary"></i>
                <h4>Free Delivery</h4>
                <p>Free delivery for orders above $50</p>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

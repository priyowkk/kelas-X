<?php
require_once 'includes/utils.php';
require_once 'config/database.php';

// Get all categories
$cat_stmt = $conn->prepare("SELECT * FROM menu_categories ORDER BY name");
$cat_stmt->execute();
$categories = $cat_stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// Get selected category
$category_id = isset($_GET['category']) ? (int)$_GET['category'] : 0;
$search = isset($_GET['search']) ? sanitize($_GET['search']) : '';

// Prepare menu items query
$query = "SELECT m.*, c.name as category_name 
          FROM menu_items m 
          JOIN menu_categories c ON m.category_id = c.id 
          WHERE m.is_available = 1";

if ($category_id > 0) {
    $query .= " AND m.category_id = ?";
}

if (!empty($search)) {
    $query .= " AND (m.name LIKE ? OR m.description LIKE ?)";
}

$query .= " ORDER BY c.name, m.name";
$stmt = $conn->prepare($query);

if ($category_id > 0 && !empty($search)) {
    $search_param = "%$search%";
    $stmt->bind_param("iss", $category_id, $search_param, $search_param);
} elseif ($category_id > 0) {
    $stmt->bind_param("i", $category_id);
} elseif (!empty($search)) {
    $search_param = "%$search%";
    $stmt->bind_param("ss", $search_param, $search_param);
}

$stmt->execute();
$menu_items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

include 'includes/header.php';
?>

<div class="container mt-5">
    <!-- Search and Filter Section -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card shadow-sm" data-aos="fade-up">
                <div class="card-body">
                    <form method="GET" class="row g-3">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                <input type="text" class="form-control" name="search" placeholder="Search menu..." 
                                       value="<?php echo htmlspecialchars($search); ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <select class="form-select" name="category">
                                <option value="0">All Categories</option>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?php echo $cat['id']; ?>" 
                                            <?php echo $category_id == $cat['id'] ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($cat['name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">Filter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu Items Section -->
    <?php if (empty($menu_items)): ?>
        <div class="alert alert-info text-center" role="alert" data-aos="fade-up">
            <i class="fas fa-info-circle"></i> No menu items found.
        </div>
    <?php else: ?>
        <?php 
        $current_category = '';
        foreach ($menu_items as $item):
            if ($current_category !== $item['category_name']):
                if ($current_category !== '') echo '</div>'; // Close previous row
                $current_category = $item['category_name'];
        ?>
            <h3 class="mt-4 mb-3" data-aos="fade-right">
                <i class="fas fa-utensils"></i> <?php echo htmlspecialchars($current_category); ?>
            </h3>
            <div class="row">
        <?php endif; ?>

            <div class="col-md-4 mb-4">
                <div class="card menu-card h-100" data-aos="fade-up">
                    <div class="card-img-container">
                        <img src="<?php echo $item['image'] ? 'uploads/' . $item['image'] : 'images/default-food.jpg'; ?>" 
                             class="card-img-top" alt="<?php echo htmlspecialchars($item['name']); ?>">
                        <?php if (isLoggedIn()): ?>
                            <button class="btn btn-primary btn-sm favorite-btn" 
                                    data-bs-toggle="tooltip" 
                                    title="Add to favorites">
                                <i class="fas fa-heart"></i>
                            </button>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($item['name']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($item['description']); ?></p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <h6 class="mb-0 text-primary">$<?php echo number_format($item['price'], 2); ?></h6>
                            <div class="btn-group">
                                <button class="btn btn-outline-primary btn-sm" 
                                        data-bs-toggle="tooltip" 
                                        title="View details"
                                        onclick="showItemDetails(<?php echo htmlspecialchars(json_encode($item)); ?>)">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-primary btn-sm" 
                                        onclick="cart.addItem({
                                            id: <?php echo $item['id']; ?>,
                                            name: '<?php echo addslashes($item['name']); ?>',
                                            price: <?php echo $item['price']; ?>
                                        })">
                                    <i class="fas fa-cart-plus"></i> Add
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        </div> <!-- Close last row -->
    <?php endif; ?>
</div>

<!-- Item Details Modal -->
<div class="modal fade" id="itemDetailsModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Menu Item Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <img id="modalItemImage" src="" alt="" class="img-fluid rounded">
                </div>
                <h4 id="modalItemName" class="mb-3"></h4>
                <p id="modalItemDescription" class="text-muted"></p>
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="text-primary mb-0">$<span id="modalItemPrice"></span></h5>
                    <span class="badge bg-secondary" id="modalItemCategory"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="modalAddToCart">
                    <i class="fas fa-cart-plus"></i> Add to Cart
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function showItemDetails(item) {
    document.getElementById('modalItemImage').src = item.image ? `uploads/${item.image}` : 'images/default-food.jpg';
    document.getElementById('modalItemImage').alt = item.name;
    document.getElementById('modalItemName').textContent = item.name;
    document.getElementById('modalItemDescription').textContent = item.description;
    document.getElementById('modalItemPrice').textContent = parseFloat(item.price).toFixed(2);
    document.getElementById('modalItemCategory').textContent = item.category_name;
    
    document.getElementById('modalAddToCart').onclick = () => {
        cart.addItem({
            id: item.id,
            name: item.name,
            price: item.price
        });
        bootstrap.Modal.getInstance(document.getElementById('itemDetailsModal')).hide();
    };
    
    new bootstrap.Modal(document.getElementById('itemDetailsModal')).show();
}
</script>

<!-- Add custom styles -->
<style>
.card-img-container {
    position: relative;
    overflow: hidden;
}

.card-img-container img {
    transition: transform 0.3s ease;
    height: 200px;
    object-fit: cover;
}

.card-img-container:hover img {
    transform: scale(1.05);
}

.favorite-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    z-index: 1;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.card:hover .favorite-btn {
    opacity: 1;
}

.menu-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.menu-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}
</style>

<?php include 'includes/footer.php'; ?>

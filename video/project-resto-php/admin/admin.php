<?php
// Debugging information
if (!session_id()) session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "Session information:<br>";
echo "User ID: " . ($_SESSION['user_id'] ?? 'Not set') . "<br>";
echo "Username: " . ($_SESSION['username'] ?? 'Not set') . "<br>";
echo "Role: " . ($_SESSION['role'] ?? 'Not set') . "<br>";

require_once '../includes/utils.php';
require_once '../config/database.php';

// Require admin access
requireAdmin();

// Handle menu item actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_menu'])) {
        $name = sanitize($_POST['name']);
        $description = sanitize($_POST['description']);
        $price = (float)$_POST['price'];
        $category_id = (int)$_POST['category_id'];
        
        // Handle image upload
        $image = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
            $upload_result = uploadImage($_FILES['image'], '../uploads/');
            if ($upload_result['success']) {
                $image = $upload_result['filename'];
            }
        }

        $stmt = $conn->prepare("INSERT INTO menu_items (name, description, price, category_id, image) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdis", $name, $description, $price, $category_id, $image);
        
        if ($stmt->execute()) {
            $success_message = "Menu item added successfully!";
        } else {
            $error_message = "Failed to add menu item.";
        }
    } 
    elseif (isset($_POST['delete_menu'])) {
        $menu_id = (int)$_POST['menu_id'];
        $stmt = $conn->prepare("DELETE FROM menu_items WHERE id = ?");
        $stmt->bind_param("i", $menu_id);
        
        if ($stmt->execute()) {
            jsonResponse(true, "Menu item deleted successfully!");
        } else {
            jsonResponse(false, "Failed to delete menu item.");
        }
    }
    elseif (isset($_POST['toggle_user'])) {
        $user_id = (int)$_POST['user_id'];
        $is_active = (int)$_POST['is_active'];
        
        $stmt = $conn->prepare("UPDATE users SET is_active = ? WHERE id = ? AND role != 'admin'");
        $stmt->bind_param("ii", $is_active, $user_id);
        
        if ($stmt->execute()) {
            jsonResponse(true, "User status updated successfully!");
        } else {
            jsonResponse(false, "Failed to update user status.");
        }
    }
    elseif (isset($_POST['update_menu'])) {
        $menu_id = (int)$_POST['menu_id'];
        $name = sanitize($_POST['name']);
        $description = sanitize($_POST['description']);
        $price = (float)$_POST['price'];
        $category_id = (int)$_POST['category_id'];
        $is_available = isset($_POST['is_available']) ? 1 : 0;
        
        // Handle image upload
        $image_clause = "";
        $types = "ssdii";
        $params = [$name, $description, $price, $category_id, $is_available];
        
        if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
            $upload_result = uploadImage($_FILES['image'], '../uploads/');
            if ($upload_result['success']) {
                $image_clause = ", image = ?";
                $types .= "s";
                $params[] = $upload_result['filename'];
            }
        }
        
        $types .= "i";
        $params[] = $menu_id;
        
        $stmt = $conn->prepare("UPDATE menu_items SET name = ?, description = ?, price = ?, 
                              category_id = ?, is_available = ?" . $image_clause . " WHERE id = ?");
        $stmt->bind_param($types, ...$params);
        
        if ($stmt->execute()) {
            jsonResponse(true, "Menu item updated successfully!");
        } else {
            jsonResponse(false, "Failed to update menu item.");
        }
    }
}

// Get all categories
$categories = $conn->query("SELECT * FROM menu_categories ORDER BY name")->fetch_all(MYSQLI_ASSOC);

// Get all menu items
$menu_items = $conn->query("
    SELECT m.*, c.name as category_name 
    FROM menu_items m 
    JOIN menu_categories c ON m.category_id = c.id 
    ORDER BY c.name, m.name
")->fetch_all(MYSQLI_ASSOC);

// Get all users except admins
$users = $conn->query("
    SELECT id, username, email, is_active, created_at 
    FROM users 
    WHERE role != 'admin' 
    ORDER BY username
")->fetch_all(MYSQLI_ASSOC);

include '../includes/header.php';
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">Admin Dashboard</h2>
            
            <!-- Tabs -->
            <ul class="nav nav-tabs mb-4" id="adminTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="menu-tab" data-bs-toggle="tab" href="#menu" role="tab">
                        <i class="fas fa-utensils"></i> Manage Menu
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="users-tab" data-bs-toggle="tab" href="#users" role="tab">
                        <i class="fas fa-users"></i> Manage Users
                    </a>
                </li>
            </ul>
            
            <div class="tab-content" id="adminTabsContent">
                <!-- Menu Management Tab -->
                <div class="tab-pane fade show active" id="menu" role="tabpanel">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <button class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addMenuModal">
                                <i class="fas fa-plus"></i> Add New Menu Item
                            </button>
                            
                            <div class="table-responsive">
                                <table class="table table-hover" id="menuTable">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Price</th>
                                            <th>Available</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($menu_items as $item): ?>
                                            <tr>
                                                <td>
                                                    <img src="<?php echo $item['image'] ? '../uploads/' . $item['image'] : '../images/default-food.jpg'; ?>" 
                                                         alt="<?php echo htmlspecialchars($item['name']); ?>"
                                                         class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                                </td>
                                                <td><?php echo htmlspecialchars($item['name']); ?></td>
                                                <td><?php echo htmlspecialchars($item['category_name']); ?></td>
                                                <td>$<?php echo number_format($item['price'], 2); ?></td>
                                                <td>
                                                    <span class="badge bg-<?php echo $item['is_available'] ? 'success' : 'danger'; ?>">
                                                        <?php echo $item['is_available'] ? 'Yes' : 'No'; ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-menu" 
                                                            data-menu='<?php echo htmlspecialchars(json_encode($item)); ?>'
                                                            data-bs-toggle="modal" data-bs-target="#editMenuModal">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger delete-menu" 
                                                            data-id="<?php echo $item['id']; ?>">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Users Management Tab -->
                <div class="tab-pane fade" id="users" role="tabpanel">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="usersTable">
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Joined</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($users as $user): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($user['username']); ?></td>
                                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                                                <td>
                                                    <span class="badge bg-<?php echo $user['is_active'] ? 'success' : 'danger'; ?>">
                                                        <?php echo $user['is_active'] ? 'Active' : 'Inactive'; ?>
                                                    </span>
                                                </td>
                                                <td><?php echo date('M d, Y', strtotime($user['created_at'])); ?></td>
                                                <td>
                                                    <button class="btn btn-sm btn-<?php echo $user['is_active'] ? 'danger' : 'success'; ?> toggle-user"
                                                            data-id="<?php echo $user['id']; ?>"
                                                            data-active="<?php echo $user['is_active']; ?>">
                                                        <i class="fas fa-<?php echo $user['is_active'] ? 'ban' : 'check'; ?>"></i>
                                                        <?php echo $user['is_active'] ? 'Deactivate' : 'Activate'; ?>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Menu Modal -->
<div class="modal fade" id="addMenuModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Menu Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="add_menu" value="1">
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select class="form-select" id="category_id" name="category_id" required>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?php echo $category['id']; ?>">
                                    <?php echo htmlspecialchars($category['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Menu Item</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Menu Modal -->
<div class="modal fade" id="editMenuModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Menu Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="update_menu" value="1">
                    <input type="hidden" name="menu_id" id="edit_menu_id">
                    
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_category_id" class="form-label">Category</label>
                        <select class="form-select" id="edit_category_id" name="category_id" required>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?php echo $category['id']; ?>">
                                    <?php echo htmlspecialchars($category['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit_price" class="form-label">Price</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control" id="edit_price" name="price" step="0.01" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Description</label>
                        <textarea class="form-control" id="edit_description" name="description" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="edit_is_available" name="is_available">
                            <label class="form-check-label" for="edit_is_available">
                                Available
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="edit_image" class="form-label">New Image (optional)</label>
                        <input type="file" class="form-control" id="edit_image" name="image" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Menu Item</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Handle menu item deletion
document.querySelectorAll('.delete-menu').forEach(button => {
    button.addEventListener('click', function() {
        if (confirm('Are you sure you want to delete this menu item?')) {
            const menuId = this.dataset.id;
            const formData = new FormData();
            formData.append('delete_menu', '1');
            formData.append('menu_id', menuId);
            
            fetch('', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    this.closest('tr').remove();
                }
                alert(data.message);
            });
        }
    });
});

// Handle user status toggle
document.querySelectorAll('.toggle-user').forEach(button => {
    button.addEventListener('click', function() {
        const userId = this.dataset.id;
        const currentlyActive = this.dataset.active === '1';
        const action = currentlyActive ? 'deactivate' : 'activate';
        
        if (confirm(`Are you sure you want to ${action} this user?`)) {
            const formData = new FormData();
            formData.append('toggle_user', '1');
            formData.append('user_id', userId);
            formData.append('is_active', currentlyActive ? '0' : '1');
            
            fetch('', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
                alert(data.message);
            });
        }
    });
});

// Handle menu item edit
document.querySelectorAll('.edit-menu').forEach(button => {
    button.addEventListener('click', function() {
        const menu = JSON.parse(this.dataset.menu);
        document.getElementById('edit_menu_id').value = menu.id;
        document.getElementById('edit_name').value = menu.name;
        document.getElementById('edit_category_id').value = menu.category_id;
        document.getElementById('edit_price').value = menu.price;
        document.getElementById('edit_description').value = menu.description;
        document.getElementById('edit_is_available').checked = menu.is_available === '1';
    });
});

// Initialize tooltips
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
});
</script>

<?php include '../includes/footer.php'; ?>

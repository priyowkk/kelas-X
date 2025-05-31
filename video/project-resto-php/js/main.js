// Initialize animations
document.addEventListener('DOMContentLoaded', function() {
    // Animate elements on scroll
    const animatedElements = document.querySelectorAll('[data-aos]');
    animatedElements.forEach(element => {
        element.classList.add('fade-in');
    });

    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});

// Cart functionality
class Cart {
    constructor() {
        this.items = JSON.parse(localStorage.getItem('cart')) || [];
        this.updateCartBadge();
    }

    addItem(item) {
        const existingItem = this.items.find(i => i.id === item.id);
        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            this.items.push({ ...item, quantity: 1 });
        }
        this.saveCart();
        this.showToast('Item added to cart');
    }

    removeItem(itemId) {
        this.items = this.items.filter(item => item.id !== itemId);
        this.saveCart();
        this.showToast('Item removed from cart');
    }

    updateQuantity(itemId, quantity) {
        const item = this.items.find(i => i.id === itemId);
        if (item) {
            item.quantity = parseInt(quantity);
            if (item.quantity <= 0) {
                this.removeItem(itemId);
            }
        }
        this.saveCart();
    }

    saveCart() {
        localStorage.setItem('cart', JSON.stringify(this.items));
        this.updateCartBadge();
    }

    updateCartBadge() {
        const badge = document.querySelector('.cart-badge');
        if (badge) {
            const itemCount = this.items.reduce((total, item) => total + item.quantity, 0);
            badge.setAttribute('data-count', itemCount);
        }
    }

    showToast(message) {
        const toastContainer = document.querySelector('.toast-container');
        if (!toastContainer) {
            const container = document.createElement('div');
            container.className = 'toast-container';
            document.body.appendChild(container);
        }

        const toast = document.createElement('div');
        toast.className = 'toast show';
        toast.innerHTML = `
            <div class="toast-header">
                <strong class="me-auto">Notification</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
            </div>
            <div class="toast-body">${message}</div>
        `;

        document.querySelector('.toast-container').appendChild(toast);
        setTimeout(() => toast.remove(), 3000);
    }

    clearCart() {
        this.items = [];
        this.saveCart();
    }
}

// Initialize cart
const cart = new Cart();

// Form validation
function validateForm(formId) {
    const form = document.getElementById(formId);
    if (!form) return true;

    let isValid = true;
    const inputs = form.querySelectorAll('input[required], select[required], textarea[required]');

    inputs.forEach(input => {
        if (!input.value.trim()) {
            input.classList.add('is-invalid');
            isValid = false;
        } else {
            input.classList.remove('is-invalid');
        }
    });

    return isValid;
}

// Ajax form submission
function submitForm(formId, url, method = 'POST') {
    if (!validateForm(formId)) return false;

    const form = document.getElementById(formId);
    const formData = new FormData(form);

    fetch(url, {
        method: method,
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            cart.showToast(data.message || 'Success!');
            if (data.redirect) {
                window.location.href = data.redirect;
            }
        } else {
            cart.showToast(data.message || 'An error occurred');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        cart.showToast('An error occurred');
    });

    return false;
}

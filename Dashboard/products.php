<?php

include 'header.php';
?>
            <!-- Main Content -->
            <main id="main-content" class="admin-main">
                <div class="container-fluid p-4 p-lg-4">
                    
                    <!-- Page Header -->
                    <div class="d-flex justify-content-between align-items-center mb-4 mb-lg-4">
                        <div>
                            <h1 class="h3 mb-0">Product Management</h1>
                            <p class="text-muted mb-0">Manage your product catalog and inventory</p>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-secondary" @click="exportProducts()">
                                <i class="bi bi-download me-2"></i>Export
                            </button>
                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#importModal">
                                <i class="bi bi-upload me-2"></i>Import
                            </button>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productModal">
                                <i class="bi bi-plus-lg me-2"></i>Add Product
                            </button>
                        </div>
                    </div>

                    <!-- Product Management Container -->
                    <div x-data="productTable" x-init="init()">
                        
                        <!-- Product Stats Widgets -->
                        <div class="row g-4 g-lg-4 mb-5">
                            <div class="col-xl-3 col-lg-6">
                                <div class="card stats-card">
                                    <div class="card-body p-3 p-lg-4">
                                        <div class="d-flex align-items-center">
                                            <div class="stats-icon bg-primary bg-opacity-10 text-primary me-3">
                                                <i class="bi bi-box"></i>
                                            </div>
                                            <div>
                                                <p class="h6 mb-0 text-muted">Total Products</p>
                                                <div class="h3 mb-0" aria-live="polite"><span x-text="stats.total"></span></div>
                                                <small class="text-success-emphasis">
                                                    <i class="bi bi-arrow-up"></i> +5% from last month
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6">
                                <div class="card stats-card">
                                    <div class="card-body p-3 p-lg-4">
                                        <div class="d-flex align-items-center">
                                            <div class="stats-icon bg-success bg-opacity-10 text-success me-3">
                                                <i class="bi bi-check-circle"></i>
                                            </div>
                                            <div>
                                                <p class="h6 mb-0 text-muted">In Stock</p>
                                                <div class="h3 mb-0" aria-live="polite"><span x-text="stats.inStock"></span></div>
                                                <small class="text-success-emphasis">
                                                    <i class="bi bi-arrow-up"></i> Well stocked
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6">
                                <div class="card stats-card">
                                    <div class="card-body p-3 p-lg-4">
                                        <div class="d-flex align-items-center">
                                            <div class="stats-icon bg-warning bg-opacity-10 text-warning me-3">
                                                <i class="bi bi-exclamation-triangle"></i>
                                            </div>
                                            <div>
                                                <p class="h6 mb-0 text-muted">Low Stock</p>
                                                <div class="h3 mb-0" aria-live="polite"><span x-text="stats.lowStock"></span></div>
                                                <small class="text-warning">
                                                    <i class="bi bi-exclamation-circle"></i> Needs attention
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6">
                                <div class="card stats-card">
                                    <div class="card-body p-3 p-lg-4">
                                        <div class="d-flex align-items-center">
                                            <div class="stats-icon bg-info bg-opacity-10 text-info me-3">
                                                <i class="bi bi-currency-dollar"></i>
                                            </div>
                                            <div>
                                                <p class="h6 mb-0 text-muted">Total Value</p>
                                                <div class="h3 mb-0" aria-live="polite"><span x-text="`$${stats.totalValue.toLocaleString()}`"></span></div>
                                                <small class="text-info">
                                                    <i class="bi bi-info-circle"></i> Inventory value
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Charts Row -->
                        <div class="row g-4 g-lg-4 mb-5">
                            <!-- Sales Performance Chart -->
                            <div class="col-lg-8">
                                <div class="card h-100">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h2 class="h5 card-title mb-0">Sales Performance</h2>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <input type="radio" class="btn-check" name="salesPeriod" id="sales7d" autocomplete="off" checked="">
                                            <label class="btn btn-outline-secondary" for="sales7d">7D</label>
                                            <input type="radio" class="btn-check" name="salesPeriod" id="sales30d" autocomplete="off">
                                            <label class="btn btn-outline-secondary" for="sales30d">30D</label>
                                            <input type="radio" class="btn-check" name="salesPeriod" id="sales90d" autocomplete="off">
                                            <label class="btn btn-outline-secondary" for="sales90d">90D</label>
                                        </div>
                                    </div>
                                    <div class="card-body p-3 p-lg-4">
                                        <div id="salesChart" style="height: 300px;"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Category Distribution -->
                            <div class="col-lg-4">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h2 class="h5 card-title mb-0">Category Distribution</h2>
                                    </div>
                                    <div class="card-body p-3 p-lg-4">
                                        <div id="categoryChart" style="height: 200px;"></div>
                                        <div class="mt-3">
                                            <template x-for="category in categoryStats" :key="category.name">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <span class="small" x-text="category.name"></span>
                                                    <div class="d-flex align-items-center">
                                                        <span class="small text-muted me-2" x-text="`${category.percentage}%`"></span>
                                                        <span class="small fw-medium" x-text="category.count"></span>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Products Table -->
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h2 class="h5 card-title mb-0">Product Catalog</h2>
                                    </div>
                                    <div class="col-auto">
                                        <div class="d-flex gap-2">
                                            <!-- Search -->
                                            <div class="position-relative">
                                                <input type="search" class="form-control form-control-sm" placeholder="Search products..." x-model="searchQuery" @input="filterProducts()" style="width: 200px;">
                                                <i class="bi bi-search position-absolute top-50 end-0 translate-middle-y me-2 text-muted"></i>
                                            </div>
                                            
                                            <!-- Category Filter -->
                                            <select class="form-select form-select-sm" x-model="categoryFilter" @change="filterProducts()" style="width: 150px;">
                                                <option value="">All Categories</option>
                                                <option value="electronics">Electronics</option>
                                                <option value="clothing">Clothing</option>
                                                <option value="books">Books</option>
                                                <option value="home">Home & Garden</option>
                                            </select>
                                            
                                            <!-- Stock Filter -->
                                            <select class="form-select form-select-sm" x-model="stockFilter" @change="filterProducts()" style="width: 150px;">
                                                <option value="">All Stock</option>
                                                <option value="in-stock">In Stock</option>
                                                <option value="low-stock">Low Stock</option>
                                                <option value="out-of-stock">Out of Stock</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <!-- Bulk Actions Bar -->
                                <div class="bulk-actions-bar p-3 bg-light border-bottom" x-show="selectedProducts.length > 0" x-transition="">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-muted">
                                            <span x-text="selectedProducts.length"></span> product(s) selected
                                        </span>
                                        <div class="d-flex gap-2">
                                            <button class="btn btn-sm btn-outline-secondary" @click="bulkAction('publish')">
                                                <i class="bi bi-eye me-1"></i>Publish
                                            </button>
                                            <button class="btn btn-sm btn-outline-secondary" @click="bulkAction('unpublish')">
                                                <i class="bi bi-eye-slash me-1"></i>Unpublish
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger" @click="bulkAction('delete')">
                                                <i class="bi bi-trash me-1"></i>Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Table -->
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width: 40px;">
                                                    <input type="checkbox" class="form-check-input" @change="toggleAll($event.target.checked)" :checked="selectedProducts.length === filteredProducts.length && filteredProducts.length > 0">
                                                </th>
                                                <th>Product</th>
                                                <th @click="sortBy('category')" class="sortable">Category</th>
                                                <th @click="sortBy('price')" class="sortable">Price</th>
                                                <th @click="sortBy('stock')" class="sortable">Stock</th>
                                                <th>Status</th>
                                                <th @click="sortBy('created')" class="sortable">Created</th>
                                                <th style="width: 120px;">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <template x-for="product in paginatedProducts" :key="product.id">
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" class="form-check-input" :value="product.id" x-model="selectedProducts">
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <img :src="product.image" class="product-image me-3" :alt="product.name" loading="lazy" decoding="async">
                                                            <div>
                                                                <div class="fw-medium" x-text="product.name"></div>
                                                                <small class="text-muted" x-text="'SKU: ' + product.sku"></small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-light text-dark" x-text="product.category"></span>
                                                    </td>
                                                    <td x-text="`$${product.price}`"></td>
                                                    <td>
                                                        <span class="badge stock-badge" :class="{
                                                                  'in-stock': product.stock > 20,
                                                                  'low-stock': product.stock > 0 && product.stock <= 20,
                                                                  'out-of-stock': product.stock === 0
                                                              }" x-text="product.stock + ' units'"></span>
                                                    </td>
                                                    <td>
                                                        <span class="badge" :class="{
                                                                  'bg-success': product.status === 'published',
                                                                  'bg-secondary': product.status === 'draft',
                                                                  'bg-warning': product.status === 'pending'
                                                              }" x-text="product.status"></span>
                                                    </td>
                                                    <td x-text="product.created"></td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                                <i class="bi bi-three-dots"></i>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li><a class="dropdown-item" href="#" @click="editProduct(product)">
                                                                    <i class="bi bi-pencil me-2"></i>Edit
                                                                </a></li>
                                                                <li><a class="dropdown-item" href="#" @click="viewProduct(product)">
                                                                    <i class="bi bi-eye me-2"></i>View Details
                                                                </a></li>
                                                                <li><a class="dropdown-item" href="#" @click="duplicateProduct(product)">
                                                                    <i class="bi bi-copy me-2"></i>Duplicate
                                                                </a></li>
                                                                <li><hr class="dropdown-divider"></li>
                                                                <li><a class="dropdown-item text-danger" href="#" @click="deleteProduct(product)">
                                                                    <i class="bi bi-trash me-2"></i>Delete
                                                                </a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Pagination -->
                                <div class="d-flex justify-content-between align-items-center p-3">
                                    <div class="text-muted">
                                        Showing <span x-text="(currentPage - 1) * itemsPerPage + 1"></span> to 
                                        <span x-text="Math.min(currentPage * itemsPerPage, filteredProducts.length)"></span> of 
                                        <span x-text="filteredProducts.length"></span> results
                                    </div>
                                    <nav>
                                        <ul class="pagination pagination-sm mb-0">
                                            <li class="page-item" :class="{ 'disabled': currentPage === 1 }">
                                                <a class="page-link" href="#" @click.prevent="goToPage(currentPage - 1)">Previous</a>
                                            </li>
                                            <template x-for="(page, index) in visiblePages" :key="`page-${index}`">
                                                <li class="page-item" :class="{ 'active': page === currentPage }">
                                                    <a class="page-link" href="#" @click.prevent="page !== '...' && goToPage(page)" x-text="page"></a>
                                                </li>
                                            </template>
                                            <li class="page-item" :class="{ 'disabled': currentPage === totalPages }">
                                                <a class="page-link" href="#" @click.prevent="goToPage(currentPage + 1)">Next</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        
                    </div> <!-- End Product Management Container -->

                </div>
            </main>


        </div> <!-- /.admin-wrapper -->
    </div>

    <!-- Product Modal (Add/Edit) -->
    <div class="modal fade" id="productModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form x-data="productForm">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Product Name</label>
                                <input type="text" class="form-control" x-model="form.name" required="">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">SKU</label>
                                <input type="text" class="form-control" x-model="form.sku" required="">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Category</label>
                                <select class="form-select" x-model="form.category" required="">
                                    <option value="">Select Category</option>
                                    <option value="electronics">Electronics</option>
                                    <option value="clothing">Clothing</option>
                                    <option value="books">Books</option>
                                    <option value="home">Home & Garden</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Price</label>
                                <input type="number" class="form-control" x-model="form.price" step="0.01" required="">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Stock Quantity</label>
                                <input type="number" class="form-control" x-model="form.stock" required="">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" x-model="form.description" rows="3"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <select class="form-select" x-model="form.status" required="">
                                    <option value="">Select Status</option>
                                    <option value="published">Published</option>
                                    <option value="draft">Draft</option>
                                    <option value="pending">Pending Review</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Product Image</label>
                                <input type="file" class="form-control" accept="image/*">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" @click="saveProduct()">Save Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Import Modal -->
    <div class="modal fade" id="importModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Products</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Upload CSV File</label>
                        <input type="file" class="form-control" accept=".csv">
                        <div class="form-text">Upload a CSV file with columns: name, sku, category, price, stock, status</div>
                    </div>
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        <strong>CSV Format:</strong> name, sku, category, price, stock, status<br>
                        <small>Example: iPhone 14, IPHONE14-128, electronics, 799.99, 50, published</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Import Products</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('productTable', () => ({
                products: [
                    { id: 1, name: 'Fresh Organic Apples', sku: 'FRT-001', category: 'Fruits', price: 4.99, stock: 150, status: 'published', image: 'assets/images/avatar-placeholder.svg', created: '2025-01-10' },
                    { id: 2, name: 'Whole Wheat Bread', sku: 'BAK-001', category: 'Bakery', price: 3.49, stock: 80, status: 'published', image: 'assets/images/avatar-placeholder.svg', created: '2025-01-11' },
                    { id: 3, name: 'Organic Milk 1L', sku: 'DRY-001', category: 'Dairy', price: 2.99, stock: 5, status: 'published', image: 'assets/images/avatar-placeholder.svg', created: '2025-01-12' },
                    { id: 4, name: 'Free Range Eggs 12pk', sku: 'DRY-002', category: 'Dairy', price: 5.99, stock: 0, status: 'draft', image: 'assets/images/avatar-placeholder.svg', created: '2025-01-13' },
                    { id: 5, name: 'Fresh Orange Juice', sku: 'DRY-003', category: 'Beverages', price: 4.49, stock: 45, status: 'published', image: 'assets/images/avatar-placeholder.svg', created: '2025-01-14' },
                ],
                searchQuery: '',
                categoryFilter: '',
                stockFilter: '',
                sortField: 'name',
                sortDirection: 'asc',
                currentPage: 1,
                itemsPerPage: 5,
                selectedProducts: [],

                get stats() {
                    return {
                        total: this.products.length,
                        inStock: this.products.filter(p => p.stock > 20).length,
                        lowStock: this.products.filter(p => p.stock > 0 && p.stock <= 20).length,
                        totalValue: this.products.reduce((sum, p) => sum + (p.price * p.stock), 0)
                    }
                },

                get categoryStats() {
                    const counts = {};
                    this.products.forEach(p => { counts[p.category] = (counts[p.category] || 0) + 1; });
                    const total = this.products.length;
                    return Object.entries(counts).map(([name, count]) => ({
                        name,
                        count,
                        percentage: total ? Math.round((count / total) * 100) : 0
                    }));
                },

                get filteredProducts() {
                    let items = [...this.products];
                    if (this.searchQuery) {
                        items = items.filter(p => 
                            p.name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                            p.sku.toLowerCase().includes(this.searchQuery.toLowerCase())
                        );
                    }
                    if (this.categoryFilter) items = items.filter(p => p.category.toLowerCase() === this.categoryFilter.toLowerCase());
                    if (this.stockFilter === 'in-stock') items = items.filter(p => p.stock > 20);
                    if (this.stockFilter === 'low-stock') items = items.filter(p => p.stock > 0 && p.stock <= 20);
                    if (this.stockFilter === 'out-of-stock') items = items.filter(p => p.stock === 0);
                    items.sort((a, b) => {
                        let valA = a[this.sortField], valB = b[this.sortField];
                        if (typeof valA === 'string') valA = valA.toLowerCase();
                        if (typeof valB === 'string') valB = valB.toLowerCase();
                        if (valA < valB) return this.sortDirection === 'asc' ? -1 : 1;
                        if (valA > valB) return this.sortDirection === 'asc' ? 1 : -1;
                        return 0;
                    });
                    return items;
                },

                get totalPages() { return Math.ceil(this.filteredProducts.length / this.itemsPerPage); },

                get paginatedProducts() {
                    const start = (this.currentPage - 1) * this.itemsPerPage;
                    return this.filteredProducts.slice(start, start + this.itemsPerPage);
                },

                get visiblePages() {
                    const pages = [];
                    for (let i = 1; i <= this.totalPages; i++) pages.push(i);
                    return pages;
                },

                init() { this.currentPage = 1; },
                filterProducts() { this.currentPage = 1; },

                sortBy(field) {
                    if (this.sortField === field) this.sortDirection = this.sortDirection === 'asc' ? 'desc' : 'asc';
                    else { this.sortField = field; this.sortDirection = 'asc'; }
                },

                goToPage(page) { if (page >= 1 && page <= this.totalPages) this.currentPage = page; },
                toggleAll(checked) { this.selectedProducts = checked ? this.filteredProducts.map(p => p.id) : []; },

                editProduct(product) { alert('Editing product: ' + product.name); },
                viewProduct(product) { alert('Viewing product: ' + product.name); },
                duplicateProduct(product) { alert('Duplicating product: ' + product.name); },
                deleteProduct(product) { if (confirm('Delete ' + product.name + '?')) { this.products = this.products.filter(p => p.id !== product.id); } },
                exportProducts() { alert('Exporting products...'); },
                bulkAction(action) { alert('Bulk ' + action + ' for ' + this.selectedProducts.length + ' products'); }
            }));

            Alpine.data('productForm', () => ({
                form: { name: '', sku: '', category: '', price: '', stock: '', description: '', status: '' },
                saveProduct() { alert('Product saved!'); }
            }));
        });
    </script>
</body>
</html>

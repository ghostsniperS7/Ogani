<?php
include 'header.php';
?>
            <!-- Main Content -->
            <main id="main-content" class="admin-main">
                <div class="container-fluid p-4 p-lg-4">
                    
                    <!-- Page Header -->
                    <div class="d-flex justify-content-between align-items-center mb-4 mb-lg-4 mb-xl-5">
                        <div>
                            <h1 class="h3 mb-0">Product Management</h1>
                            <p class="text-muted mb-0">Manage your products</p>
                        </div>
                        <div class="d-flex gap-2">
                            <a class="btn btn-primary" href="productform.php">
                                <i class="bi bi-plus-circle me-2"></i>Add Product
                            </a>
                        </div>
                    </div>

                    <!-- Products Management Container -->
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
                                                <small class="text-success-emphasis">In catalog</small>
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
                                                <p class="h6 mb-0 text-muted">Published</p>
                                                <div class="h3 mb-0" aria-live="polite"><span x-text="stats.published"></span></div>
                                                <small class="text-success-emphasis">Active products</small>
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
                                                <small class="text-warning">Needs restock</small>
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
                                                <p class="h6 mb-0 text-muted">Avg. Price</p>
                                                <div class="h3 mb-0" aria-live="polite"><span x-text="'$' + stats.avgPrice.toFixed(2)"></span></div>
                                                <small class="text-info">Per product</small>
                                            </div>
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
                                        <h2 class="h5 card-title mb-0">All Products</h2>
                                    </div>
                                    <div class="col-auto">
                                        <div class="d-flex gap-2">
                                            <div class="position-relative">
                                                <input type="search" class="form-control form-control-sm" placeholder="Search products..." x-model="searchQuery" @input="filterProducts()" style="width: 200px;">
                                                <i class="bi bi-search position-absolute top-50 end-0 translate-middle-y me-2 text-muted"></i>
                                            </div>
                                            <select class="form-select form-select-sm" x-model="categoryFilter" @change="filterProducts()" style="width: 140px;">
                                                <option value="">All Categories</option>
                                                <option value="Fruits">Fruits</option>
                                                <option value="Vegetables">Vegetables</option>
                                                <option value="Dairy">Dairy</option>
                                                <option value="Bakery">Bakery</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
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
                                                <th style="width: 120px;">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <template x-for="product in paginatedProducts" :key="product.id">
                                                <tr :class="{ 'selected': selectedProducts.includes(product.id) }">
                                                    <td>
                                                        <input type="checkbox" class="form-check-input" :value="product.id" :checked="selectedProducts.includes(product.id)" @change="toggleProduct(product.id)">
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center gap-2">
                                                            <img :src="product.image" class="rounded-2" width="40" height="40" :alt="product.name" style="object-fit: cover;" loading="lazy">
                                                            <div>
                                                                <div class="fw-medium" x-text="product.name"></div>
                                                                <small class="text-muted" x-text="'SKU: ' + product.sku"></small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><span class="badge bg-primary bg-opacity-10 text-primary" x-text="product.category"></span></td>
                                                    <td class="fw-medium" x-text="'$' + product.price.toFixed(2)"></td>
                                                    <td>
                                                        <span :class="product.stock <= 5 ? 'text-danger fw-medium' : 'text-success'" x-text="product.stock"></span>
                                                    </td>
                                                    <td>
                                                        <span class="badge" :class="product.status === 'published' ? 'bg-success' : 'bg-secondary'" x-text="product.status"></span>
                                                    </td>
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
                                                                    <i class="bi bi-eye me-2"></i>View
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
                                            <template x-for="page in visiblePages" :key="page">
                                                <li class="page-item" :class="{ 'active': page === currentPage }">
                                                    <a class="page-link" href="#" @click.prevent="goToPage(page)" x-text="page"></a>
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
                        
                    </div> <!-- End Products Management Container -->

                </div>
            </main>

        </div> <!-- /.admin-wrapper -->

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('productTable', () => ({
                products: [
                    { id: 1, name: 'Fresh Apples', sku: 'FRT-001', category: 'Fruits', price: 4.99, stock: 50, status: 'published', image: 'assets/images/avatar-placeholder.svg' },
                    { id: 2, name: 'Organic Bananas', sku: 'FRT-002', category: 'Fruits', price: 2.99, stock: 3, status: 'published', image: 'assets/images/avatar-placeholder.svg' },
                    { id: 3, name: 'Fresh Milk', sku: 'DRY-001', category: 'Dairy', price: 3.49, stock: 25, status: 'published', image: 'assets/images/avatar-placeholder.svg' },
                    { id: 4, name: 'Wheat Bread', sku: 'BAK-001', category: 'Bakery', price: 2.49, stock: 0, status: 'draft', image: 'assets/images/avatar-placeholder.svg' },
                    { id: 5, name: 'Orange Juice', sku: 'BEV-001', category: 'Vegetables', price: 5.99, stock: 15, status: 'published', image: 'assets/images/avatar-placeholder.svg' },
                ],
                searchQuery: '',
                categoryFilter: '',
                sortField: 'name',
                sortDirection: 'asc',
                currentPage: 1,
                itemsPerPage: 5,
                selectedProducts: [],

                get stats() {
                    const prices = this.products.map(p => p.price);
                    return {
                        total: this.products.length,
                        published: this.products.filter(p => p.status === 'published').length,
                        lowStock: this.products.filter(p => p.stock > 0 && p.stock <= 5).length,
                        avgPrice: prices.length ? prices.reduce((a, b) => a + b, 0) / prices.length : 0
                    }
                },

                get filteredProducts() {
                    let items = [...this.products];
                    if (this.searchQuery) {
                        items = items.filter(p => 
                            p.name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                            p.sku.toLowerCase().includes(this.searchQuery.toLowerCase())
                        );
                    }
                    if (this.categoryFilter) {
                        items = items.filter(p => p.category === this.categoryFilter);
                    }
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

                get totalPages() {
                    return Math.ceil(this.filteredProducts.length / this.itemsPerPage);
                },

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
                    if (this.sortField === field) {
                        this.sortDirection = this.sortDirection === 'asc' ? 'desc' : 'asc';
                    } else {
                        this.sortField = field;
                        this.sortDirection = 'asc';
                    }
                },

                goToPage(page) {
                    if (page >= 1 && page <= this.totalPages) this.currentPage = page;
                },

                toggleAll(checked) {
                    this.selectedProducts = checked ? this.filteredProducts.map(p => p.id) : [];
                },

                toggleProduct(id) {
                    const idx = this.selectedProducts.indexOf(id);
                    if (idx > -1) this.selectedProducts.splice(idx, 1);
                    else this.selectedProducts.push(id);
                },

                editProduct(product) {
                    alert('Edit product: ' + product.name);
                },

                viewProduct(product) {
                    alert('Viewing product: ' + product.name);
                },

                deleteProduct(product) {
                    if (confirm('Delete product "' + product.name + '"?')) {
                        this.products = this.products.filter(p => p.id !== product.id);
                    }
                }
            }));
        });
    </script>

</body>
</html>

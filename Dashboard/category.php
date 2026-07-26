<?php
include 'header.php';
?>
            <!-- Main Content -->
            <main id="main-content" class="admin-main">
                <div class="container-fluid p-4 p-lg-4">
                    
                    <!-- Page Header -->
                    <div class="d-flex justify-content-between align-items-center mb-4 mb-lg-4 mb-xl-5">
                        <div>
                            <h1 class="h3 mb-0">Category Management</h1>
                            <p class="text-muted mb-0">Manage product categories</p>
                        </div>
                        <div class="d-flex gap-2">
                            <a class="btn btn-primary" href="categoryform.php">
                                <i class="bi bi-plus-circle me-2"></i>Add Category
                            </a>
                        </div>
                    </div>

                    <!-- Categories Management Container -->
                    <div x-data="categoryTable" x-init="init()">
                        
                        <!-- Category Stats Widgets -->
                        <div class="row g-4 g-lg-4 mb-5">
                            <div class="col-xl-3 col-lg-6">
                                <div class="card stats-card">
                                    <div class="card-body p-3 p-lg-4">
                                        <div class="d-flex align-items-center">
                                            <div class="stats-icon bg-primary bg-opacity-10 text-primary me-3">
                                                <i class="bi bi-list"></i>
                                            </div>
                                            <div>
                                                <p class="h6 mb-0 text-muted">Total Categories</p>
                                                <div class="h3 mb-0" aria-live="polite"><span x-text="stats.total"></span></div>
                                                <small class="text-success-emphasis">
                                                    <i class="bi bi-arrow-up"></i> Active categories
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
                                                <p class="h6 mb-0 text-muted">Active</p>
                                                <div class="h3 mb-0" aria-live="polite"><span x-text="stats.active"></span></div>
                                                <small class="text-success-emphasis">Published categories</small>
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
                                                <i class="bi bi-box"></i>
                                            </div>
                                            <div>
                                                <p class="h6 mb-0 text-muted">Total Products</p>
                                                <div class="h3 mb-0" aria-live="polite"><span x-text="stats.products"></span></div>
                                                <small class="text-warning">Across all categories</small>
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
                                                <i class="bi bi-archive"></i>
                                            </div>
                                            <div>
                                                <p class="h6 mb-0 text-muted">Inactive</p>
                                                <div class="h3 mb-0" aria-live="polite"><span x-text="stats.inactive"></span></div>
                                                <small class="text-info">Hidden categories</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Categories Table -->
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h2 class="h5 card-title mb-0">All Categories</h2>
                                    </div>
                                    <div class="col-auto">
                                        <div class="d-flex gap-2">
                                            <div class="position-relative">
                                                <input type="search" class="form-control form-control-sm" placeholder="Search categories..." x-model="searchQuery" @input="filterCategories()" style="width: 200px;">
                                                <i class="bi bi-search position-absolute top-50 end-0 translate-middle-y me-2 text-muted"></i>
                                            </div>
                                            <select class="form-select form-select-sm" x-model="statusFilter" @change="filterCategories()" style="width: 130px;">
                                                <option value="">All Status</option>
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
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
                                                    <input type="checkbox" class="form-check-input" @change="toggleAll($event.target.checked)" :checked="selectedCategories.length === filteredCategories.length && filteredCategories.length > 0">
                                                </th>
                                                <th scope="col" @click="sortBy('name')" class="sortable">
                                                    Name
                                                    <i class="bi bi-arrow-up" x-show="sortField === 'name' && sortDirection === 'asc'"></i>
                                                    <i class="bi bi-arrow-down" x-show="sortField === 'name' && sortDirection === 'desc'"></i>
                                                </th>
                                                <th scope="col">Description</th>
                                                <th scope="col" @click="sortBy('productCount')" class="sortable">
                                                    Products
                                                    <i class="bi bi-arrow-up" x-show="sortField === 'productCount' && sortDirection === 'asc'"></i>
                                                    <i class="bi bi-arrow-down" x-show="sortField === 'productCount' && sortDirection === 'desc'"></i>
                                                </th>
                                                <th scope="col">Status</th>
                                                <th scope="col" @click="sortBy('createdAt')" class="sortable">
                                                    Created
                                                    <i class="bi bi-arrow-up" x-show="sortField === 'createdAt' && sortDirection === 'asc'"></i>
                                                    <i class="bi bi-arrow-down" x-show="sortField === 'createdAt' && sortDirection === 'desc'"></i>
                                                </th>
                                                <th style="width: 120px;">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <template x-for="category in paginatedCategories" :key="category.id">
                                                <tr :class="{ 'selected': selectedCategories.includes(category.id) }">
                                                    <td>
                                                        <input type="checkbox" class="form-check-input" :value="category.id" :checked="selectedCategories.includes(category.id)" @change="toggleCategory(category.id)">
                                                    </td>
                                                    <td>
                                                        <div class="fw-medium" x-text="category.name"></div>
                                                        <small class="text-muted" x-text="'ID: ' + category.id"></small>
                                                    </td>
                                                    <td>
                                                        <span x-text="category.description.length > 50 ? category.description.substring(0, 50) + '...' : category.description"></span>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-primary bg-opacity-10 text-primary" x-text="category.productCount + ' items'"></span>
                                                    </td>
                                                    <td>
                                                        <span class="badge" :class="category.status === 'active' ? 'bg-success' : 'bg-secondary'" x-text="category.status"></span>
                                                    </td>
                                                    <td x-text="category.createdAt"></td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                                <i class="bi bi-three-dots"></i>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li><a class="dropdown-item" href="#" @click="editCategory(category)">
                                                                    <i class="bi bi-pencil me-2"></i>Edit
                                                                </a></li>
                                                                <li><a class="dropdown-item" href="#" @click="viewCategory(category)">
                                                                    <i class="bi bi-eye me-2"></i>View Details
                                                                </a></li>
                                                                <li><hr class="dropdown-divider"></li>
                                                                <li><a class="dropdown-item text-danger" href="#" @click="deleteCategory(category)">
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
                                        <span x-text="Math.min(currentPage * itemsPerPage, filteredCategories.length)"></span> of 
                                        <span x-text="filteredCategories.length"></span> results
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
                        
                    </div> <!-- End Categories Management Container -->

                </div>
            </main>

        </div> <!-- /.admin-wrapper -->

    <!-- Category Edit Modal -->
    <div class="modal fade" id="categoryModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form x-data="categoryForm">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Category Name</label>
                                <input type="text" class="form-control" x-model="form.name" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" rows="4" x-model="form.description" required></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <select class="form-select" x-model="form.status" required>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" @click="saveCategory()">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('categoryTable', () => ({
                categories: [
                    { id: 1, name: 'Fruits', description: 'Fresh fruits and organic produce', productCount: 24, status: 'active', createdAt: '2025-01-10' },
                    { id: 2, name: 'Vegetables', description: 'Fresh vegetables and greens', productCount: 18, status: 'active', createdAt: '2025-01-10' },
                    { id: 3, name: 'Dairy', description: 'Milk, cheese, and dairy products', productCount: 12, status: 'active', createdAt: '2025-01-11' },
                    { id: 4, name: 'Bakery', description: 'Fresh bread, cakes, and pastries', productCount: 8, status: 'inactive', createdAt: '2025-01-12' },
                    { id: 5, name: 'Beverages', description: 'Juices, soft drinks, and more', productCount: 15, status: 'active', createdAt: '2025-01-13' },
                ],
                searchQuery: '',
                statusFilter: '',
                sortField: 'name',
                sortDirection: 'asc',
                currentPage: 1,
                itemsPerPage: 5,
                selectedCategories: [],

                get stats() {
                    return {
                        total: this.categories.length,
                        active: this.categories.filter(c => c.status === 'active').length,
                        products: this.categories.reduce((sum, c) => sum + c.productCount, 0),
                        inactive: this.categories.filter(c => c.status === 'inactive').length
                    }
                },

                get filteredCategories() {
                    let items = [...this.categories];
                    if (this.searchQuery) {
                        items = items.filter(c => 
                            c.name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                            c.description.toLowerCase().includes(this.searchQuery.toLowerCase())
                        );
                    }
                    if (this.statusFilter) {
                        items = items.filter(c => c.status === this.statusFilter);
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
                    return Math.ceil(this.filteredCategories.length / this.itemsPerPage);
                },

                get paginatedCategories() {
                    const start = (this.currentPage - 1) * this.itemsPerPage;
                    return this.filteredCategories.slice(start, start + this.itemsPerPage);
                },

                get visiblePages() {
                    const pages = [];
                    for (let i = 1; i <= this.totalPages; i++) pages.push(i);
                    return pages;
                },

                init() { this.currentPage = 1; },

                filterCategories() { this.currentPage = 1; },

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
                    this.selectedCategories = checked ? this.filteredCategories.map(c => c.id) : [];
                },

                toggleCategory(id) {
                    const idx = this.selectedCategories.indexOf(id);
                    if (idx > -1) this.selectedCategories.splice(idx, 1);
                    else this.selectedCategories.push(id);
                },

                editCategory(category) {
                    // Open edit modal with category data
                    alert('Edit category: ' + category.name);
                },

                viewCategory(category) {
                    alert('Viewing category: ' + category.name);
                },

                deleteCategory(category) {
                    if (confirm('Delete category "' + category.name + '"?')) {
                        this.categories = this.categories.filter(c => c.id !== category.id);
                    }
                }
            }));

            Alpine.data('categoryForm', () => ({
                form: { name: '', description: '', status: 'active' },
                saveCategory() {
                    alert('Category saved!');
                }
            }));
        });
    </script>

</body>
</html>

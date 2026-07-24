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
                    <div>
                        


                                <!-- Table -->
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width: 40px;">
                                                    <input type="checkbox" class="user-select-checkbox" @change="toggleAll($event.target.checked)" :checked="selectedUsers.length === filteredUsers.length && filteredUsers.length > 0">
                                                </th>
                                                <th scope="col" role="button" tabindex="0" @click="sortBy('name')" @keydown.enter.prevent="sortBy('name')" @keydown.space.prevent="sortBy('name')" :aria-sort="sortField === 'name' ? (sortDirection === 'asc' ? 'ascending' : 'descending') : 'none'" class="sortable">
                                                    Name
                                                    <i class="bi bi-arrow-up" x-show="sortField === 'name' && sortDirection === 'asc'" aria-hidden="true"></i>
                                                    <i class="bi bi-arrow-down" x-show="sortField === 'name' && sortDirection === 'desc'" aria-hidden="true"></i>
                                                </th>
                                                <th scope="col" role="button" tabindex="0" @click="sortBy('email')" @keydown.enter.prevent="sortBy('email')" @keydown.space.prevent="sortBy('email')" :aria-sort="sortField === 'email' ? (sortDirection === 'asc' ? 'ascending' : 'descending') : 'none'" class="sortable">
                                                    Email
                                                    <i class="bi bi-arrow-up" x-show="sortField === 'email' && sortDirection === 'asc'" aria-hidden="true"></i>
                                                    <i class="bi bi-arrow-down" x-show="sortField === 'email' && sortDirection === 'desc'" aria-hidden="true"></i>
                                                </th>
                                                <th scope="col">Role</th>
                                                <th scope="col">Status</th>
                                                <th scope="col" role="button" tabindex="0" @click="sortBy('lastActive')" @keydown.enter.prevent="sortBy('lastActive')" @keydown.space.prevent="sortBy('lastActive')" :aria-sort="sortField === 'lastActive' ? (sortDirection === 'asc' ? 'ascending' : 'descending') : 'none'" class="sortable">
                                                    Last Active
                                                    <i class="bi bi-arrow-up" x-show="sortField === 'lastActive' && sortDirection === 'asc'" aria-hidden="true"></i>
                                                    <i class="bi bi-arrow-down" x-show="sortField === 'lastActive' && sortDirection === 'desc'" aria-hidden="true"></i>
                                                </th>
                                                <th style="width: 120px;">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <template x-for="user in paginatedUsers" :key="user.id">
                                                <tr :class="{ 'selected': selectedUsers.includes(user.id) }">
                                                    <td>
                                                        <input type="checkbox" class="user-select-checkbox" :value="user.id" :checked="selectedUsers.includes(user.id)" @change="toggleUser(user.id)">
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <img :src="user.avatar" class="rounded-circle me-2" width="32" height="32" :alt="user.name" loading="lazy" decoding="async">
                                                            <div>
                                                                <div class="fw-medium" x-text="user.name"></div>
                                                                <small class="text-muted" x-text="'ID: ' + user.id"></small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td x-text="user.email"></td>
                                                    <td>
                                                        <span class="badge" :class="{
                                                                  'bg-danger': user.role === 'admin',
                                                                  'bg-primary': user.role === 'user', 
                                                                  'bg-warning': user.role === 'moderator'
                                                              }" x-text="user.role"></span>
                                                    </td>
                                                    <td>
                                                        <span class="badge" :class="{
                                                                  'bg-success': user.status === 'active',
                                                                  'bg-secondary': user.status === 'inactive',
                                                                  'bg-warning': user.status === 'pending'
                                                              }" x-text="user.status"></span>
                                                    </td>
                                                    <td x-text="user.lastActive"></td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                                <i class="bi bi-three-dots"></i>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li><a class="dropdown-item" href="#" @click="editUser(user)">
                                                                    <i class="bi bi-pencil me-2"></i>Edit
                                                                </a></li>
                                                                <li><a class="dropdown-item" href="#" @click="viewUser(user)">
                                                                    <i class="bi bi-eye me-2"></i>View Profile
                                                                </a></li>
                                                                <li><hr class="dropdown-divider"></li>
                                                                <li><a class="dropdown-item text-danger" href="#" @click="deleteUser(user)">
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
                                        <span x-text="Math.min(currentPage * itemsPerPage, filteredUsers.length)"></span> of 
                                        <span x-text="filteredUsers.length"></span> results
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
                        
                    </div> <!-- End Users Management Container -->

                </div>
            </main>


        </div> <!-- /.admin-wrapper -->
    </div>

    <!-- User Modal (Add/Edit) -->
    <div class="modal fade" id="userModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form x-data="userForm">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" x-model="form.firstName" required="">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" x-model="form.lastName" required="">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" x-model="form.email" required="">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Role</label>
                                <select class="form-select" x-model="form.role" required="">
                                    <option value="">Select Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                    <option value="moderator">Moderator</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <select class="form-select" x-model="form.status" required="">
                                    <option value="">Select Status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="pending">Pending</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Phone</label>
                                <input type="tel" class="form-control" x-model="form.phone">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" @click="saveUser()">Save User</button>
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
                    <h5 class="modal-title">Import Users</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Upload CSV File</label>
                        <input type="file" class="form-control" accept=".csv">
                        <div class="form-text">Upload a CSV file with columns: name, email, role, status</div>
                    </div>
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        <strong>CSV Format:</strong> name, email, role, status<br>
                        <small>Example: John Doe, john@example.com, user, active</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Import Users</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Page-specific Component -->

    <!-- Main App Script -->

<script defer="" src="../../beacon.min.js/v4513226cdae34746b4dedf0b4dfa099e1781791509496-1" integrity="sha512-ZE9pZaUXND66v380QUtch/5sE9tPFh2zg45pR2PB0CVkCtOREv2AJKkSidISWkysEuQ0EH8faUU5du78bx87UQ==" data-cf-beacon='{"version":"2024.11.0","token":"cd0b4b3a733644fc843ef0b185f98241","server_timing":{"name":{"cfCacheStatus":true,"cfEdge":true,"cfExtPri":true,"cfL4":true,"cfOrigin":true,"cfSpeedBrain":true},"location_startswith":null}}' crossorigin="anonymous"></script>
</body>
</head></html> 

<?php
include 'header.php';
?>
        <!-- Main Content -->
        <main id="main-content" class="admin-main">
            <div class="container-fluid p-4 p-lg-4">
                <!-- Page Header -->
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4">
                    <div>
                        <h1 class="h3 mb-0">Dashboard</h1>
                        <p class="text-muted mb-0">Welcome back! Here's what's happening.</p>
                    </div>
                    <div class="d-flex gap-2 flex-shrink-0">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newItemModal" aria-label="New Item">
                            <i class="bi bi-plus-lg me-2" aria-hidden="true"></i>
                            <span class="d-none d-sm-inline">New Item</span>
                        </button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-toggle="tooltip" title="Refresh data">
                            <i class="bi bi-arrow-clockwise icon-hover"></i>
                        </button>
                        <button type="button" class="btn btn-outline-secondary d-none d-sm-inline-block" data-bs-toggle="tooltip" title="Export data">
                            <i class="bi bi-download icon-hover"></i>
                        </button>
                        <button type="button" class="btn btn-outline-secondary d-none d-sm-inline-block" data-bs-toggle="tooltip" title="Settings">
                            <i class="bi bi-gear icon-hover"></i>
                        </button>
                    </div>
                </div>

                <!-- Stats Cards with Alpine.js -->
                <div class="row g-3 g-lg-4 mb-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="card stats-card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="stats-icon bg-primary bg-opacity-10 text-primary">
                                            <i class="bi bi-people"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="h6 mb-0 text-muted">Total Users</p>
                                        <div class="h3 mb-0">12,426</div>
                                        <small class="text-success-emphasis">
                                            <i class="bi bi-arrow-up"></i> +12.5%
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="card stats-card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="stats-icon bg-success bg-opacity-10 text-success">
                                            <i class="bi bi-graph-up"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="h6 mb-0 text-muted">Revenue</p>
                                        <h3 class="mb-0">$54,320</h3>
                                        <small class="text-success-emphasis">
                                            <i class="bi bi-arrow-up"></i> +8.2%
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="card stats-card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="stats-icon bg-warning bg-opacity-10 text-warning">
                                            <i class="bi bi-bag-check"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="h6 mb-0 text-muted">Orders</p>
                                        <h3 class="mb-0">1,852</h3>
                                        <small class="text-danger-emphasis">
                                            <i class="bi bi-arrow-down"></i> -2.1%
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="card stats-card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="stats-icon bg-info bg-opacity-10 text-info">
                                            <i class="bi bi-clock-history"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="h6 mb-0 text-muted">Avg. Response</p>
                                        <h3 class="mb-0">2.3s</h3>
                                        <small class="text-success-emphasis">
                                            <i class="bi bi-arrow-up"></i> +5.4%
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Chart Section -->
                <div class="row g-4 mb-4">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h2 class="h5 card-title mb-0">Revenue Overview</h2>
                                <div class="btn-group btn-group-sm" role="group">
                                    <button type="button" class="btn btn-outline-primary active" data-chart-period="7d">7D</button>
                                    <button type="button" class="btn btn-outline-primary" data-chart-period="30d">30D</button>
                                    <button type="button" class="btn btn-outline-primary" data-chart-period="90d">90D</button>
                                    <button type="button" class="btn btn-outline-primary" data-chart-period="1y">1Y</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="revenueChart" style="min-height: 320px;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="h5 card-title mb-0">Recent Activity</h2>
                            </div>
                            <div class="card-body">
                                <div class="activity-feed">
                                    <div class="activity-item d-flex gap-3 mb-3">
                                        <div class="activity-icon bg-primary bg-opacity-10 text-primary p-2 rounded-3">
                                            <i class="bi bi-person-plus"></i>
                                        </div>
                                        <div class="activity-content">
                                            <p class="mb-1">New user registered</p>
                                            <small class="text-muted">2 minutes ago</small>
                                        </div>
                                    </div>
                                    <div class="activity-item d-flex gap-3 mb-3">
                                        <div class="activity-icon bg-success bg-opacity-10 text-success p-2 rounded-3">
                                            <i class="bi bi-bag-check"></i>
                                        </div>
                                        <div class="activity-content">
                                            <p class="mb-1">Order #1234 completed</p>
                                            <small class="text-muted">5 minutes ago</small>
                                        </div>
                                    </div>
                                    <div class="activity-item d-flex gap-3">
                                        <div class="activity-icon bg-warning bg-opacity-10 text-warning p-2 rounded-3">
                                            <i class="bi bi-exclamation-triangle"></i>
                                        </div>
                                        <div class="activity-content">
                                            <p class="mb-1">Server maintenance scheduled</p>
                                            <small class="text-muted">1 hour ago</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Charts Row -->
                <div class="row g-4 mb-4">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="h5 card-title mb-0">User Growth (Last 7 Days)</h2>
                            </div>
                            <div class="card-body">
                                <div id="userGrowthChart" style="min-height: 280px;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="h5 card-title mb-0">Order Status Distribution</h2>
                            </div>
                            <div class="card-body">
                                <div id="orderStatusChart" style="min-height: 280px;"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Orders & Storage Status -->
                <div class="row g-4 mb-4">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h2 class="h5 card-title mb-0">Recent Orders</h2>
                                <a href="orders.php" class="btn btn-sm btn-outline-primary">View All</a>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Customer</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>#1234</td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <img src="assets/images/avatar-placeholder.svg" alt="Customer" width="28" height="28" class="rounded-circle">
                                                        <span>John Doe</span>
                                                    </div>
                                                </td>
                                                <td>$124.00</td>
                                                <td><span class="order-status status-delivered">Delivered</span></td>
                                                <td>2025-01-15</td>
                                            </tr>
                                            <tr>
                                                <td>#1235</td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <img src="assets/images/avatar-placeholder.svg" alt="Customer" width="28" height="28" class="rounded-circle">
                                                        <span>Jane Smith</span>
                                                    </div>
                                                </td>
                                                <td>$89.99</td>
                                                <td><span class="order-status status-processing">Processing</span></td>
                                                <td>2025-01-15</td>
                                            </tr>
                                            <tr>
                                                <td>#1236</td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <img src="assets/images/avatar-placeholder.svg" alt="Customer" width="28" height="28" class="rounded-circle">
                                                        <span>Mike Johnson</span>
                                                    </div>
                                                </td>
                                                <td>$245.50</td>
                                                <td><span class="order-status status-pending">Pending</span></td>
                                                <td>2025-01-14</td>
                                            </tr>
                                            <tr>
                                                <td>#1237</td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <img src="assets/images/avatar-placeholder.svg" alt="Customer" width="28" height="28" class="rounded-circle">
                                                        <span>Sarah Williams</span>
                                                    </div>
                                                </td>
                                                <td>$399.00</td>
                                                <td><span class="order-status status-shipped">Shipped</span></td>
                                                <td>2025-01-14</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="h5 card-title mb-0">Storage Status</h2>
                            </div>
                            <div class="card-body">
                                <div class="mb-4">
                                    <div class="d-flex justify-content-between mb-1">
                                        <span>Used Storage</span>
                                        <span>45%</span>
                                    </div>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <div class="d-flex justify-content-between mb-1">
                                        <span>Bandwidth</span>
                                        <span>68%</span>
                                    </div>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 68%" aria-valuenow="68" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="d-flex justify-content-between mb-1">
                                        <span>Database</span>
                                        <span>32%</span>
                                    </div>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 32%" aria-valuenow="32" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sales by Location -->
                <div class="row g-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="h5 card-title mb-0">Sales by Location</h2>
                            </div>
                            <div class="card-body">
                                <div id="salesByLocationChart" style="min-height: 350px; width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>

    </div> <!-- /.admin-wrapper -->

    <!-- Toast Container -->
    <div aria-live="polite" aria-atomic="true" class="position-fixed top-0 end-0 p-3" style="z-index: 11">
        <div id="toast-container"></div>
    </div>

    <!-- New Item Modal -->
    <div class="modal fade" id="newItemModal" tabindex="-1" aria-labelledby="newItemModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title" id="newItemModalLabel">
                        <i class="bi bi-plus-circle text-primary me-2"></i>
                        Quick Add
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" x-data="quickAddForm()">
                    <p class="text-muted small mb-4">Create a new item quickly from the dashboard.</p>

                    <!-- Item Type Selection -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">What would you like to add?</label>
                        <div class="btn-group w-100" role="group">
                            <button type="button" class="btn btn-outline-primary btn-sm" :class="{ 'active': itemType === 'task' }" @click="itemType = 'task'">
                                <i class="bi bi-check2-square"></i> Task
                            </button>
                            <button type="button" class="btn btn-outline-success btn-sm" :class="{ 'active': itemType === 'note' }" @click="itemType = 'note'">
                                <i class="bi bi-sticky"></i> Note
                            </button>
                            <button type="button" class="btn btn-outline-info btn-sm" :class="{ 'active': itemType === 'event' }" @click="itemType = 'event'">
                                <i class="bi bi-calendar-event"></i> Event
                            </button>
                            <button type="button" class="btn btn-outline-warning btn-sm" :class="{ 'active': itemType === 'reminder' }" @click="itemType = 'reminder'">
                                <i class="bi bi-bell"></i> Reminder
                            </button>
                        </div>
                    </div>

                    <!-- Title -->
                    <div class="mb-3">
                        <label for="itemTitle" class="form-label fw-semibold">Title</label>
                        <input type="text" class="form-control" id="itemTitle" x-model="title" placeholder="Enter a title...">
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="itemDescription" class="form-label fw-semibold">Description</label>
                        <textarea class="form-control" id="itemDescription" rows="3" x-model="description" placeholder="Add some details..."></textarea>
                    </div>

                    <!-- Priority -->
                    <div class="mb-3" x-show="itemType === 'task'" x-transition>
                        <label class="form-label fw-semibold d-block">Priority</label>
                        <div class="btn-group" role="group">
                            <input type="radio" class="btn-check" name="priorityRadio" id="priorityLow" value="low" x-model="priority" autocomplete="off">
                            <label class="btn btn-outline-success btn-sm" for="priorityLow">
                                <i class="bi bi-flag"></i> Low
                            </label>
                            <input type="radio" class="btn-check" name="priorityRadio" id="priorityMedium" value="medium" x-model="priority" autocomplete="off">
                            <label class="btn btn-outline-warning btn-sm" for="priorityMedium">
                                <i class="bi bi-flag-fill"></i> Medium
                            </label>
                            <input type="radio" class="btn-check" name="priorityRadio" id="priorityHigh" value="high" x-model="priority" autocomplete="off">
                            <label class="btn btn-outline-danger btn-sm" for="priorityHigh">
                                <i class="bi bi-flag-fill"></i> High
                            </label>
                        </div>
                    </div>

                    <!-- Date -->
                    <div class="mb-3" x-show="itemType === 'event' || itemType === 'reminder'" x-transition>
                        <label for="itemDate" class="form-label fw-semibold">Date & Time</label>
                        <input type="datetime-local" class="form-control" id="itemDate" x-model="dateTime">
                    </div>

                    <!-- Assign to -->
                    <div class="mb-3" x-show="itemType === 'task'" x-transition>
                        <label for="assignTo" class="form-label fw-semibold">Assign to</label>
                        <select class="form-select" id="assignTo" x-model="assignee">
                            <option value="">Select team member...</option>
                            <option value="john">John Doe</option>
                            <option value="jane">Jane Smith</option>
                            <option value="mike">Mike Johnson</option>
                            <option value="sarah">Sarah Williams</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" @click="saveItem()" data-bs-dismiss="modal">
                        <i class="bi bi-check-lg me-1"></i> Create Item
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('quickAddForm', () => ({
                itemType: 'task',
                title: '',
                description: '',
                priority: 'medium',
                dateTime: '',
                assignee: '',
                init() {
                    let d = new Date();
                    d.setMinutes(d.getMinutes() - d.getTimezoneOffset());
                    this.dateTime = d.toISOString().slice(0, 16);
                },
                resetForm() {
                    this.itemType = 'task'; this.title = ''; this.description = '';
                    this.priority = 'medium'; this.assignee = '';
                    let d = new Date();
                    d.setMinutes(d.getMinutes() - d.getTimezoneOffset());
                    this.dateTime = d.toISOString().slice(0, 16);
                },
                saveItem() {
                    if (!this.title.trim()) { alert('Please enter a title'); return; }
                    alert('"' + this.title + '" created successfully!');
                    this.resetForm();
                }
            }));
        });
    </script>
</body>
</html>

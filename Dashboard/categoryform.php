<?php
include 'header.php';
include 'connect.php';

// Handle form submission
if(isset($_POST['btn'])){
    $cat_name = mysqli_real_escape_string($con, $_POST['cat_name']);
    $cat_desc = mysqli_real_escape_string($con, $_POST['cat_desc']);
    $sql = "INSERT INTO `category`(`name`, `description`) VALUES ('$cat_name', '$cat_desc')";
    if(mysqli_query($con, $sql)){
        echo "<script>alert('Category added successfully.'); window.location.href='category.php';</script>";
    } else {
        echo "<div class='alert alert-danger m-3'>Error: " . mysqli_error($con) . "</div>";
    }
}
?>

        <!-- Main Content -->
        <main id="main-content" class="admin-main">
            <div class="container-fluid p-4 p-lg-4">
                
                <!-- Page Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h1 class="h3 mb-0">Add New Category</h1>
                        <p class="text-muted mb-0">Create a new product category</p>
                    </div>
                    <div>
                        <a href="category.php" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-2"></i>Back to Categories
                        </a>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-12 col-lg-8">
                        
                        <div class="card shadow-sm border-0 rounded-3">
                            <div class="card-header ogani-card-header text-white py-3">
                                <h5 class="card-title mb-0 fw-semibold">
                                    <i class="bi bi-plus-circle me-2"></i>Category Details
                                </h5>
                            </div>
                            
                            <div class="card-body p-4">
                                <form method="post" class="needs-validation" novalidate>
                                    <div class="row g-4">
                                        
                                        <!-- Category Name -->
                                        <div class="col-12">
                                            <label class="form-label fw-bold text-muted small">Category Name</label>
                                            <input type="text" name="cat_name" class="form-control form-control-lg fs-6" placeholder="Enter category name" required>
                                            <div class="invalid-feedback">Please enter a category name.</div>
                                        </div>
                                        
                                        <!-- Category Description -->
                                        <div class="col-12">
                                            <label class="form-label fw-bold text-muted small">Category Description</label>
                                            <textarea class="form-control form-control-lg fs-6" name="cat_desc" rows="5" placeholder="Enter category description" required></textarea>
                                            <div class="invalid-feedback">Please enter a description.</div>
                                        </div>
                                        
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="mt-4 d-flex gap-2">
                                        <button type="submit" name="btn" class="btn btn-ogani px-4 py-2 fw-semibold">
                                            <i class="bi bi-check-lg me-2"></i>Save Category
                                        </button>
                                        <a href="category.php" class="btn btn-light border px-4 py-2 text-secondary fw-semibold">
                                            <i class="bi bi-x-lg me-2"></i>Cancel
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div> <!-- Card End -->
                        
                    </div>
                </div> <!-- Row End -->

            </div> <!-- Container End -->
        </main>

    </div> <!-- /.admin-wrapper -->

    <!-- Form validation script -->
    <script>
        (function() {
            'use strict';
            var forms = document.querySelectorAll('.needs-validation');
            Array.prototype.slice.call(forms).forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
</body>
</html>

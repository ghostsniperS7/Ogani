<?php
include 'header.php';
include 'connect.php';

// Handle form submission
if(isset($_POST['btn'])){
    $p_name = mysqli_real_escape_string($con, $_POST['p_name']);
    $p_desc = mysqli_real_escape_string($con, $_POST['p_desc']);
    $p_price = mysqli_real_escape_string($con, $_POST['p_price']);
    $p_discount_price = mysqli_real_escape_string($con, $_POST['p_discount_price']);
    $p_category = mysqli_real_escape_string($con, $_POST['p_category']);
    
    // Handle image upload
    $p_image = '';
    if(isset($_FILES['p_image']) && $_FILES['p_image']['error'] === 0) {
        $p_image = time() . '_' . $_FILES['p_image']['name'];
        $temp_image = $_FILES['p_image']['tmp_name'];
        move_uploaded_file($temp_image, "uploads/" . $p_image);
    }
    
    $sql = "INSERT INTO `product`(`p_name`, `p_description`, `p_price`, `p_discount_price`, `p_image`, `c_id`) 
            VALUES ('$p_name', '$p_desc', '$p_price', '$p_discount_price', '$p_image', '$p_category')";
    
    if(mysqli_query($con, $sql)){
        echo "<script>alert('Product added successfully.'); window.location.href='product.php';</script>";
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
                        <h1 class="h3 mb-0">Add New Product</h1>
                        <p class="text-muted mb-0">Create a new product in your catalog</p>
                    </div>
                    <div>
                        <a href="product.php" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-2"></i>Back to Products
                        </a>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-12 col-lg-10">
                        
                        <div class="card shadow-sm border-0 rounded-3">
                            <div class="card-header ogani-card-header text-white py-3">
                                <h5 class="card-title mb-0 fw-semibold">
                                    <i class="bi bi-plus-circle me-2"></i>Product Details
                                </h5>
                            </div>
                            
                            <div class="card-body p-4">
                                <form method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                                    <div class="row g-4">
                                        
                                        <!-- Product Name -->
                                        <div class="col-12">
                                            <label class="form-label fw-bold text-muted small">Product Name</label>
                                            <input type="text" name="p_name" class="form-control form-control-lg fs-6" placeholder="Enter product name" required>
                                            <div class="invalid-feedback">Please enter a product name.</div>
                                        </div>
                                        
                                        <!-- Product Description -->
                                        <div class="col-12">
                                            <label class="form-label fw-bold text-muted small">Product Description</label>
                                            <textarea class="form-control form-control-lg fs-6" name="p_desc" rows="5" placeholder="Enter product description" required></textarea>
                                            <div class="invalid-feedback">Please enter a description.</div>
                                        </div>

                                        <!-- Product Price & Discount -->
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold text-muted small">Price ($)</label>
                                            <input type="number" step="0.01" min="0" name="p_price" class="form-control form-control-lg fs-6" placeholder="0.00" required>
                                            <div class="invalid-feedback">Please enter a valid price.</div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold text-muted small">Discount Price ($)</label>
                                            <input type="number" step="0.01" min="0" name="p_discount_price" class="form-control form-control-lg fs-6" placeholder="0.00">
                                            <small class="text-muted">Leave empty if no discount</small>
                                        </div>
                                        
                                        <!-- Product Image -->
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold text-muted small">Product Image</label>
                                            <input type="file" name="p_image" class="form-control form-control-lg fs-6" accept="image/*">
                                            <small class="text-muted">Upload product image (JPG, PNG, WEBP)</small>
                                        </div>

                                        <!-- Category Selection -->
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold text-muted small">Category</label>
                                            <select name="p_category" class="form-select form-select-lg fs-6" required>
                                                <option value="">Select Category</option>
                                                <?php
                                                    $sql = "SELECT * FROM `category` ORDER BY `name` ASC";
                                                    $result = mysqli_query($con, $sql);
                                                    while($row = mysqli_fetch_assoc($result)){
                                                        echo '<option value="' . $row['id'] . '">' . htmlspecialchars($row['name']) . '</option>';
                                                    }
                                                ?>
                                            </select>
                                            <div class="invalid-feedback">Please select a category.</div>
                                        </div>
                                        
                                    </div> <!-- Row End -->

                                    <!-- Action Buttons -->
                                    <div class="mt-4 d-flex gap-2">
                                        <button type="submit" name="btn" class="btn btn-ogani px-4 py-2 fw-semibold">
                                            <i class="bi bi-check-lg me-2"></i>Save Product
                                        </button>
                                        <a href="product.php" class="btn btn-light border px-4 py-2 text-secondary fw-semibold">
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

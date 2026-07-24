<?php
include 'header.php';
?>

<!-- 'wrapper' class lagana lazmi hai taake sidebar ka JavaScript toggle button active ho sake -->
<div class="wrapper">
    <div class="page-wrapper">
        <!-- padding-top topbar se safe distance rakhegi -->
        <div class="page-content" style="padding-top: 110px !important;">
            <div class="container-fluid">
                
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-11">
                        
                        <div class="card shadow-sm border-0 rounded-3">
                            <div class="card-header text-white py-3" style="background-color: #6366f1;">
                                <h5 class="card-title mb-0 fw-semibold">Add New Product</h5>
                            </div>
                            
                            <div class="card-body p-4">
                                <form method="post" x-data="ProductForm" enctype="multipart/form-data">
                                    <div class="row g-4">
                                        
                                        <!-- Product Name -->
                                        <div class="col-12">
                                            <label class="form-label fw-bold text-muted small">Product Name</label>
                                            <input type="text" name="p_name" class="form-control form-control-lg fs-6" x-model="form.ProductName" placeholder="Enter Product name" required>
                                        </div>
                                        
                                        <!-- Product Description -->
                                        <div class="col-12">
                                            <label class="form-label fw-bold text-muted small">Product Description</label>
                                            <textarea class="form-control form-control-lg fs-6" name="p_desc" x-model="form.ProductDescription" rows="5" placeholder="Enter Product description" required></textarea>
                                        </div>

                                        <!-- Product Price -->
                                        <div class="col-12">
                                            <label class="form-label fw-bold text-muted small">Product Price</label>
                                            <input type="number" name="p_price" class="form-control form-control-lg fs-6" x-model="form.ProductPrice" placeholder="Enter Product price" required>
                                        </div>

                                        <!-- Product Discount Price -->
                                        <div class="col-12">
                                            <label class="form-label fw-bold text-muted small">Product Discount Price</label>
                                            <input type="number" name="p_discount_price" class="form-control form-control-lg fs-6" x-model="form.ProductDiscountPrice" placeholder="Enter Product discount price" required>
                                        </div>

                                        <!-- Product image -->
                                        <div class="col-12">
                                            <label class="form-label fw-bold text-muted small">Product Image</label>
                                            <input type="file" name="p_image" class="form-control form-control-lg fs-6" x-model="form.ProductImage" required>
                                        </div>
                                        
                                        <!-- Category Selection -->
                                        <div class="col-12">
                                            <label class="form-label fw-bold text-muted small">Select Category</label>
                                            <select class="form-select form-select-lg fs-6" name="p_category" required>
                                                <option value="">Select Category</option>
                                                <?php
                                                // Database connection check upar hona chahiye agar $con file me upar define nahi hai
                                                include 'connect.php'; 
                                                $sql = "SELECT * FROM `category`";
                                                $result = mysqli_query($con, $sql);
                                                while($row = mysqli_fetch_assoc($result)){ ?>
                                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        
                                    </div> <!-- Row End (Sahi Jagah Par Band Kiya) -->

                                    <!-- Action Buttons -->
                                    <div class="mt-4 d-flex gap-2">
                                        <button type="submit" name="btn" class="btn text-white px-4 py-2 fw-semibold" style="background-color: #6366f1;" @click="saveProduct()">
                                            Save Product
                                        </button>
                                        <a href="product.php" class="btn btn-light border px-4 py-2 text-secondary fw-semibold">
                                            Cancel
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div> <!-- Card End -->
                        
                    </div>
                </div> <!-- Row End -->

            </div> <!-- Container End -->
        </div> <!-- Page Content End -->
    </div> <!-- Page Wrapper End -->
</div> <!-- Wrapper End -->

<?php
if(isset($_POST['btn'])){
    $p_name = $_POST['p_name'];
    $p_desc = $_POST['p_desc'];
    $p_price = $_POST['p_price'];
    $p_discount_price = $_POST['p_discount_price'];
    $p_category = $_POST['p_category'];
    $p_image = $_FILES['p_image']['name'];
    $temp_image = $_FILES['p_image']['tmp_name'];
    move_uploaded_file($temp_image, "uploads/".$p_image);
    $sql = "INSERT INTO `product`(`p_name`, `p_description`, `p_price`, `p_discount_price`, `p_image`, `c_id`) VALUES ('$p_name', '$p_desc', '$p_price', '$p_discount_price', '$p_image', '$p_category')";
    if(mysqli_query($con, $sql)){
        echo "Product added successfully.";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

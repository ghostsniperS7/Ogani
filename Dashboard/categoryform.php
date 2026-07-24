
<!-- <div class="container">
  <h2>Add Category</h2>
  <form>
    <div class="form-group">
      <label >Category Name</label>
      <input type="text" class="form-control" id="categoryName" placeholder="Enter Category Name">
    </div>
  <div class="form-group">
    <label>Category Description</label>
    <input type="text" class="form-control" placeholder="Enter Category Description">
  </div>
 
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div> -->

    <!-- <div class="modal fade" id="userModal" tabindex="-1">
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
    </div> -->
    
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
                                <h5 class="card-title mb-0 fw-semibold">Add New Category</h5>
                            </div>
                            
                            <div class="card-body p-4">
                                <form method="post" x-data="categoryForm">
                                    <div class="row g-4">
                                        
                                        <!-- Category Name -->
                                        <div class="col-12">
                                            <label class="form-label fw-bold text-muted small">Category Name</label>
                                            <input type="text" name="cat_name" class="form-control form-control-lg fs-6" x-model="form.categoryName" placeholder="Enter category name" required>
                                        </div>
                                        
                                        <!-- Category Description -->
                                        <div class="col-12">
                                            <label class="form-label fw-bold text-muted small">Category Description</label>
                                            <textarea class="form-control form-control-lg fs-6" name="cat_desc" x-model="form.categoryDescription" rows="5" placeholder="Enter category description" required></textarea>
                                        </div>
                                        
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="mt-4 d-flex gap-2">
                                        <button type="submit" name="btn" class="btn text-white px-4 py-2 fw-semibold" style="background-color: #6366f1;" @click="saveCategory()">
                                            Save Category
                                        </button>
                                        <a href="category.php" class="btn btn-light border px-4 py-2 text-secondary fw-semibold">
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
include 'connect.php';
if(isset($_POST['btn'])){
    $cat_name = $_POST['cat_name'];
    $cat_desc = $_POST['cat_desc'];
    $sql = "INSERT INTO `category`(`name`, `description`) VALUES ('$cat_name', '$cat_desc')";
    if(mysqli_query($con, $sql)){
        echo "Category added successfully.";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>
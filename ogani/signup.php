<?php 
include('../dashboard/connect.php'); 

// Signup logic
if(isset($_POST['btn'])){
    $u_name = $_POST['u_name'];
    $u_email = $_POST['u_email'];
    $u_password = $_POST['u_password'];
    $u_confirm_password = $_POST['u_confirm_password'];
    $u_phone = $_POST['u_phone'];
    
    // Check if passwords match
    if($u_password !== $u_confirm_password){
        echo "<script>alert('Passwords do not match!');</script>";
    } else {
        $query = "INSERT INTO `users`(`name`, `email`, `password`, `phone`, `role`) VALUES ('$u_name','$u_email','$u_password','$u_phone','Customer')";
        $execute = mysqli_query($con, $query);
        
        if($execute){
            echo "<script>alert('Account successfully created! Please login.'); window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Error: Could not create account. Email may already exist.');</script>";
        }
    }
}

include 'header.php';
?>
    
    <!-- Signup Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>Sign Up</h4>
                <form action="" method="post">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>Full Name<span>*</span></p>
                                        <input type="text" name="u_name" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" name="u_phone" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="email" name="u_email" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Password<span>*</span></p>
                                        <input type="password" name="u_password" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Confirm Password<span>*</span></p>
                                        <input type="password" name="u_confirm_password" required>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="btn" class="site-btn">Sign Up</button>
                            <p class="mt-3">
                                Already have an account? <a href="login.php"><strong>Login here</strong></a>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Signup Section End -->

<?php
include 'footer.php';
?>


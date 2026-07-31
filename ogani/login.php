<?php 
include('../dashboard/connect.php'); 

$error = "";

// Login Logic
if(isset($_POST['btn'])){
    $u_email = $_POST['u_email'];
    $u_password = $_POST['u_password'];
    
    $query = "SELECT * FROM `users` WHERE `email` = '$u_email' AND `password` = '$u_password'";
    $execute = mysqli_query($con, $query);

    if(mysqli_num_rows($execute) > 0){
        $row = mysqli_fetch_assoc($execute);
        $_SESSION['id'] = $row['id'];
        $_SESSION['name'] = $row['name'] ?? "";
        $_SESSION['role'] = $row['role'] ?? "";
    
        if($_SESSION['role'] == 'admin'){
            echo "<script>window.location.href='../dashboard/index.php'</script>";
        } else {
            echo "<script>window.location.href='index.php'</script>";
        }
    } else {
        $error = "Invalid Email or Password";
    }
}

include 'header.php';

?>

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <h4>Login Details</h4>
            
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa fa-exclamation-circle"></i> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            
            <form action="" method="post">
                <div class="row">
                    <div class="col-lg-8 col-md-6">
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
                        <button type="submit" name="btn" class="site-btn">Log in</button>
                        <div class="mt-3">
                            <a href="signup.php" class="text-success">Don't have an account? Sign up here</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Checkout Section End -->

<?php
include 'footer.php';
?>

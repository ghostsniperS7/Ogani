<?php
session_start();

// Redirect if already logged in
if(isset($_SESSION['name'])){
    if($_SESSION['role'] == 'admin'){
        echo "<script>window.location.href='../dashboard/index.php'</script>";
    } else {
        echo "<script>window.location.href='index.php'</script>";
    }
    exit();
}

include('../dashboard/connect.php'); 

$error = '';

// Login Logic
if(isset($_POST['btn'])){
    $u_email = $_POST['u_email'];
    $u_password = $_POST['u_password'];
    
    $query = "SELECT * FROM `users` WHERE `email` = '$u_email' AND `password` = '$u_password'";
    $execute = mysqli_query($con, $query);

    if(mysqli_num_rows($execute) > 0){
        $row = mysqli_fetch_assoc($execute);
        $_SESSION['id'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['role'] = $row['role'];
    
        if($_SESSION['role'] == 'admin'){
            echo "<script>window.location.href='../dashboard/index.php'</script>";
        } else {
            echo "<script>window.location.href='index.php'</script>";
        }
        exit();
    } else {
        $error = "Invalid email or password. Please try again.";
    }
}

include 'header.php';
?>

<!-- Login Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <h4>Login</h4>
            
            <?php if($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            
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
                        <p class="mt-3">
                            Don't have an account? <a href="signup.php"><strong>Sign up here</strong></a>
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Login Section End -->

<?php
include 'footer.php';
?>


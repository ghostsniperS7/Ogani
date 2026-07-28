<?php 
// 1. Connection file ko sabse upar include kiya taake $con ka error khatam ho
include('../dashboard/connect.php'); 

// 2. Data insert karne ka logic aur alert conditions
if(isset($_POST['btn'])){
    $u_name = $_POST['u_name'];
    
    // Yahan se $_POST ke andar se '$' ka sign hata diya hai
    $u_email = $_POST['u_email'];
    $u_password = $_POST['u_password'];
    $u_phone = $_POST['u_phone'];
    
    $query = "INSERT INTO `users`(`name`, `email`, `password`, `phone`, `role`) VALUES ('$u_name','$u_email','$u_password','$u_phone','Customer')";
    $execute = mysqli_query($con, $query);
    
    if($execute){
        echo "<script>alert('Account successfully created!');</script>";
    } else {
        echo "<script>alert('Error: Data could not be inserted.');</script>";
    }
}

include 'header.php';
?>
    
    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">

            <div class="checkout__form">
                <h4>Signup Details</h4>
                <form action="" method="post">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Name<span>*</span></p>
                                        <input type="text" name="u_name">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" name="u_phone">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text" name="u_email">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Password<span>*</span></p>
                                        <input type="password" name="u_password">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="btn" class="site-btn">Sign in</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
<?php
include 'footer.php';
?>


// include('../dashboard/connect.php');
// if(isset($_POST['btn'])){
//     $u_name = $_POST['u_name'];
//     $u_email = $_POST['$u_email'];
//     $u_password = $_POST['$u_password'];
//     $u_phone = $_POST['$u_phone'];
//     $query = "INSERT INTO `users`(`name`, `email`, `password`, `phone`, `role`) VALUES ('$u_name','$u_email','$u_password','$u_phone','Customer')";
//     $execute = mysqli_query($con, $query);
//     if($execute){

//     }
// }

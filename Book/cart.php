<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
$user_email = $_SESSION['user_email'];

if (!isset($user_id)) {
    header('location:login.php');
}

if (isset($_POST['update_cart'])) {
    $cart_id =$_POST['cart_id'];
    $cart_quantity =$_POST['cart_quality'];    
    mysqli_query($conn , "update `cart` set quality ='$cart_quantity' where id ='$cart_id' ") 
    or die("query failed");
    $message[]='cart quantity updated !';
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn , "delete from `cart` where id ='$delete_id'")
    or die("query failed");
    header('location:cart.php');
}
if (isset($_GET['delete_all'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn , "delete from `cart` where user_id ='$user_id'")
    or die("query failed");
    header('location:cart.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>order</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <?php include 'header.php' ?>


    <div class="heading">
        <h3>orders us</h3>
        <p>
            <a href="home.php">home</a>/orders
        </p>
    </div>

    <section class="shopping-cart">
        <h1 class="title"> products added</h1>
        <div class="box-container">
            <?php
            $grand_total=0;
            $select_cart = mysqli_query($conn ,"select * from `cart` where user_id = '$user_id'") or die("query failed");
            if(mysqli_num_rows($select_cart)>0){
                while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            ?>
            <div class="box">
                <a href="cart.php?delete=<?php echo $fetch_cart['id'];?>" onclick="return confirm('Delete from cart ?')"
                    class="fas fa-times "></a>
                <img src="uploaded_img/<?php echo $fetch_cart['image'];?>" alt="">
                <div class="name">
                    <?php echo $fetch_cart['name'] ; ?>
                </div>
                <div class="price">
                    $<?php echo $fetch_cart['price'] ; ?>/-
                </div>
                <form action="" method="POST">
                    <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id'] ; ?>">
                    <input type="number" min="1" name="cart_quality" value="<?php echo $fetch_cart['quality'] ; ?>">
                    <br> <input type="submit" name="update_cart" value="update" class="option-btn">
                </form>
                <div class="sub-total">sub total :
                    <span>
                        <?php echo $sub_total = ($fetch_cart['quality'] * $fetch_cart['price'] ); ?> /-

                    </span>
                </div>
            </div>
            <?php
            $grand_total += $sub_total;
                }
            }else{
                echo '<p class="empty"> your cart is empty </p>';
            }
            ?>
        </div>

        <div style="margin-top: 2rem; text-align:center ;">
            <a href="cart.php?delete_all" class="delete-btn"
                <?php echo ($grand_total > 1)?'' : 'disabled' ?>onclick="return confirm('delete all from cart ?');">
                delete all</a>
        </div>

        <div class="cart-total">
            <p> grand total : <span>$
                    <?php   echo $grand_total ;?>/-
                </span></p>
            <div class="flex">
                <a href="shop.php" class="btn-con">continue shopping</a>
                <a href="checkout.php" class="btn <?php echo ($grand_total > 1)?'' : 'disabled' ?>">proceed to
                    checkout</a>

            </div>
        </div>
    </section>




    <?php include('footer.php')?>

    <script src="js/script.js"> </script>
</body>

</html>
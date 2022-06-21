<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
$user_email = $_SESSION['user_email'];

if (!isset($user_id)) {
    header('location:login.php');
}
if (isset($_POST['add_to_cart'])) {
    $product_name=$_POST['product_name'];
    $product_image=$_POST['product_image'];
    $product_price=$_POST['product_price'];
    $product_quantity=$_POST['product_quantity'];

    $check_cart_numbers = mysqli_query($conn ,
     "SELECT * FROM `cart` WHERE name= '$product_name' AND user_id='$user_id'") 
    or die('query failed');
    if (mysqli_num_rows($check_cart_numbers) >0) {
        $message[] = 'already added to cart !';
    }else{
        mysqli_query($conn ,
        "INSERT INTO `cart` (user_id,name,price,quality,image) 
        VALUES('$user_id','$product_name','$product_price' ,'$product_quantity','$product_image')")
        or die("query failed ");
        $message[] = 'Product added to cart !';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>shop</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <?php include 'header.php' ?>

    <div class="heading">
        <h3>our shop</h3>
        <p>
            <a href="home.php">home</a>/shop
        </p>
    </div>

    <section class=" products">
        <h1 class="title">latest products</h1>
        <div class="box-container">
            <?php
            $select_products=mysqli_query($conn ," SELECT * FROM `product`")
            or die("query failed");
            if (mysqli_num_rows($select_products)>0) {
                while($fetch_products = mysqli_fetch_assoc($select_products)){
            ?>
            <form action="" method="POST" class="box">
                <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                <div class="name"><?php echo $fetch_products['name']; ?></div>
                <div class="price"><?php echo $fetch_products['price']; ?> /- </div>
                <input class="qty" type="number" min="1" name="product_quantity" value="1">

                <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">

                <input type="submit" name="add_to_cart" class="btn" value="Add To Cart">

            </form>
            <?php
                    }
                }else{
                    echo '<p class="empty"> No product added yets  </p>';
                }
            ?>
        </div>

    </section>





    <?php include('footer.php')?>

    <script src="js/script.js"> </script>
</body>

</html>
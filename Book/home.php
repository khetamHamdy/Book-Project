<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
$user_email = $_SESSION['user_email'];
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
if (!isset($user_id)) {
    header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <?php include 'header.php' ?>

    <section class="home">
        <div class="content">
            <h3>Hand picked Book to your door</h3>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
            <a class="white-btn" href="about.php">discover more </a>
        </div>

    </section>

    <section class=" products">
        <h1 class="title">latest products</h1>
        <div class="box-container">
            <?php
            $select_products=mysqli_query($conn ," SELECT * FROM `product`
            LIMIT 6")
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

        <div class="load-more" style="margin-top: 2rem; text-align:center;">
            <a href="shop.php" class="option-btn">load more</a>
        </div>
    </section>


    <section class="about">
        <div class="flex">
            <div class="image">
                <img src="images/about-img.jpg" alt="">
            </div>
            <div class="content">
                <h3>About us</h3>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                    industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type
                    and scrambled it to make a type specimen book. It has survived not only five centuries, but also the
                    leap into electronic typesetting, remaining essentially unchanged.</p>
                <a href="about.php" class="btn">Read More</a>
            </div>
        </div>
    </section>

    <section class="home-contact">
        <div class="content">
            <h3>Have any questions ?</h3>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap
                into
                electronic typesetting</p>
            <a href="contact.php" class="white-btn">contact us</a>
        </div>
    </section>



    <?php include('footer.php')?>

    <script src="js/script.js"> </script>
</body>

</html>
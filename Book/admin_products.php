<?php
include 'config.php';
session_start();
$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
    header('location:login.php');
};
if (isset($_POST['add_product'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/' . $image;

    $select_product_name = mysqli_query($conn, "SELECT name FROM `product` WHERE name='$name' ") or die('query failed');

    if (mysqli_num_rows($select_product_name) > 0) {
        $message[] = `Product Name Already Added`;
    } else {
        $add_product_query = mysqli_query($conn, "INSERT INTO `product`(name , price,image) 
            VALUES('$name' , '$price' , '$image') ") or die('Query Failed');
        if ($add_product_query) {

            if ($image_size > 2000000) {
                $message[] = 'image size is too Large';
            } else {
                move_uploaded_file($image_tmp_name, $image_folder);
                $message[] = 'Product added successfully !';
            }
        } else {
            $message[] = 'Product could not be added !';
        }
    }
}
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_image_query = mysqli_query(
        $conn,
        "SELECT image FROM `product` WHERE id='$delete_id'"
    )
        or die('query failed');
    $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
    unlink('uploaded_img/' . $fetch_delete_image['image']);
    mysqli_query($conn, "DELETE FROM `product` WHERE id ='$delete_id' ")
        or die('query failed');
    header('location:admin_products.php');
}
if (isset($_POST['update_product'])) {
    $update_p_id = $_POST['update_p_id'];
    $update_name = $_POST['update_name'];
    $update_price = $_POST['update_price'];

    mysqli_query($conn, "UPDATE `product` SET name ='$update_name' , price ='$update_price' WHERE id = '$update_p_id' ")
        or die('query failed');

    $update_image = $_FILES['update_image']['name'];
    $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
    $update_image_size = $_FILES['update_image']['size'];
    $update_folder = 'uploaded_img/' . $update_image;
    $update_old_image = $_POST['update_old_image'];

    if (!empty($update_image)) {
        if ($update_image_size > 2000000) {
            $message[] = 'image file size is too large';
        } else {
            mysqli_query($conn, "UPDATE `product` SET image ='$update_image' WHERE id= '$update_p_id ' ")
                or die('query failed');
            move_uploaded_file($update_image_tmp_name, $update_folder);
            unlink('uploaded_img/' . $update_old_image);
        }
    }
    header('location:admin_products.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Products </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/admin_style.css" rel="stylesheet">
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!--Material -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">

</head>

<body>
    <?php include 'admin_header.php'; ?>

    <!--Product CRUD  Section Start -->
    <section class="add-products">
        <h1 class="title">Shop Products</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <h3>add Product</h3>
            <input type="text" name="name" class="box" placeholder="Enter Product Name : " required />
            <input type="number" min="0" name="price" class="box" placeholder="Enter Product Price : " required />
            <input type="file" name="image" accept="image/jpg , image/jpeg , image/png" class="box" required />
            <input type="submit" value="add product" name="add_product" class="btn" />
        </form>
    </section>
    <!--Product CRUD  Section end -->
    <!-- Show Product-->
    <section class="show-products">
        <h4 class="title">Show Product </h4>
        <div class="box-container">
            <?php
            $selct_products = mysqli_query($conn, "SELECT * FROM `product`")
                or die('query failed');
            if (mysqli_num_rows($selct_products) > 0) {
                while ($fetch_products = mysqli_fetch_assoc($selct_products)) {
            ?>

            <div class="box">
                <img src="uploaded_img/<?php echo $fetch_products['image']; ?>">
                <div class="name"> <?php echo $fetch_products['name']; ?> </div>
                <div class="price"> $<?php echo $fetch_products['price']; ?> /-</div>
                <a href="admin_products.php?update=<?php echo $fetch_products['id']; ?>" class="option-btn">update</a>
                <a href="admin_products.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-btn"
                    onclick="return confirm('Delete This Products ? ');">delete</a>
            </div>

            <?php
                }
            } else {
                echo '<p class="empty"> No Product added yet !</p>';
            }
            ?>
        </div>
    </section>


    <section class="edit-product-form">

        <?php
        if (isset($_GET['update'])) {
            $update_id = $_GET['update'];
            $update_query = mysqli_query($conn, "SELECT * FROM `product` WHERE id = '$update_id'") or die('query failed');
            if (mysqli_num_rows($update_query) > 0) {
                while ($fetch_update = mysqli_fetch_assoc($update_query)) {
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
            <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
            <img src="uploaded_img/<?php echo $fetch_update['image']; ?>" alt="">
            <input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" class="box" required
                placeholder="enter product name">
            <input type="number" name="update_price" value="<?php echo $fetch_update['price']; ?>" min="0" class="box"
                required placeholder="enter product price">
            <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">
            <input type="submit" value="update" name="update_product" class="btn">
            <input type="reset" value="cancel" id="close-update" class="option-btn">
        </form>
        <?php
                }
            }
        } else {
            echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
        }
        ?>

    </section>


    <script src="js/admin_script.js">
    </script>
</body>

</html>
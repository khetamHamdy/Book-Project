<?php
include 'config.php';
session_start();
$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
    header('location:login.php');
}

if (isset($_POST['update_order'])) {
    $order_update_id = $_POST['order_id'];
    $update_payment = $_POST['update_payment'];
    mysqli_query($conn, "UPDATE `orders` SET payment_status= '$update_payment' WHERE id = '$order_update_id'")
        or die('Query Failed');
    $message[] = 'Payment Status Has Been Updated';
}
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `orders` WHERE id= '$delete_id'") or die('query failed');
    header('location:admin_orders.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Orders</title>
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

    <section class="orders">
        <h1 class="title">Placed Orders</h1>
        <div class="box-container">
            <?php
            $select_orders = mysqli_query($conn, "SELECT * FROM `orders`")
                or die('query failed');
            if (mysqli_num_rows($select_orders) > 0) {
                while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
            ?>
            <div class="box">
                <p>user id : <span>
                        <?php echo $fetch_orders['user_id'] ?>
                    </span></p>
                <p> name : <span>
                        <?php echo $fetch_orders['name'] ?>
                    </span></p>
                <p> number : <span>
                        <?php echo $fetch_orders['number'] ?>
                    </span></p>
                <p> email : <span>
                        <?php echo $fetch_orders['email'] ?>
                    </span></p>
                <p> address : <span>
                        <?php echo $fetch_orders['address'] ?>
                    </span></p>
                <p>total_products : <span>
                        <?php echo $fetch_orders['total_products'] ?>
                    </span></p>
                <p>total_price : <span>$
                        <?php echo $fetch_orders['total_price'] ?>/-
                    </span></p>
                <p>placed_on : <span>
                        <?php echo $fetch_orders['placed_on'] ?>
                    </span></p>
                <p>payment Method : <span>
                        <?php echo $fetch_orders['method'] ?>
                    </span></p>
                <form action="" method="post">
                    <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
                    <select name="update_payment">
                        <option value="" selected disabled>
                            <?php echo $fetch_orders['payment_status'] ?>
                        </option>
                        <option value="pending">pending</option>
                        <option value="completed">completed</option>
                    </select>
                    <input type="submit" name="update_order" class="option-btn" value="update">
                    <a href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>"
                        onclick="return confirm('Delete This Order ?')" class="delete-btn"> Delete Order </a>
            </div>
            <?php
                }
            } else {
                echo '<p class="empty"> No Orders Placed Yet !</p>';
            }
            ?>
        </div>

    </section>






    <script src=" js/admin_script.js">
    </script>
</body>

</html>
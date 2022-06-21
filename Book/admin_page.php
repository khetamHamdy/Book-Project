<?php
include 'config.php';
session_start();

$admin_id = $_SESSION['admin_id'];


if (!isset($admin_id)) {
    header('location:login.php');
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Panel</title>
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
    <section class="dashboard">
        <h1 class="title">dashboard</h1>
        <div class="box-container">
            <div class="box">
                <?php
                $total_pending = 0;
                $select_pending = mysqli_query(
                    $conn,
                    "SELECT total_price FROM `orders` WHERE payment_status='pending' "
                )
                    or die("query failed");

                if (mysqli_num_rows($select_pending) > 0) {
                    while ($fetch_pendings = mysqli_fetch_assoc($select_pending)) {
                        $total_price = $fetch_pendings['total_price'];
                        $total_pending += $total_price;
                    };
                };
                ?>
                <h3><?php echo $total_pending; ?></h3>
                <p>Total Pendings</p>


            </div>

            <div class="box">
                <?php
                $total_completed = 0;
                $select_completed = mysqli_query(
                    $conn,
                    "SELECT total_price FROM `orders` WHERE payment_status='completed' "
                )
                    or die("query failed");

                if (mysqli_num_rows($select_completed) > 0) {
                    while ($fetch_completed = mysqli_fetch_assoc($select_completed)) {
                        $total_price = $fetch_completed['total_price'];
                        $total_completed += $total_price;
                    };
                };
                ?>
                <h3><?php echo $total_completed; ?></h3>
                <p>completed payments</p>
            </div>

            <div class="box">
                <?php
                $select_orders = mysqli_query(
                    $conn,
                    "SELECT * FROM `orders` "
                ) or die('query failed ');
                $number_of_orders = mysqli_num_rows($select_orders);
                ?>
                <h3><?php echo $number_of_orders; ?></h3>
                <p>order placed</p>
            </div>

            <div class="box">
                <?php
                $select_product = mysqli_query(
                    $conn,
                    "SELECT * FROM `product` "
                ) or die('query failed ');
                $number_of_product = mysqli_num_rows($select_product);
                ?>
                <h3><?php echo $number_of_product; ?></h3>
                <p>product added</p>
            </div>

            <div class="box">
                <?php
                $select_users = mysqli_query(
                    $conn,
                    "SELECT * FROM `users` WHERE user_type = 'user' "
                ) or die('query failed ');
                $number_of_users = mysqli_num_rows($select_users);
                ?>
                <h3><?php echo $number_of_users; ?></h3>
                <p>normal users</p>
            </div>

            <div class="box">
                <?php
                $select_admin = mysqli_query(
                    $conn,
                    "SELECT * FROM `users` WHERE user_type = 'admin' "
                ) or die('query failed ');
                $number_of_admin = mysqli_num_rows($select_admin);
                ?>
                <h3><?php echo $number_of_admin; ?></h3>
                <p>normal admin</p>
            </div>

            <div class="box">
                <?php
                $select_account = mysqli_query(
                    $conn,
                    "SELECT * FROM `users`"
                ) or die('query failed ');
                $number_of_account = mysqli_num_rows($select_account);
                ?>
                <h3><?php echo $number_of_account; ?></h3>
                <p>Total users </p>
            </div>

            <div class="box">
                <?php
                $select_messages = mysqli_query(
                    $conn,
                    "SELECT * FROM `message`"
                ) or die('query failed ');
                $number_of_messages = mysqli_num_rows($select_messages);
                ?>
                <h3><?php echo $number_of_messages; ?></h3>
                <p>new messages </p>
            </div>

        </div>
    </section>







    <script src="js/admin_script.js">
    </script>
</body>

</html>
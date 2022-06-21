<?php
include 'config.php';
session_start();

$admin_id = $_SESSION['admin_id'];


if (!isset($admin_id)) {
    header('location:login.php');
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `users` WHERE id= '$delete_id'") or die('query failed');
    header('location:admin_users.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>User</title>
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
    <section class="users">
        <h1 class="title">
            user accounts
        </h1>
        <div class="box-container">
            <?php
            $select_users = mysqli_query($conn, "SELECT * FROM `users`")
                or die("query failed");
            while ($fetch_users = mysqli_fetch_assoc($select_users)) {
            ?>
            <div class="box">
                <p> username : <span><?php echo $fetch_users['name']; ?></span>
                </p>
                <p> email : <span><?php echo $fetch_users['email']; ?></span>
                </p>
                <p> user type: <span style="color: <?php if ($fetch_users['user_type'] == 'admin') {
                                                            echo 'var(--orange)';
                                                        } else {
                                                            echo 'var(--red)';
                                                        } ?>">
                        <?php echo $fetch_users['user_type']; ?>
                    </span>
                </p>
                <a href="admin_users.php?delete=<?php echo $fetch_users['id']; ?>"
                    onclick="return confirm('Delete This user ?')" class="delete-btn"> Delete</a>

            </div>
            <?php
            };
            ?>
        </div>

    </section>
    <script src="js/admin_script.js">
    </script>
</body>

</html>
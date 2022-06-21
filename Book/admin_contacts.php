<?php
include 'config.php';
session_start();

$admin_id = $_SESSION['admin_id'];


if (!isset($admin_id)) {
    header('location:login.php');
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `message` WHERE id= '$delete_id'") or die('query failed');
    header('location:admin_contacts.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Message</title>
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

    <section class="messages">
        <h1 class="title"> messages</h1>

        <div class="box-container">
            <?php
            $select_message = mysqli_query($conn, "SELECT * FROM `message`")
                or die("query failed");
            if (mysqli_num_rows($select_message)) {
                while ($fetch_message = mysqli_fetch_assoc($select_message)) {
            ?>
            <div class="box">
                <p> name: <span>
                        <?php echo $fetch_message['name']; ?>
                    </span></p>
                <p> number: <span>
                        <?php echo $fetch_message['number']; ?>
                    </span></p>
                <p> email: <span>
                        <?php echo $fetch_message['email']; ?>
                    </span></p>
                <p> message: <span>
                        <?php echo $fetch_message['message']; ?>
                    </span></p>
                <a href="admin_contacts.php?delete=<?php echo $fetch_message['id']; ?>"
                    onclick="return confirm('Delete This Message ?')" class="delete-btn"> Delete Contact </a>

            </div>
            <?php
                };
            } else {
                echo '<p class="empty"> you have no messages  !</p>';
            }
            ?>
        </div>
    </section>
    <script src="js/admin_script.js">
    </script>
</body>

</html>
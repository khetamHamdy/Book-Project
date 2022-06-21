<?php
if (isset($message)) {
    foreach ($message as $message) {
        echo '
                <div class="message">
                    <span>' . $message . '</span>
                    <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                </div>
                ';
    }
}
?>
<header class="header">
    <div class="flex">
        <a href="admin_page.php" class="logo">Admin<span>Panel</span> </a>
        <nav class="navbar">
            <a href="admin_page.php">home</a>
            <a href="admin_products.php">products</a>
            <a href="admin_orders.php">orders</a>
            <a href="admin_users.php">users</a>
            <a href="admin_contacts.php">messages</a>
        </nav>
        <div class="theme_toggler">
            <span class="material-icons-sharp light">light_mode</span>
            <span class="material-icons-sharp dark">dark_mode</span>
        </div>
        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="user-btn" class="fas fa-user"></div>
        </div>
        <div class="account_box">
            <p>User Name : <br> <span><?php echo  $_SESSION['admin_name']; ?></span></p>
            <p>Email :<br> <span><?php echo $_SESSION['admin_email']; ?></span></p>
            <a href="logout.php" class="delete-btn">Logout</a>
        </div>
    </div>
</header>
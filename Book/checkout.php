<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
$user_email = $_SESSION['user_email'];

if (!isset($user_id)) {
    header('location:login.php');
}

if (isset($_POST['order_btn'])) {
    $name =mysqli_real_escape_string($conn , $_POST['name']);
    $number = $_POST['number'];
    $method =mysqli_real_escape_string($conn , $_POST['method']);

    $email= mysqli_real_escape_string($conn , $_POST['email']);
    $address= mysqli_real_escape_string($conn , 'flat no .'.$_POST['flat'].','.$_POST['street'].', '.$_POST['city'].' , '.$_POST['country'].' - '.$_POST['pin_code']);
    $placed_on =date('d-M-Y');
    
    
    $cart_total=0;
    $carts_products[]='';
    
    $cart_query = mysqli_query($conn , "select * from cart where user_id = '$user_id'") 
    or die('query failed');
    if (mysqli_num_rows($cart_query) >0) {
        while ($cart_items =mysqli_fetch_assoc($cart_query) ) {
            $carts_products[] = $cart_items['name'].'('.$cart_items['quality'].')';
            $sub_total= ($cart_items['price'] * $cart_items['quality']);
            $cart_total += $sub_total;
        }
    }
    $total_products = implode(' , ', $carts_products);
    $order_query = mysqli_query($conn ,
     "select * from orders where name='$name' and number ='$number' and email='$email' and method='$method' and address='$address' and total_products='$total_products' and total_price='$$cart_total'") or die('query failed');
        if ($cart_total ==0) {
            $message[]='your cart is empty';
        }else{
            if (mysqli_num_rows($order_query) > 0) {
                $message[]='order already placed . ';
            }else{
                mysqli_query($conn ,
                 "insert into `orders` (user_id,name,number,email,
                 method,address,total_products,total_price,placed_on)
                 values('$user_id','$name' , '$number' , '$email' ,'$method', 
                 '$address' , '$total_products', '$cart_total' , '$placed_on')
                 ")or die("query failed");
                 $message[]='order placed successfully';
                 mysqli_query($conn,"delete from `cart` where user_id='$user_id'") or die('query failed');
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>checkout</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!- - font awesome cdn link -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <?php include 'header.php' ?>

    <div class="heading">
        <h3>checkout </h3>
        <p>
            <a href="home.php">home</a>/checkout
        </p>
    </div>

    <section class="display-order">

        <?php 
        $grand_total=0;
        $select_cart = mysqli_query($conn , 
        "select * from `cart` where user_id ='$user_id'") or die('query failed .');
        if (mysqli_num_rows($select_cart)>0) {
            while ($fetch_cart= mysqli_fetch_assoc($select_cart)) {
                $total_price= $fetch_cart['price']*$fetch_cart['quality'];
                $grand_total += $total_price; 
                ?>
        <p>
            <?php echo $fetch_cart['name']?>
            <span>(
                <?php echo $fetch_cart['price'].'x'.
                $fetch_cart['quality']?>)
            </span>
        </p>
        <?php
            }}else{
                echo '<p class="empty"> your cart is empty</p>';
            }
        ?>
        <div class="grand-total">
            Grand total
            <span><?php echo $grand_total ;?></span>

            <div>
    </section>

    <section class="checkout">

        <form action="" method="POST">
            <h3>your order </h3>
            <div class="flex">
                <div class="inputBox">
                    <span>your name :</span>
                    <input type="text" name="name" required placeholder="enter your name">
                </div>
                <div class="inputBox">
                    <span>your email :</span>
                    <input type="text" name="email" required placeholder="enter your email">
                </div>

                <div class="inputBox">
                    <span>your number :</span>
                    <input type="number" name="number" required placeholder="enter your number">
                </div>

                <div class="inputBox">
                    <span> Payment Method:</span>
                    <select name="method">
                        <option value="cash on delivery">cash on delivery</option>
                        <option value="credit card">credit card</option>
                        <option value="paypal">paypal</option>
                        <option value="paytm">paytm</option>
                    </select>
                </div>

                <div class="inputBox">
                    <span>address line 01:</span>
                    <input type="number" min="0" name='flat' required placeholder="e.g. flat no.">
                </div>

                <div class="inputBox">
                    <span>address line 01:</span>
                    <input type="text" name='street' required placeholder="e.g. street name.">
                </div>

                <div class="inputBox">
                    <span>city :</span>
                    <input type="text" name='city' required placeholder="e.g. palsatien">
                </div>

                <div class="inputBox">
                    <span>state :</span>
                    <input type="text" name='state' required placeholder="e.g. maharashtra.">
                </div>

                <div class="inputBox">
                    <span>country :</span>
                    <input type="text" name='country' required placeholder="e.g. gaza.">
                </div>

                <div class="inputBox">
                    <span>pin code:</span>
                    <input type="number" min='0' name='pin_code' required placeholder="e.g. 059874512.">
                </div>
            </div>
            <input type="submit" value="order now" class="btn" name='order_btn'>
        </form>

    </section>



    <?php include('footer.php')?>

    <script src="js/script.js"> </script>
</body>

</html>
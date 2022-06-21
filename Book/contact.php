<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
$user_email = $_SESSION['user_email'];

if (!isset($user_id)) {
    header('location:login.php');
}
if (isset($_POST['send'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mesge = mysqli_real_escape_string($conn, $_POST['message']);
    $number=$_POST['number'];
    
    $selectQuery= mysqli_query($conn ,
     "SELECT * FROM `message` WHERE  name='$name' and email ='$email' and number ='$number' and message ='$mesge'") or die("query failed");

    if(mysqli_num_rows($selectQuery)>0){
        
        $message[] ='message sent already !';
    }else{
        mysqli_query($conn , "insert into `message`(user_id , email , number , message , name ) 
        values('$user_id' ,'$email' ,'$number' ,'$mesge' ,'$name') ") or die("query failed ");
        
        $message[] ='message sent successfully !';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>contact</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <?php include 'header.php' ?>

    <div class="heading">
        <h3>contact us</h3>
        <p>
            <a href="home.php">home</a>/contact
        </p>
    </div>

    <section class="contact">
        <form action="" method="POST">
            <h3>say something !</h3>
            <input type="text" name="name" required placeholder="enter your name" class="box">
            <input type="email" name="email" required placeholder="enter your email" class="box">
            <input type="number" name="number" required placeholder="enter your number" class="box">

            <textarea name="message" class="box" placeholder="enter your message" rows="10" cols="30"></textarea>
            <input type="submit" name="send" value="send message" class="btn">

        </form>
    </section>





    <?php include('footer.php')?>

    <script src="js/script.js"> </script>
</body>

</html>
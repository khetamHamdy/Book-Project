<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
$user_email = $_SESSION['user_email'];

if (!isset($user_id)) {
    header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>About</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <?php include 'header.php' ?>

    <div class="heading">
        <h3>About us</h3>
        <p>
            <a href="home.php">home</a>/about
        </p>
    </div>

    <section class="about">
        <div class="flex">
            <div class="image">
                <img src="images/about-img.jpg" alt="">
            </div>
            <div class="content">
                <h3>why choose us? </h3>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                    been
                    the
                    industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                    of
                    type
                    and scrambled it to make a type specimen book. It has survived not only five centuries, but
                    also
                    the
                    leap into electronic typesetting, remaining essentially unchanged.</p>

                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                    been
                    the
                    industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                    of
                    type
                    and scrambled it to make a type specimen book. It has survived not only five centuries, but
                    also
                    the
                    leap into electronic typesetting, remaining essentially unchanged.</p>
                <a href="contact.php" class="btn">contcat us</a>
            </div>
        </div>
    </section>

    <section class="reviews">
        <h1 class="title"> Client's reviews</h1>

        <div class="box-container">
            <div class="box">
                <img src="images/pic-1.png" alt="">
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                </p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h3>john deo</h3>
            </div>

            <div class="box">
                <img src="images/pic-2.png" alt="">
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                </p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>john deo</h3>
            </div>

            <div class="box">
                <img src="images/pic-3.png" alt="">
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                </p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h3>john deo</h3>
            </div>

            <div class="box">
                <img src="images/pic-4.png" alt="">
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                </p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>john deo</h3>
            </div>

            <div class="box">
                <img src="images/pic-5.png" alt="">
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                </p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h3>john </h3>
            </div>

            <div class="box">
                <img src="images/pic-6.png" alt="">
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                </p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>sara </h3>
            </div>

        </div>
    </section>

    <section class="authors">
        <h1 class="title">Greate Authors</h1>
        <div class="box-container">
            <div class="box">
                <img src="images/author-1.jpg" alt="">
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
                <h3>Ahmed</h3>
            </div>

            <div class="box">
                <img src="images/author-2.jpg" alt="">
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
                <h3>sara</h3>
            </div>

            <div class="box">
                <img src="images/author-3.jpg" alt="">
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
                <h3>Ali</h3>
            </div>

            <div class="box">
                <img src="images/author-4.jpg" alt="">
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
                <h3>salam</h3>
            </div>

            <div class="box">
                <img src="images/author-5.jpg" alt="">
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
                <h3>Jok</h3>
            </div>

            <div class="box">
                <img src="images/author-6.jpg" alt="">
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
                <h3>selean</h3>
            </div>


        </div>
    </section>
    <?php include('footer.php')?> <script src="js/script.js">
    </script>
</body>

</html>
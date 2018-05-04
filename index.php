
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet/less" type="text/css" href="assets/css/carousel.less">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.0.2/less.min.js" ></script>
    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">-->

    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <link rel="shortcut icon" href="http://www.pngmart.com/files/1/Sunglasses-Emoji-PNG-Clipart.png" type="image/png" />

    <title>MovieZ</title>

</head>
<body>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>-->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<script src="assets/js/code.js"></script>

<?php
session_start();

//proves if user is logged in
if(!(isset($_SESSION["username"]))) {
    //if no user is logged in the login.php file gets displayed
    include ("assets/layout/login.php");

}
else {
    //if a user is logged in the header and main page get displayed
    include ("assets/layout/header.php");
    include ("assets/layout/main.php");
}

?>

<div class="footer-copyright py-3 text-center">
    © 2018 Copyright
</div>
</body>
</html>

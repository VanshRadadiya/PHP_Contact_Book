<?php
session_start();

include 'Components/_DB_Connection.php';

if (!isset($_SESSION['loggedin'])) {
    header('location:Login.php');
    exit;
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    
    <?php require 'Components/_Navbar.php'; ?>
    <?php require 'Components/_UpdateUser.php'; ?>
    <div class="container my-5">
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Welcome - <?php echo $_SESSION['username'] ?></h4>
            <p>Hey, How are you doing? Welcome to iSecure. You are Logged in as <?php echo $_SESSION['username'] ?></p>
            <hr>
            <p class="mb-0">Whenever you need to, be sure to use Logout you can used this Link -> <a
                    href="/PHP/Login_System/Logout.php">Log-Out</a></p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
    <script>
        document.getElementById('edit').addEventListener('click', function () {
            var myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
            myModal.show();
        });
    </script>
</body>

</html>
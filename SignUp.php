<?php

$alertResult = false;
$alertError = false;
include 'Components/_DB_Connection.php';
if (isset($_POST['save'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    $select_username = "SELECT * FROM users WHERE username = '$username'";
    $exists = mysqli_query($conn, $select_username);

    if (mysqli_num_rows($exists) > 0) {
        $alertError = " Username Already Exists.";
    } else {
        if ($password == $cpassword) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $insert_data = "INSERT INTO users (username,password) VALUES ('$username', '$hash')";
            $result = mysqli_query($conn, $insert_data);

            if ($result) {
                $alertResult = true;
            }
        } else {
            $alertError = "Confirm Password not match to Password.";
        }
    }

}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign-Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php require 'Components/_Navbar.php'; ?>

    <?php if ($alertResult) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success !</strong> User Successfully Added.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>

    <?php if ($alertError) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error !</strong> <?php echo $alertError; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>


    <div class="container my-5">
        <form method="POST" action="" class="d-flex flex-column align-items-center">
            <div class="mb-3 col-6">
                <label for="username" class="form-label">Username</label>
                <input type="text" maxlength="11" class="form-control" id="username" name="username">
            </div>
            <div class="mb-3 col-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" maxlength="23" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3 col-6">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword"
                    aria-describedby="CpasswordHelp">
                <div id="CpasswordHelp" class="form-text">Make sure to type the same password.</div>
                <button type="submit" name="save" class="btn btn-primary my-3">Sign Up</button>
            </div>

        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>

</html>


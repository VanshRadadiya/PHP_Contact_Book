<?php
session_start();

include '_DB_Connection.php';

if (!isset($_SESSION['loggedin'])) {
    header('location:Login.php');
    exit;
}

$user = $_SESSION['username'];

if (isset($_POST['save1'])) {
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $contact = $_POST['contact'];
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['image']['name'];
        $path = "../images/" . $image;
        move_uploaded_file($_FILES['image']['tmp_name'], $path);
    }

    $insert_contact = "INSERT INTO `contact` (`fname`, `mname`, `lname`, `email`, `gender`, `contact`, `image`,`user`) VALUES ('$fname', '$mname', '$lname', '$email', '$gender', '$contact', '$image','$user')";
    mysqli_query($conn, $insert_contact);
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php require '_Navbar.php'; ?>
    <?php require '_UpdateUser.php'; ?>


    <div class="container">
        <h1 class="mt-5 mb-3">Add Contact</h1>
        <form class="row g-3" method="post" enctype="multipart/form-data">
            <div class="col-md-4">
                <label for="inputEmail4" class="form-label">First Name</label>
                <input type="text" name="fname" value="" class="form-control" id="inputEmail4">
            </div>
            <div class="col-md-4">
                <label for="inputEmail4" class="form-label">Middle Name</label>
                <input type="text" name="mname" value="" class="form-control" id="inputEmail4">
            </div>
            <div class="col-md-4">
                <label for="inputEmail4" class="form-label">Last Name</label>
                <input type="text" name="lname" value="" class="form-control" id="inputEmail4">
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Email</label>
                <input type="email" name="email" value="" class="form-control" id="inputEmail4">
            </div>
            <fieldset class="col-md-4">
                <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
                <div class="">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="gridRadios1" value="male">
                        <label class="form-check-label" for="gridRadios1">
                            Male
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="gridRadios2" value="female">
                        <label class="form-check-label" for="gridRadios2">
                            Female
                        </label>
                    </div>
                </div>
            </fieldset>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Contact</label>
                <input type="number" name="contact" value="" class="form-control" id="inputEmail4">
            </div>

            <div class="col-md-4">
                <label for="inputImage" class="form-label">Image</label>
                <input type="file" name="image" value="" class="form-control" id="inputImage">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary" name="save1">Submit</button>
            </div>
        </form>
    </div>


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
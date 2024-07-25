<?php
// session_start();

if (!isset($_SESSION['loggedin'])) {
    header('location:Login.php');
    exit;
}

// include 'Components/_DB_Connection.php'; // Include your database connection
$alertError1 = false;
$alertResult1 = false;
$user = $_SESSION['username'];
$select_update = "SELECT * FROM users WHERE username = '$user'";
$result = mysqli_query($conn, $select_update);
$row = mysqli_fetch_assoc($result);

if (isset($_POST['save'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    $select_username1 = "SELECT * FROM users WHERE username = '$username'";
    $exists1 = mysqli_query($conn, $select_username1);

    if (mysqli_num_rows($exists1) > 0) {
        $alertError1 = " Username Already Exists.";
    } else {
        if ($password === $cpassword) {
            $contact_update = "update contact set user = '$username' where user = '$user'";
            mysqli_query($conn, $contact_update);
            $update = "UPDATE users SET username = '$username', password = '$password' WHERE username = '$user'";
            if (mysqli_query($conn, $update)) {
                $_SESSION['username'] = $username;
                $alertResult1 = "User Updated Successfully";
            } else {
                $alertResult1 = "Error updating record: " . mysqli_error($conn);
            }
        } else {
            $alertError1 = "Passwords do not match.";
        }
    }
}

?>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Username & Password</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="">
                <div class="modal-body">     
                    <div class="mb-3 col-12">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username"
                            value="<?php echo @$row['username']; ?>">
                    </div>
                    <div class="mb-3 col-12">
                        <label for="password" class="form-label">Password</label>
                        <input type="text" class="form-control" id="password" name="password"
                            value="<?php echo @$row['password']; ?>">
                    </div>
                    <div class="mb-3 col-12">
                        <label for="cpassword" class="form-label">Confirm Password</label>
                        <input type="text" class="form-control" id="cpassword" name="cpassword"
                            value="<?php echo @$row['password']; ?>">
                        <div id="CpasswordHelp" class="form-text">Make sure to type the same password.</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="save">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php if ($alertResult1) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success !</strong>  <?php echo $alertResult1; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>

    <?php if ($alertError1) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error !</strong> <?php echo $alertError1; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('location:Login.php');
    exit;
}

include '_DB_Connection.php';

$user = $_SESSION['username'];

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

if (isset($_GET['search_text'])) {
    $search_text = $_GET['search_text'];
} else {
    $search_text = '';
}

$items_per_page = 4;
$start = ($page - 1) * $items_per_page;

if ($search_text) {
    $search_select = "SELECT * FROM contact WHERE user = '$user' AND (mname LIKE '%$search_text%' OR fname LIKE '%$search_text%' OR lname LIKE '%$search_text%') LIMIT $start, $items_per_page";
    $pg_contact = "SELECT * FROM contact WHERE user = '$user' AND (mname LIKE '%$search_text%' OR fname LIKE '%$search_text%' OR lname LIKE '%$search_text%')";
} else {
    $search_select = "SELECT * FROM contact WHERE user = '$user' LIMIT $start, $items_per_page";
    $pg_contact = "SELECT * FROM contact WHERE user = '$user'";
}

$pg_result = mysqli_query($conn, $pg_contact);
$pg_record = mysqli_num_rows($pg_result);
$total_page = ceil($pg_record / $items_per_page);
$result1 = mysqli_query($conn, $search_select);

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
 
</head>

<body>
    <?php require '_Navbar.php'; ?>
    <?php require '_UpdateUser.php'; ?>


    <div class="container">
        <div class="my-5">
            <div class="row">
                <?php while ($row1 = mysqli_fetch_assoc($result1)) { ?>
                    <div class="col-md-3">
                        <div class="card bg-body-tertiary">
                            <div class="row g-0">
                                <div class="col-12">
                                    <img src="../images/<?php echo $row1['image']; ?>" class="object-fit-cover rounded-top"
                                        width="100%" height="200px">
                                </div>
                                <div class="col-12">
                                    <div class="card-body">
                                        <h5 class="card-title text-capitalize"><?php echo $row1['fname']; ?>
                                            <?php echo $row1['mname']; ?>
                                            <?php echo $row1['lname']; ?>
                                        </h5>
                                        <p class="card-text m-0"><?php echo $row1['email']; ?></p>
                                        <p class="card-text mt-1 mb-0 text-capitalize">Gender : <small
                                                class="text-black"><?php echo $row1['gender']; ?></small></p>
                                        <p class="card-text mt-1">Contact : <b
                                                class="text-primary"><?php echo $row1['contact']; ?></b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } ?>
            </div>
        </div>
        <div class="row mx-auto">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                   
                    <li class="page-item <?php if ($page == 1) { echo 'd-none'; } else { echo 'd-block';}?>">
                        <a class="page-link"
                            href="/PHP/Contact_Book/Components/_ViewContact.php?page=1">First</a>
                    </li>
                   
                    <?php if ($page > 1) { ?>
                        <li class="page-item">
                            <a class="page-link"
                                href="/PHP/Contact_Book/Components/_ViewContact.php?page=<?php echo ($page-1); ?>">Previous</a>
                        </li>
                    <?php } ?>
                    <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                        <li class="page-item <?php if ($i == $page) { echo 'active'; } ?>">
                            <a class="page-link" href="/PHP/Contact_Book/Components/_ViewContact.php?page=<?php echo $i; ?>">
                                <?php echo $i; ?>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (($i-1)>$page) { ?>
                    <li class="page-item">
                        <a class="page-link"
                            href="/PHP/Contact_Book/Components/_ViewContact.php?page=<?php echo ($page+1); ?>">Next</a>
                    </li>
                    <?php } ?>
                    <li class="page-item">
                        <a class="page-link <?php if ((mysqli_num_rows($result1) < 1)) { echo 'd-none'; } else { echo 'd-block';}?>" href="/PHP/Contact_Book/Components/_ViewContact.php?page=<?php echo $total_page; ?>">Last</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <scrip src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></scrip>
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
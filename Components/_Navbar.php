<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $loggedin = true;
} else {
    $loggedin = false;
}
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="/PHP/Contact_Book">iContactBook</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/PHP/Contact_Book/Welcome.php">Home</a>
                </li>

                <?php if (!$loggedin) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/PHP/Contact_Book/Login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/PHP/Contact_Book/SignUp.php">Signup</a>
                    </li>
                <?php } ?>

                <?php if ($loggedin) { ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Contact
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/PHP/Contact_Book/Components/_AddContact.php">Add Contact</a>
                            </li>
                            <li><a class="dropdown-item" href="/PHP/Contact_Book/Components/_ViewContact.php">View Contact</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" id="edit">Update-User</button>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/PHP/Contact_Book/Logout.php">Logout</a>
                    </li>
                <?php } ?>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" name="search_text" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" name="search" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
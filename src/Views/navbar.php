<?php 
    $isLoggedIn = true;
    $editMode = $_SESSION['edit_mode'];
    $color = $editMode ? "#6c757d;" : "#36413E;";
?>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: <?= $color ?>">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>


    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <form class="form-inline my-2 my-lg-2">
            <button class="btn btn-secondary mr-sm-2" type="submit"><?= $isLoggedIn ? "Log out" : "Log in" ?></button>
        </form>

        <ul class="navbar-nav ">
            <li class="nav-item">
                <a class="nav-link" href="#">Add new Timeline</a>
            </li>
        </ul>
    </div>
</nav>
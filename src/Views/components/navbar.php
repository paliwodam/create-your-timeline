<?php 
    $isLoggedIn = $_SESSION['userToken'] !== null && $_SESSION['userToken']  !== "";
    $editMode = $_SESSION['edit_mode'];
    $color = $editMode ? "#6c757d;" : "#36413E;";
    include __DIR__ . '/../login.php'; 
    include __DIR__ . '/../logout.php'; 
?>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: <?= $color ?>">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="navbar-brand">Create your timeline</div>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <?php if($isLoggedIn):?>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">Add new timeline</a>
                </li>
            </ul>
        <?php endif;?>
    </div>
    
    <div class="flex-row my-2 my-lg-2 justify-content-start">
        <button class="btn btn-secondary mr-sm-2" data-toggle="modal" data-target="<?=$isLoggedIn ? "#logoutModal" : "#loginModal"?>">
            <?= $isLoggedIn ? "Log out" : "Log in" ?>
        </button>
    </div>
</nav>

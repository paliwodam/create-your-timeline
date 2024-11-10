<?php

$isLoggedIn = $_SESSION['userToken'] !== null && $_SESSION['userToken']  !== "";

if (!isset($_SESSION['edit_mode'])) {
    $_SESSION['edit_mode'] = false; 
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['toggle_mode'])) {
    $_SESSION['edit_mode'] = !$_SESSION['edit_mode'];
}
if(!$isLoggedIn) {
    $_SESSION['edit_mode'] = false;
}

$editMode = $_SESSION['edit_mode'];
$modeClass = $editMode ? 'edit-mode' : 'view-mode';

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <title>Timeline</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/carousel-style.css">
</head>
<body class="<?= $modeClass; ?>">
<?php include __DIR__ . '\components\navbar.php'; ?>
<?php include __DIR__ . '\components\modeToggleBtn.php'; ?>
<?php include __DIR__ . '\addEvent.php'; ?>
<?php include __DIR__ . '\components\carouselNav.php'; ?> 

<div class="container" data-aos="fade-up" data-aos-once="true">
    <h1 class="text-center my-4" data-aos="fade-up" data-aos-once="true"> 
        <?= htmlspecialchars($timeline); ?>
    </h1>

    <div class="timeline" data-aos="fade-up" data-aos-once="true">
        <?php if ($editMode): ?> 
        <div class="d-flex justify-content-center">
            <button type="button" class="btn add-btn" data-toggle="modal" data-target="#addEventModal" >
                <i class="bi bi-plus"></i>
            </button>
        </div>    
        <div></div>
    <?php endif; ?>
    <?php foreach ($events as $event): ?>
        <?php include __DIR__ . '\deleteEvent.php'; ?>
        <div class="timeline-item" data-aos="fade-up">
            <div class="timeline-date">
            <?php if($editMode): ?> 
                <div class="btn-container">
                    <a href="edit_event.php?id=<?= htmlspecialchars($event->id); ?>" class="btn btn-sm btn-secondary float-right ml-2">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <button type="button" class="btn btn-danger btn-sm float-right" data-toggle="modal" data-target="#deleteEventModal<?=$event->id?>">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            <?php endif; ?>
                <div class="date-content">
                    <?php if (!empty($event->end_date)): ?>
                        <div>from: <h2><?= htmlspecialchars($event->start_date); ?></h2></div>
                        <div>to: <h2><?= htmlspecialchars($event->end_date); ?></h2></div>
                    <?php else: ?>
                        <h2><?= htmlspecialchars($event->start_date); ?></h2>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="timeline-content">
                <h3><?= htmlspecialchars($event->name); ?></h3>
                <p><?= htmlspecialchars($event->description); ?></p>
                <?php if (!empty($event->image_path)): ?>
                    <img src="<?= htmlspecialchars($event->image_path); ?>" alt="Event Image">
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
</div>
<script src="assets/js/carousel.js"></script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    AOS.init({
        duration: 1000
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
</body>
</html>
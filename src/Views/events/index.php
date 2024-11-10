<?php
session_start();
if (!isset($_SESSION['edit_mode'])) {
    $_SESSION['edit_mode'] = false; 
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['toggle_mode'])) {
    $_SESSION['edit_mode'] = !$_SESSION['edit_mode'];
}

$editMode = $_SESSION['edit_mode'];
$modeClass = $editMode ? 'edit-mode' : 'view-mode';
$iconClass = $editMode ? 'bi-eye' : 'bi-pencil';
$isLoggedIn = true;
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
    <link rel="stylesheet" href="public/assets/css/style.css">
</head>
<body class="<?= $modeClass; ?>">
<?php include __DIR__ . '/../navbar.php'; ?>

<div class="d-flex flex-row-reverse justify-content-between settings">
    <form method="POST">
        <?php if (!$isLoggedIn): ?>
            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" data-placement="left" title="Editing is only available for logged-in users">
                <button type="submit" name="toggle_mode" class="mode-toggle-btn" disabled=<?=(!$isLoggedIn)?>>
                    <i class="bi <?= $iconClass; ?>"></i>
                </button>
            </span>
        <?php else: ?>
            <button name="toggle_mode" class="mode-toggle-btn" type="submit" >
                <i class="bi <?= $iconClass; ?>"></i>
            </button>
        <?php endif; ?>
    </form>
</div>

<?php include __DIR__ . '/modal_add_event.php'; ?>

<?php if(!$editMode): ?>
    <div class="carousel-nav">
        <?php if ($previousCategoryId): ?>
            <a href="/create-your-timeline/public/index.php?action=category&id=<?= $previousCategoryId; ?>" class="carousel-arrow left-arrow">&larr;</a>
        <?php endif; ?>
        <?php if ($nextCategoryId): ?>
            <a href="/create-your-timeline/public/index.php?action=category&id=<?= $nextCategoryId; ?>" class="carousel-arrow right-arrow">&rarr;</a>
        <?php endif; ?>
    </div>
<?php endif; ?>

<div class="container">
    <h1 class="text-center my-4" data-aos="fade-up" data-aos-once="true"> 
        <?= htmlspecialchars($categoryName); ?>
    </h1>

    <div class="timeline" data-aos="fade-up" data-aos-once="true">
        <?php if ($editMode): ?> 
        <div class="d-flex justify-content-center">
            <button type="button" class="btn add-btn" data-toggle="modal" data-target="#addEventModal" data-aos="fade-up" data-aos-once="true">
                <i class="bi bi-plus"></i>
            </button>
        </div>    
        <div></div>
    <?php endif; ?>
    <?php foreach ($events as $event): ?>
        <div class="timeline-item" data-aos="fade-up">
            <div class="timeline-date">
            <?php if($editMode): ?> 
                <div class="btn-container">
                    <button type="button" class="btn btn-danger btn-sm float-right ml-2" onclick="confirmDelete(<?= htmlspecialchars($event['id']); ?>)">
                        <i class="bi bi-trash"></i>
                    </button>
                    <a href="edit_event.php?id=<?= htmlspecialchars($event['id']); ?>" class="btn btn-sm btn-secondary float-right">
                        <i class="bi bi-pencil"></i>
                    </a>
                </div>
            <?php endif; ?>
                <div class="date-content">
                    <?php if (!empty($event['end_date'])): ?>
                        <div>from: <h2><?= htmlspecialchars($event['start_date']); ?></h2></div>
                        <div>to: <h2><?= htmlspecialchars($event['end_date']); ?></h2></div>
                    <?php else: ?>
                        <h2><?= htmlspecialchars($event['start_date']); ?></h2>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="timeline-content">
                <h3><?= htmlspecialchars($event['name']); ?></h3>
                <p><?= htmlspecialchars($event['description']); ?></p>
                <?php if (!empty($event['image_path'])): ?>
                    <img src="<?= htmlspecialchars($event['image_path']); ?>" alt="Event Image">
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
</div>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 1000
    });
</script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const leftArrow = document.querySelector('.left-arrow');
        const rightArrow = document.querySelector('.right-arrow');
        const timeline = document.querySelector('.container');

        if (leftArrow) {
            leftArrow.addEventListener('click', function(event) {
                event.preventDefault();
                timeline.classList.add('slide-left');
                setTimeout(() => {
                    window.location.href = leftArrow.href;
                }, 500);
            });
        }

        if (rightArrow) {
            rightArrow.addEventListener('click', function(event) {
                event.preventDefault();
                timeline.classList.add('slide-right');
                setTimeout(() => {
                    window.location.href = rightArrow.href;
                }, 500);
            });
        }
    });
</script>
</body>
</html>
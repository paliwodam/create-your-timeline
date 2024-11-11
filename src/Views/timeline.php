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
    <link rel="stylesheet" href="assets/css/edit-mode.css">
    <link rel="stylesheet" href="assets/css/carousel-style.css">
    <link rel="stylesheet" href="assets/css/small-screen.css">
    <link rel="stylesheet" href="assets/css/print.css">
</head>
<body class="<?= $modeClass; ?>">
<?php include __DIR__ . '/components/navbar.php'; ?>
<?php include __DIR__ . '/components/modeToggleBtn.php'; ?>
<?php include __DIR__ . '/components/carouselNav.php'; ?> 

<div class="container" data-aos="fade-up" data-aos-once="true">
    <?php if(isset($_SESSION["failedLogin"]) && $_SESSION["failedLogin"]): ?>
        <div class="alert alert-danger dismissible fade show m-4" role="alert">
            Failed to log in. Try again
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php $_SESSION["failedLogin"]=false; ?>
    <?php endif; ?>


    <h1 class="text-center headline my-4" data-aos="fade-up" data-aos-once="true"> 
        <?= htmlspecialchars($timeline); ?>
    </h1>

    <div class="timeline" data-aos="fade-up" data-aos-once="true">
        <?php if ($editMode): ?> 
        <div class="d-flex justify-content-center">
            <button type="button" class="btn round-btn add-btn" data-toggle="modal" data-target="#addEventModal" >
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
                    <a href="edit_event.php?id=<?= htmlspecialchars($event->id); ?>" class="btn btn-sm btn-secondary float-right ml-2">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <button type="button" 
                        class="btn btn-danger btn-sm delete-event-btn" 
                        data-toggle="modal" 
                        data-target="#deleteEventModal"
                        data-event-id="<?= $event->id; ?>" 
                        data-event-name="<?= htmlspecialchars($event->name); ?>"
                        data-timeline-id="<?= $event->timeline_id; ?>">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
                <?php endif; ?>
                <div class="date-content">
                    <?php if (!empty($event->end_date)): ?>
                        <div>from: <h2 class="date-text"><?= htmlspecialchars($event->start_date); ?></h2></div>
                        <div>to: <h2 class="date-text"><?= htmlspecialchars($event->end_date); ?></h2></div>
                    <?php else: ?>
                        <h2 class="date-text"><?= htmlspecialchars($event->start_date); ?></h2>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="timeline-content clickable"
            data-toggle="modal" 
            data-target="#eventModal" 
            data-title="<?= htmlspecialchars($event->name); ?>" 
            data-shortdesc="<?= htmlspecialchars($event->short_description); ?>" 
            data-longdesc="<?= htmlspecialchars($event->description); ?>" 
            data-img="<?= htmlspecialchars($event->image_path); ?>">
                <?php if(!$editMode): ?>
                    <div class="expand-container">
                        <p class="float-right ml-2">
                            <i class="bi bi-arrows-angle-expand"></i>
                        </p>
                    </div>
                <?php endif;?>
                <h3><?= htmlspecialchars($event->name); ?></h3>
                <p><?= htmlspecialchars($event->short_description); ?></p>
                <?php if (!empty($event->image_path)): ?>
                    <img src="<?= htmlspecialchars($event->image_path); ?>" alt="Event Image">
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
</div>
<?php include __DIR__ . '/eventDetails.php'; ?>
<?php include __DIR__ . '/deleteEvent.php'; ?>
<?php include __DIR__ . '/addEvent.php'; ?>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    AOS.init({
        duration: 1000
    });

    $(function () {
        <?php if (!$isLoggedIn): ?>
            $('[data-toggle="tooltip"]').tooltip()
        <?php endif; ?>
    })

    
    document.addEventListener("DOMContentLoaded", function() {
        $('.timeline-content.clickable').on('click', function() {
            const title = $(this).data('title');
            const shortDesc = $(this).data('shortdesc');
            const longDesc = $(this).data('longdesc');
            const imgPath = $(this).data('img');

            $('#eventModalLabel').text(title);
            $('#eventShortDesc').text(shortDesc);
            $('#eventLongDesc').text(longDesc);
            
            if (imgPath) {
                console.log(imgPath);
                $('#eventImage').attr('src', "../" + imgPath).show();
            } else {
                $('#eventImage').hide();
            }

            $('#eventModal').modal('show');
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        $('.delete-event-btn').on('click', function() {
            const eventId = $(this).data('event-id');
            const eventName = $(this).data('event-name');
            const timelineId = $(this).data('timeline-id');

            $('#eventName').text(eventName);
            $('#deleteEventForm').attr('action', `/timeline/event/delete?id=${eventId}&timelineId=${timelineId}`);

            $('#deleteEventModal').modal('show');
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        const leftArrow = document.querySelector('.left-arrow');
        const rightArrow = document.querySelector('.right-arrow');
        const timeline = document.querySelector('.container');

        if (leftArrow) {
            leftArrow.addEventListener('click', function(event) {
                event.preventDefault();
                timeline.classList.add('slide-right');
                setTimeout(() => {
                    window.location.href = leftArrow.href;
                }, 500);
            });
        }

        if (rightArrow) {
            rightArrow.addEventListener('click', function(event) {
                event.preventDefault();
                timeline.classList.add('slide-left');
                setTimeout(() => {
                    window.location.href = rightArrow.href;
                }, 500);
            });
        }
    });
</script>
</body>
</html>

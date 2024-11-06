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
</head>
<body>
<!-- 'C:\xampp\htdocs\create-your-timeline\src\views\header.php
'C:\xampp\htdocs\create-your-timeline\src\views\events/src/views/header.php -->
<?php include __DIR__ . '/../header.php'; ?>

<div class="carousel-nav">
    <?php if ($previousCategoryId): ?>
        <a href="/create-your-timeline/public/index.php?action=category&id=<?= $previousCategoryId; ?>" class="carousel-arrow left-arrow">&larr;</a>
    <?php endif; ?>
    <?php if ($nextCategoryId): ?>
        <a href="/create-your-timeline/public/index.php?action=category&id=<?= $nextCategoryId; ?>" class="carousel-arrow right-arrow">&rarr;</a>
    <?php endif; ?>
</div>

<div class="container">
    <h1 class="text-center my-5" data-aos="fade-up" data-aos-once="true"> 
        <?= htmlspecialchars($categoryName); ?>
    </h1>
    <div class="timeline" data-aos="fade-up" data-aos-once="true">
    <?php foreach ($events as $event): ?>
        <div class="timeline-item" data-aos="fade-up">
            <div class="timeline-date">
            <?php if (!empty($event['end_date'])): ?>
                from:<h2><?= htmlspecialchars($event['start_date']); ?></h2>
                to:<h2> <?= htmlspecialchars($event['end_date']); ?></h2>
            <?php else: ?>
               <h2><?= htmlspecialchars($event['start_date']); ?></h2>
            <?php endif; ?>
            </div>
            
            <div class="timeline-content">
                <!-- <button type="button" class="btn btn-danger btn-sm float-right ml-2" onclick="confirmDelete(<?= htmlspecialchars($event['id']); ?>)">
                    <i class="bi bi-trash"></i>
                </button>
                <a href="edit_event.php?id=<?= htmlspecialchars($event['id']); ?>" class="btn btn-sm btn-secondary float-right">
                    <i class="bi bi-pencil"></i>
                </a> -->
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const leftArrow = document.querySelector('.left-arrow');
        const rightArrow = document.querySelector('.right-arrow');
        const timeline = document.querySelector('.container');

        if (leftArrow) {
            leftArrow.addEventListener('click', function(event) {
                event.preventDefault();
                timeline.classList.add('slide-left'); // Dodaj klasę animacji

                // Opóźnij przekierowanie, aby animacja miała czas na wykonanie
                setTimeout(() => {
                    window.location.href = leftArrow.href;
                }, 500); // Czas dopasowany do długości animacji slide-left
            });
        }

        if (rightArrow) {
            rightArrow.addEventListener('click', function(event) {
                event.preventDefault();
                timeline.classList.add('slide-right'); // Dodaj klasę animacji

                // Opóźnij przekierowanie, aby animacja miała czas na wykonanie
                setTimeout(() => {
                    window.location.href = rightArrow.href;
                }, 500); // Czas dopasowany do długości animacji slide-right
            });
        }
    });
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
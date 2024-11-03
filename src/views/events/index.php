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
<div class="container">
    <h1 class="text-center my-5">Your timeline</h1>
    <div class="timeline">
        <?php foreach ($events as $event): ?>
            <div class="timeline-item" data-aos="fade-up" data-aos-duration="1000">
                <div class="timeline-content">
                    <button type="button" class="btn btn-danger btn-sm float-right  ml-2" onclick="confirmDelete(<?= htmlspecialchars($event['id']); ?>)">
                        <i class="bi bi-trash"></i>
                    </button>
                    <a href="edit_event.php?id=<?= htmlspecialchars($event['id']); ?>" class="btn btn-sm btn-secondary float-right">
                        <i class="bi bi-pencil"></i> <!-- Ikona edycji -->
                    </a>
                    <h3><?= htmlspecialchars($event['name']); ?></h3>
                    <p><?= htmlspecialchars($event['description']); ?></p>
                    <?php if (!empty($event['image_path'])): ?>
                        <img src="<?= htmlspecialchars($event['image_path']); ?>" class="img-fluid mb-3">
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
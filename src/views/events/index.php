<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <h1>Your timeline</h1>
    <div class="timeline">
        <?php foreach ($events as $event): ?>
            <div class="event">
                <h3><?= htmlspecialchars($event['name']); ?></h3>
                <p><?= htmlspecialchars($event['description']); ?></p>
                <p><?= htmlspecialchars($event['start_date']); ?> - <?= htmlspecialchars($event['end_date']); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Pamiętnik Firmowy - Wydarzenia (Druk)</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/print.css" media="print">
    <style>
        /* Możesz dodać dodatkowe style do druku tutaj */
        @media print {
            body {
                font-size: 12pt;
                line-height: 1.5;
            }
            .timeline {
                display: block;
            }
            .event {
                page-break-inside: avoid;
                margin-bottom: 20px;
                border: 1px solid #000;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <h1>Wydarzenia</h1>
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

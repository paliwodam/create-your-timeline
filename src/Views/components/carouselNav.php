<?php if(!$editMode): ?>
    <div class="carousel-nav">
        <?php if ($previousTimelineId): ?>
            <a href="/timeline?id=<?= $previousTimelineId; ?>" class="carousel-arrow left-arrow">&larr;</a>
        <?php endif; ?>
        <?php if ($nextTimelineId): ?>
            <a href="/timeline?id=<?= $nextTimelineId; ?>" class="carousel-arrow right-arrow">&rarr;</a>
        <?php endif; ?>
    </div>
<?php endif; ?>
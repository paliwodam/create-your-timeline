<?php 
    $prevUrl = "/timeline?id=$previousTimelineId";
    $nextUrl = "/timeline?id=$nextTimelineId";
?>
<?php if(!$editMode): ?>
    <div class="carousel-nav">
        <?php if ($previousTimelineId): ?>
            <a href="<?= $prevUrl ?>" class="carousel-arrow left-arrow">&larr;</a>
        <?php endif; ?>
        <?php if ($nextTimelineId): ?>
            <a href="<?= $nextUrl ?>" class="carousel-arrow right-arrow">&rarr;</a>
        <?php endif; ?>
    </div>
<?php endif; ?>
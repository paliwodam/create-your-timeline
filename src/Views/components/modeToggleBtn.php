<?php
$isLoggedIn = $_SESSION['userToken'] !== null && $_SESSION['userToken']  !== "";
$iconClass = $editMode ? 'bi-eye' : 'bi-pencil';
?>

<div class="d-flex flex-row-reverse justify-content-between settings">
    <form method="POST">
        <?php if (!$isLoggedIn): ?>
            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" data-placement="left" title="Editing is only available for logged-in users">
                <button class="mode-toggle-btn round-btn"  type="submit" name="toggle_mode" disabled=<?=!$isLoggedIn?>>
                    <i class="bi <?= $iconClass; ?>"></i>
                </button>
            </span>
        <?php else: ?>
            <button class="mode-toggle-btn round-btn" name="toggle_mode" type="submit" >
                <i class="bi <?= $iconClass; ?>"></i>
            </button>
        <?php endif; ?>
    </form>
</div>

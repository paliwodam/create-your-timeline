<?php
$isLoggedIn = $_SESSION['userToken'] !== null && $_SESSION['userToken']  !== "";
$iconClass = $editMode ? 'bi-eye' : 'bi-pencil';
?>

<div class="d-flex flex-row-reverse justify-content-between settings">
    <form method="POST">
        <?php if (!$isLoggedIn): ?>
            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" data-placement="left" title="Editing is only available for logged-in users">
                <button type="submit" name="toggle_mode" class="mode-toggle-btn" disabled=<?=!$isLoggedIn?>>
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

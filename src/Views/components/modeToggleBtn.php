<?php
$isLoggedIn = $_SESSION['userToken'] !== null && $_SESSION['userToken']  !== "";
$iconClass = $editMode ? 'bi-eye' : 'bi-pencil';
?>

<div class="d-flex flex-row-reverse justify-content-between settings">
    <form method="POST">
            <span class="d-inline-block" tabindex="0" <?php if(!$isLoggedIn):?>data-toggle="tooltip" data-placement="bottom" title="Editing is only available for logged-in users"<?php endif;?>>
                <button class="mode-toggle-btn round-btn"  type="submit" name="toggle_mode" <?php if(!$isLoggedIn):?>disabled<?php endif;?>>
                    <i class="bi <?= $iconClass; ?>"></i>
                </button>
            </span>
    </form>
    <form>
        <?php if($editMode):?> 
            <button class="btn-danger round-btn" name="toggle_mode" type="submit" data-aos="fade-up" data-aos-once="true">
                <i class="bi bi-trash"></i>
            </button>
        <?php endif;?>
    </form>
</div>

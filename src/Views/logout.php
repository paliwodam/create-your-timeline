<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addEventModalLabel">Logout</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/logout" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          Are you sure you want to logout?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Logout</button>
        </div>
        <input type="hidden" name="timeline_id" value="<?= $timelineId ?? "null"?>"> 
      </form>
    </div>
  </div>
</div>
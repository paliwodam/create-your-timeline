
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="color: #36413E;">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #36413E;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="loginForm" action="/login" method="POST">
          <div class="form-group">
            <label for="username" style="color: #36413E;">Username</label>
            <input type="text" class="form-control" id="username" name="username" required placeholder="Enter your username" style="background-color: #D7D6D6; color: #36413E;">
          </div>
          <div class="form-group">
            <label for="password" style="color: #36413E;">Password</label>
            <input type="password" class="form-control" id="password" name="password" required placeholder="Enter your password" style="background-color: #D7D6D6; color: #36413E;">
          </div>
          <input type="hidden" name="timeline_id" value="<?= $timelineId ?? "null"?>"> 
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn" data-dismiss="modal" style="background-color: #D7D6D6; color: #36413E;">Cancel</button>
        <button type="submit" class="btn" form="loginForm" style="background-color: #36413E; color: #D7D6D6; border: 1px solid #D7D6D6;">Login</button>
      </div>
    </div>
  </div>
</div>
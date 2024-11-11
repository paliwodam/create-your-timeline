<div class="modal fade" id="deleteEventModal<?=$event->id?>" tabindex="-1" role="dialog" aria-labelledby="deleteEventModaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addEventModalLabel">Delete event</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/timeline/event/delete?id=<?=$event->id?>&timelineId=<?=$event->timeline_id?>" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          Are you sure want to delete event '<strong><?=$event->name?></strong>'?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete event</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div></div>
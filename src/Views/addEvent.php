<div class="modal fade" id="addEventModal" tabindex="-1" role="dialog" aria-labelledby="addEventModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content px-4">
      <div class="modal-header">
        <h5 class="modal-title" id="addEventModalLabel">Add an event</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/timeline/event/add?timelineId=1" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label for="eventName">Name of an event</label>
            <input type="text" class="form-control" id="eventName" name="name" required placeholder="Enter the name for the event">
          </div>

          <div class="form-group">
            <label for="eventShortDescription">Short description</label>
            <input type="text" class="form-control" id="eventShortDescription" name="short_description" required placeholder="Few words to summarize the event">
          </div>
          
          <div class="form-group">
            <label for="eventDescription">Description</label>
            <textarea class="form-control" id="eventDescription" name="description" rows="3" required placeholder="Provide some details"></textarea>
          </div>
          
          <div class="form-group">
            <label for="startDate">Start date</label>
            <input type="date" class="form-control" id="startDate" name="start_date" required>
          </div>
          
          <div class="form-group">
            <label for="endDate">End date (optional)</label>
            <input type="date" class="form-control" id="endDate" name="end_date">
          </div>

          <div class="form-group">
            <label for="eventImage">Add photo</label>
            <input type="file" class="form-control-file" id="eventImage" name="image">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add event</button>
        </div>
      </form>
    </div>
  </div>
</div>

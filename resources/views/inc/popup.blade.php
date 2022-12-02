<div class="popupLayout p-3 text-center w-50">
    <div class="header">
        <h2 class="date"></h2>
        <h4 class="details"></h4>
    </div>
    <hr>
    <div class="details d-flex flex-wrap">
        <div class="px-2 col-lg-8 col-md-6">
            <div class="hours"></div>
        </div>
        <div class="clientDetails col-lg-4 col-md-6">
            <label>Full Name</label>
            <input class="form-control name" type="text" name="" id="" required>
            <label>Email</label>
            <input class="form-control email" type="email" name="" id="" required>
            <label>Interval</label>
            <input class="form-control interval" type="text" disabled name="" id="" required>
        </div>
    </div>
    <hr>
    <div class="action">
        <button class="saveButton btn btn-success" onClick="calendarHandler.sendData(this)">Schedules</button>
        <button class="closePopup btn btn-danger">Close</button>
    </div>
</div>

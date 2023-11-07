<table class="table table-striped" id="watering_scheduleTable">
    <thead>
        <tr>
            <th>Plant</th>
            <th>Date</th>
            <th>Time</th>
            <th>Status</th>
            <th class="w-50">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datatable as $watering_schedule)
        <tr>
            <td>{{ $watering_schedule['name'] }}</td>
            <td>{{ date('m/d/Y', strtotime($watering_schedule['date'])) }}</td>
            <td>{{ date('h:i:s A', strtotime($watering_schedule['time'])) }}</td>
            <td>
                @if($watering_schedule['status'] == 1)
                    <div class="form-check form-switch">
                        <input class="form-check-input status-switch" type="checkbox" data-id="{{ $watering_schedule['id'] }}" id="flexSwitchCheckChecked" checked>
                        <label class="form-check-label text-success" for="flexSwitchCheckChecked"><span class="fa fa-check-circle"></span> Completed</label>
                    </div>
                @else 
                    <div class="form-check form-switch">
                        <input class="form-check-input status-switch" data-id="{{ $watering_schedule['id'] }}" type="checkbox" id="flexSwitchCheckChecked">
                        <label class="form-check-label text-warning" for="flexSwitchCheckChecked"><span class="fa fa-spinner"></span> Inprogress</label>
                    </div>
                @endif
            </td>
            <td>
                <a type="button" class="btn btn-warning btn-sm edit-btn text-white" data-watering_schedule="{{ base64_encode(json_encode($watering_schedule)) }}" data-id="{{ $watering_schedule['id'] }}" data-name="{{ $watering_schedule['name'] }}" data-bs-toggle="modal" data-bs-target="#editWateringSchedule"><span class="fa fa-edit"></span> Edit</a>
                <a type="button" class="btn btn-danger btn-sm delete-btn text-white" data-id="{{ $watering_schedule['id'] }}"><span class="fa fa-edit"></span> Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script type="text/javascript">
    $(document).ready(function() {
        initializeTable();
    });
    function initializeTable() {
        let dataTable = new simpleDatatables.DataTable(
            document.getElementById("watering_scheduleTable")
        );
    }
</script>
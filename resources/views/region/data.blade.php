<table class="table table-striped" id="regionTable">
    <thead>
        <tr>
            <th>Barangay</th>
            <th>Name</th>
            <th class="w-50">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datatable as $region)
        <tr>
            <td>{{ $region['barangay'] }}</td>
            <td>{{ $region['name'] }}</td>
            <td>
                <a type="button" class="btn btn-warning btn-sm edit-btn text-white" data-id="{{ $region['id'] }}" data-name="{{ $region['name'] }}" data-barangay_id="{{ $region['barangay_id'] }}" data-bs-toggle="modal" data-bs-target="#editRegion"><span class="fa fa-edit"></span> Edit</a>
                <a type="button" class="btn btn-danger btn-sm delete-btn text-white" data-id="{{ $region['id'] }}"><span class="fa fa-edit"></span> Delete</a>
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
            document.getElementById("regionTable")
        );
    }
</script>
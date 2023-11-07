<table class="table table-striped" id="barangayTable">
    <thead>
        <tr>
            <th>Street</th>
            <th>Name</th>
            <th class="w-50">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datatable as $barangay)
        <tr>
            <td>{{ $barangay['street'] }}</td>
            <td>{{ $barangay['name'] }}</td>
            <td>
                <a type="button" class="btn btn-warning btn-sm edit-btn text-white" data-id="{{ $barangay['id'] }}" data-name="{{ $barangay['name'] }}" data-street_id="{{ $barangay['street_id'] }}" data-bs-toggle="modal" data-bs-target="#editBarangay"><span class="fa fa-edit"></span> Edit</a>
                <a type="button" class="btn btn-danger btn-sm delete-btn text-white" data-id="{{ $barangay['id'] }}"><span class="fa fa-edit"></span> Delete</a>
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
            document.getElementById("barangayTable")
        );
    }
</script>
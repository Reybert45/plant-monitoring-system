<table class="table table-striped" id="genderTable">
    <thead>
        <tr>
            <th>Name</th>
            <th class="w-50">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datatable as $gender)
        <tr>
            <td>{{ $gender['name'] }}</td>
            <td>
                <a type="button" class="btn btn-warning btn-sm edit-btn text-white" data-id="{{ $gender['id'] }}" data-name="{{ $gender['name'] }}" data-bs-toggle="modal" data-bs-target="#editGender"><span class="fa fa-edit"></span> Edit</a>
                <a type="button" class="btn btn-danger btn-sm delete-btn text-white" data-id="{{ $gender['id'] }}"><span class="fa fa-edit"></span> Delete</a>
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
            document.getElementById("genderTable")
        );
    }
</script>
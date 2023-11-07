<table class="table table-striped" id="suffixTable">
    <thead>
        <tr>
            <th>Name</th>
            <th class="w-50">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datatable as $suffix)
        <tr>
            <td>{{ $suffix['name'] }}</td>
            <td>
                <a type="button" class="btn btn-warning btn-sm edit-btn text-white" data-id="{{ $suffix['id'] }}" data-name="{{ $suffix['name'] }}" data-bs-toggle="modal" data-bs-target="#editSuffix"><span class="fa fa-edit"></span> Edit</a>
                <a type="button" class="btn btn-danger btn-sm delete-btn text-white" data-id="{{ $suffix['id'] }}"><span class="fa fa-edit"></span> Delete</a>
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
            document.getElementById("suffixTable")
        );
    }
</script>
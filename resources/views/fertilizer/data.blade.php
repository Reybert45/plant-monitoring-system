<table class="table table-striped" id="fertilizerTable">
    <thead>
        <tr>
            <th>Name</th>
            <th class="w-50">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datatable as $fertilizer)
        <tr>
            <td>{{ $fertilizer['name'] }}</td>
            <td>
                <a type="button" class="btn btn-warning btn-sm edit-btn text-white" data-id="{{ $fertilizer['id'] }}" data-name="{{ $fertilizer['name'] }}" data-bs-toggle="modal" data-bs-target="#editFertilizer"><span class="fa fa-edit"></span> Edit</a>
                <a type="button" class="btn btn-danger btn-sm delete-btn text-white" data-id="{{ $fertilizer['id'] }}"><span class="fa fa-edit"></span> Delete</a>
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
            document.getElementById("fertilizerTable")
        );
    }
</script>
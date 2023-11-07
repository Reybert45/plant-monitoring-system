<table class="table table-striped" id="cityTable">
    <thead>
        <tr>
            <th>Region</th>
            <th>Name</th>
            <th class="w-50">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datatable as $city)
        <tr>
            <td>{{ $city['region'] }}</td>
            <td>{{ $city['name'] }}</td>
            <td>
                <a type="button" class="btn btn-warning btn-sm edit-btn text-white" data-id="{{ $city['id'] }}" data-name="{{ $city['name'] }}" data-region_id="{{ $city['region_id'] }}" data-bs-toggle="modal" data-bs-target="#editCity"><span class="fa fa-edit"></span> Edit</a>
                <a type="button" class="btn btn-danger btn-sm delete-btn text-white" data-id="{{ $city['id'] }}"><span class="fa fa-edit"></span> Delete</a>
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
            document.getElementById("cityTable")
        );
    }
</script>
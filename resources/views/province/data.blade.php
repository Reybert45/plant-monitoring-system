<table class="table table-striped" id="provinceTable">
    <thead>
        <tr>
            <th>City</th>
            <th>Name</th>
            <th class="w-50">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datatable as $province)
        <tr>
            <td>{{ $province['city'] }}</td>
            <td>{{ $province['name'] }}</td>
            <td>
                <a type="button" class="btn btn-warning btn-sm edit-btn text-white" data-id="{{ $province['id'] }}" data-name="{{ $province['name'] }}" data-city_id="{{ $province['city_id'] }}" data-bs-toggle="modal" data-bs-target="#editProvince"><span class="fa fa-edit"></span> Edit</a>
                <a type="button" class="btn btn-danger btn-sm delete-btn text-white" data-id="{{ $province['id'] }}"><span class="fa fa-edit"></span> Delete</a>
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
            document.getElementById("provinceTable")
        );
    }
</script>
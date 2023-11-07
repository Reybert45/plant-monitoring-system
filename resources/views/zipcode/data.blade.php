<table class="table table-striped" id="zipcodeTable">
    <thead>
        <tr>
            <th>Province</th>
            <th>Zip Code</th>
            <th class="w-50">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datatable as $zipcode)
        <tr>
            <td>{{ $zipcode['province'] }}</td>
            <td>{{ $zipcode['name'] }}</td>
            <td>
                <a type="button" class="btn btn-warning btn-sm edit-btn text-white" data-id="{{ $zipcode['id'] }}" data-name="{{ $zipcode['name'] }}" data-province_id="{{ $zipcode['province_id'] }}" data-bs-toggle="modal" data-bs-target="#editZipCode"><span class="fa fa-edit"></span> Edit</a>
                <a type="button" class="btn btn-danger btn-sm delete-btn text-white" data-id="{{ $zipcode['id'] }}"><span class="fa fa-edit"></span> Delete</a>
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
            document.getElementById("zipcodeTable")
        );
    }
</script>
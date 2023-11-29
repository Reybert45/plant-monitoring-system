<table class="table table-striped" id="fertilizerTable">
    <thead>
        <tr>
            <th>Plant</th>
            <th>Link</th>
            <th class="w-50">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datatable as $gardening_essential)
        <tr>
            <td>{{ $gardening_essential['name'] }}</td>
            <td>
                <a href="{{ $gardening_essential['link'] }}" target="_blank">
                    <img src="{{ asset('assets/images/youtube.png') }}" width="50" alt="youtube Link" style="cursor: pointer;" />
                </a>
            </td>
            <td>
                <a type="button" class="btn btn-warning btn-sm edit-btn text-white" data-id="{{ $gardening_essential['id'] }}" data-plant_id="{{ $gardening_essential['plant_id'] }}" data-essential_type_id="{{ $gardening_essential['essential_type_id'] }}" data-link="{{ $gardening_essential['link'] }}" data-bs-toggle="modal" data-bs-target="#editGardeningEssential"><span class="fa fa-edit"></span> Edit</a>
                <a type="button" class="btn btn-danger btn-sm delete-btn text-white" data-id="{{ $gardening_essential['id'] }}"><span class="fa fa-edit"></span> Delete</a>
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
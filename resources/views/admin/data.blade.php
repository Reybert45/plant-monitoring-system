<table class="table table-striped" id="adminTable">
    <thead>
        <tr>
            <th>Name</th>
            <th>Address</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datatable as $admin)
        <tr>
            <td>
                <ul>
                    <li>
                        <h5>{{ $admin['name'] }}</h5>
                    </li>
                    <ul>
                        <li><b>Username:</b> {{ $admin['username'] }}</li>
                        <li><b>Email:</b> {{ $admin['email'] }}</li>
                        <li><b>Password:</b> {{ $admin['password'] }}</li>
                        <li><b>Birthdate:</b> {{ date("F j, Y", strtotime($admin['birthdate'])) }}</li>
                        <li><b>Gender:</b> {{ $admin['gender'] }}</li>
                    </ul>
                </ul>
            </td>
            <td>
                <p>{!! $admin['address'] !!}</p>
            </td>
            <td>
                <a type="button" class="btn btn-warning btn-sm edit-btn text-white m-2" data-id="{{ $admin['id'] }}" data-admin="{{ base64_encode(json_encode($admin)) }}" data-bs-toggle="modal" data-bs-target="#editAdmin"><span class="fa fa-edit"></span> Edit</a>
                <a type="button" class="btn btn-danger btn-sm delete-btn text-white m-2" data-id="{{ $admin['id'] }}"><span class="fa fa-edit"></span> Delete</a>
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
            document.getElementById("adminTable")
        );
    }
</script>
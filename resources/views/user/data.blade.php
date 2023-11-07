<table class="table table-striped" id="userTable">
    <thead>
        <tr>
            <th>Name</th>
            <th>Address</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datatable as $user)
        <tr>
            <td>
                <ul>
                    <li>
                        <h5>{{ $user['name'] }}</h5>
                    </li>
                    <ul>
                        <li><b>Username:</b> {{ $user['username'] }}</li>
                        <li><b>Email:</b> {{ $user['email'] }}</li>
                        <li><b>Password:</b> {{ $user['password'] }}</li>
                        <li><b>Birthdate:</b> {{ date("F j, Y", strtotime($user['birthdate'])) }}</li>
                        <li><b>Gender:</b> {{ $user['gender'] }}</li>
                    </ul>
                </ul>
            </td>
            <td>
                <p>{!! $user['address'] !!}</p>
            </td>
            <td>
                <a type="button" class="btn btn-warning btn-sm edit-btn text-white m-2" data-id="{{ $user['id'] }}" data-user="{{ base64_encode(json_encode($user)) }}" data-bs-toggle="modal" data-bs-target="#editUser"><span class="fa fa-edit"></span> Edit</a>
                <a type="button" class="btn btn-danger btn-sm delete-btn text-white m-2" data-id="{{ $user['id'] }}"><span class="fa fa-edit"></span> Delete</a>
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
            document.getElementById("userTable")
        );
    }
</script>
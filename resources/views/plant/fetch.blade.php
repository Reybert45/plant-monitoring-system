<table class="table" id="plantTable">
    <tbody>
        @foreach ($datatable as $plant)
        <tr>
            <td>
                <table width="100%">
                    <tr>
                        <td style="vertical-align: top !important;" width="10%">
                            <div class="avatar avatar-2xl">
                                <img src="{{ url($plant['image_url']) }}" alt="{{ $plant['name'] }} Image" style="width: 50px; height: 50px;" />
                            </div>
                        </td>
                        <td>
                            <h5>{{ $plant['name'] }}</h5>
                            <div class="progress progress-warning mb-4">
                                <div class="progress-bar progress-label" role="progressbar" style="width: {{ $plant['remaining_percentage'] }}%" aria-valuenow="{{ $plant['remaining_percentage'] }}" aria-valuemin="0" aria-valuemax="{{ $plant['percentage'] }}"></div>
                            </div>
                        </td>
                    </tr>
                </table>
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
            document.getElementById("plantTable")
        );
    }
</script>
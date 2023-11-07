<table class="table table-striped" id="plantTable">
    <thead>
        <tr>
            <th>Image</th>
            {{--  <th class="w-50">Actions</th>  --}}
        </tr>
    </thead>
    <tbody>
        @foreach (array_chunk($datatable , 2) as $plant_list)
        <tr>
            <td>
                <table width="100%">
                    <tr>
                        @foreach ($plant_list as $plant)
                            <td style="vertical-align: top !important;" width="10%">
                                <div class="avatar avatar-2xl">
                                    <img src="{{ url($plant['image_url']) }}" alt="{{ $plant['name'] }} Image" width="300" />
                                </div>
                            </td>
                            <td style="vertical-align: top !important;">
                                <h5>Plant Name: {{ $plant['name'] }}</h5>
                                <p class="mb-0"><b>Harvested Quantity:</b> {{ $plant['quantity'] }} out of {{ $plant['plant_quantity'] }}</p>
                                <p class="mb-0"><b>Date Harvested:</b> {{ date('m/d/Y', strtotime($plant['harvest_date'])) }}</p>
                                <p class="mb-0"><b>Location:</b> {{ $plant['location'] }}</p>
                            </td>
                        @endforeach
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
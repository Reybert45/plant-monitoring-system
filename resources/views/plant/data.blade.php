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
                                    <img src="{{ url($plant['image_url']) }}" alt="{{ $plant['name'] }} Image" width="600" />
                                </div>
                            </td>
                            <td style="vertical-align: top !important;">
                                <h5>Plant Name: {{ $plant['name'] }}</h5>
                                <p class="mb-0" style="text-align: justify;"><b>Decription:</b> {{ $plant['description'] }}</p>
                                <p class="mb-0"><b>Quantity:</b> {{ $plant['quantity'] }}</p>
                                <p class="mb-0"><b>Planting Date:</b> {{ date('m/d/Y', strtotime($plant['planting_date'])) }}</p>
                                <p class="mb-0"><b>Harvest Date:</b> {{ date('m/d/Y', strtotime($plant['harvest_date'])) }}</p>
                                <p class="mb-0"><b>Location:</b> {{ $plant['location'] }}</p>
                                <p class="mb-0"><b>Life Cycle Stage:</b> {{ $plant['life_cycle_stage'] }}</p>
                                <p class="mb-0"><b>Fertilizer:</b> {{ $plant['fertilizer'] }}</p>
                                <p class="mb-0"><b>Watering Schedule:</b> {{ date('m/d/Y h:i:s A', strtotime($plant['watering_schedule'])) }}</p>
                                <br />
                                <a type="button" class="btn btn-warning btn-sm edit-btn text-white" data-id="{{ $plant['id'] }}" data-plant="{{ base64_encode(json_encode($plant)) }}" data-bs-toggle="modal" data-bs-target="#editPlant"><span class="fa fa-edit"></span> Edit</a>
                                <a type="button" class="btn btn-danger btn-sm delete-btn text-white" data-id="{{ $plant['id'] }}"><span class="fa fa-edit"></span> Delete</a>
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
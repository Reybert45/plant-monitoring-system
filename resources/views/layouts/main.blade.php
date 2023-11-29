<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MIFS :: @yield('title')</title>

    <link rel="shortcut icon" href="{{ asset('assets/images/mifs_logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/iconly.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extensions/dripicons/dripicons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extensions/fontawesome/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extensions/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/table-datatable.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extensions/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/iziToast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extensions/filepond/filepond.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/error.css') }}">
</head>

<body>
    <div id="app">
        <div id="sidebar">
            <div class="sidebar-wrapper active">
                @include('layouts/sidebars/sidebar')
            </div>
        </div>
        <div id="main" class='layout-navbar navbar-fixed'>
            @include('layouts/headers/header')
            <div id="main-content">
                @yield('contents')
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('js/moment.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/moment-with-locales.js') }}"></script>
    <script src="{{ asset('assets/static/js/components/dark.js') }}"></script>
    <script src="{{ asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/compiled/js/app.js') }}"></script>
    <script src="{{ asset('assets/static/js/initTheme.js') }}"></script>
    <script src="{{ asset('assets/extensions/toastify-js/src/toastify.js') }}"></script>
    <script src="{{ asset('assets/extensions/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/date-picker.js') }}"></script>
    <script src="{{ asset('js/iziToast.min.js') }}"></script>
    <script src="{{ asset('js/iziToast.js') }}"></script>
    <script src="{{ asset('assets/extensions/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/filepond-plugin-image-crop/filepond-plugin-image-crop.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/filepond-plugin-image-filter/filepond-plugin-image-filter.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/filepond-plugin-image-resize/filepond-plugin-image-resize.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/filepond/filepond.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/filepond.js') }}"></script>
    <script src="{{ asset('assets/extensions/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('fullcalendar/dist/index.global.js') }}"></script>
    <script src="{{ asset('fullcalendar/dist/index.global.min.js') }}"></script>
    <script type="text/javascript">
        // document.addEventListener('contextmenu', event => event.preventDefault());
        // document.onkeydown = function(e) {
        //     if (event.keyCode == 123) {
        //         return false;
        //     }
        //     if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
        //         return false;
        //     }
        //     if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
        //         return false;
        //     }
        //     if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
        //         return false;
        //     }
        // }

        // function killCopy(e) {
        //     return false;
        // }

        // function reEnable() {
        //     return true;
        // }

        // document.onselectstart = new Function("return false");
        // if (window.sidebar) {
        //     document.onmousedown = killCopy;
        //     document.onclick = reEnable;
        // }
        
        $("#viewALlPlants").on('shown.bs.modal', function() {
            $.ajax({
                url: "{{ url('user/plant_list/fetch') }}",
                type: "GET"
            }).then(function(data) {
                $("#plantsDataContainer").html(data);
            });
        });

        $("#plantDetails").on("shown.bs.modal", function(e) {
            var btn = $(e.relatedTarget);
            $.ajax({
                url: "{{ url('user/plant_list/details') }}",
                type: "GET",
                data: {
                    id: btn.data('id')
                }
            }).then(function(data) {
                $("#detail-container").html(data);
            });
        });

        $("#viewRequest").on("shown.bs.modal", function(e) {
            var btn = $(e.relatedTarget);
            var plant = JSON.parse(atob(btn.data('plants_request')));
            $("#createForm").find("input[name='name']").val(plant.name);
            $("#createForm").find("input[name='quantity']").val(plant.quantity);
            $("#createForm").find("select[name='plant_status_id']").val(plant.plant_status_id);
            $("#createForm").find("select[name='life_cycle_stage_id']").val(plant.life_cycle_stage_id);
            $("#createForm").find("select[name='fertilizer_id']").val(plant.fertilizer_id);
            $("#createForm").find("textarea[name='description']").val(plant.description);
            $("#createForm").find("textarea[name='location']").val(plant.location);
            $("#createForm").find("input[name='sow_depth']").val(plant.sow_depth);
            $("#createForm").find("input[name='distance_between_plants']").val(plant.distance_between_plants);
            $("#createForm").find("input[name='lowest_temperature']").val(plant.lowest_temperature);
            $("#createForm").find("input[name='highest_temperature']").val(plant.highest_temperature);
            $("#createForm").find("input[name='days_before_germination']").val(plant.days_before_germination);
            $("#approve-btn").attr("data-id", btn.data('id'));
            $("#disappove-btn").attr("data-id", btn.data('id'));

            flatpickr('.flatpickr-range', {
                dateFormat: "F j, Y", 
                mode: 'range',
                defaultDate: [plant.planting_date + "T00:00:00Z", plant.harvest_date + "T00:00:00Z"]
            });

            var minDate = moment(new Date()).format('YYYY-MM-DD');
            flatpickr('.with-time-flatpickr-no-config', {
                enableTime: true,
                dateFormat: "Y-m-d h:i:s",
                minDate: minDate,
                defaultDate: plant.watering_schedule
            });
        });

        $("#approve-btn").click(function() {
            var id = $(this).data('id');
            var html = $(this).html();
            var btn = $(this);

            $(this).prop("disabled", true);
            $(this).html('<span class="fa fa-spinner fa-spin"></span> Loading...');

            $.ajax({
                url: "{{ url('admin/plant-request/approve') }}",
                type: "POST",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                }
            }).then(function(res) {
                iziToastAlertMain(res, btn, html);
            });
        });

        $("#disappove-btn").click(function() {
            var id = $(this).data('id');
            var html = $(this).html();
            var btn = $(this);

            $(this).prop("disabled", true);
            $(this).html('<span class="fa fa-spinner fa-spin"></span> Loading...');

            $.ajax({
                url: "{{ url('admin/plant-request/disapprove') }}",
                type: "POST",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                }
            }).then(function(res) {
                iziToastAlertMain(res, btn, html);
            });
        });

        function iziToastAlertMain(res, btn, html) {
            let iziToastAlertConf = {
                close: true,
                displayMode: 2,
                layout: 2,
                title: res.status,
                message: res.message,
                position: 'topRight',
                transitionIn: 'bounceInDown',
                transitionOut: 'flipOutX',
                timeout: res.timeout,
            };
        
            if (res.status == "Success") {
                $("#viewRequest").modal("hide");
                iziToast.success(iziToastAlertConf);
                window.location.reload();
            } else {
                iziToast.error(iziToastAlertConf);
            }
        }
    </script>
    @yield('scripts')
</body>

</html>
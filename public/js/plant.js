var token = $("meta[name='csrf-token']").attr("content");
$(document).ready(function() {
    getPlantList();

    $(".reset-btn").click(function() {
        $("#createForm").trigger("reset");
        $("#editForm").trigger("reset");
    });
    $("#add-btn").click(function() {
        var html = $(this).html();
        var btn = $(this);

        $(this).prop("disabled", true);
        $(this).html('<span class="fa fa-spinner fa-spin"></span> Loading...');

        const formData = new FormData(document.getElementById('createForm'));
        formData.append("_token", token);

        $.ajax({
            url: "../admin/plant_list/store",
            type: "POST",
            dataType: "JSON",
            contentType: false,
            processData: false,
            data: formData
        }).then(function(res) {
            iziToastAlert(res, btn, html);
        });
    });

    $("#edit-btn").click(function() {
        var html = $(this).html();
        var btn = $(this);

        $(this).prop("disabled", true);
        $(this).html('<span class="fa fa-spinner fa-spin"></span> Loading...');

        const formData = new FormData(document.getElementById('editForm'));
        formData.append("_token", token);
        formData.append("id", $(this).data('id'));

        $.ajax({
            url: "../admin/plant_list/update",
            type: "POST",
            dataType: "JSON",
            contentType: false,
            processData: false,
            data: formData
        }).then(function(res) {
            iziToastAlert(res, btn, html);
        });
    });
});

function getPlantList() 
{
    $.get("../admin/plant_list/data").then(function(data) {
        $("#data-container").html(data);
    });
}

$("#data-container").on("click", ".delete-btn", function() {
    var id = $(this).data('id');
    var html = $(this).html();
    var btn = $(this);

    $(this).prop("disabled", true);
    $(this).html('<span class="fa fa-spinner fa-spin"></span> Loading...');
    
    $.post("../admin/plant_list/delete?_token="+ token + "&id=" + id).then(function(res) {
        iziToastAlert(res, btn, html);
    });
});

$("#editPlant").on("shown.bs.modal", function(e) {
    let btn = $(e.relatedTarget);
    var plant = JSON.parse(atob(btn.data('plant')));
    $("#editForm").find("input[name='name']").val(plant.name);
    $("#editForm").find("input[name='quantity']").val(plant.quantity);
    $("#editForm").find("select[name='plant_status_id']").val(plant.plant_status_id);
    $("#editForm").find("select[name='life_cycle_stage_id']").val(plant.life_cycle_stage_id);
    $("#editForm").find("select[name='fertilizer_id']").val(plant.fertilizer_id);
    $("#editForm").find("textarea[name='description']").val(plant.description);
    $("#editForm").find("textarea[name='location']").val(plant.location);
    $("#editForm").find("input[name='sow_depth']").val(plant.sow_depth);
    $("#editForm").find("input[name='distance_between_plants']").val(plant.distance_between_plants);
    $("#editForm").find("input[name='lowest_temperature']").val(plant.lowest_temperature);
    $("#editForm").find("input[name='highest_temperature']").val(plant.highest_temperature);
    $("#editForm").find("input[name='days_before_germination']").val(plant.days_before_germination);
    $("#edit-btn").attr("data-id", btn.data('id'));

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

$("#createPlant").on("shown.bs.modal", function() {
    flatpickr('.flatpickr-range', {
        dateFormat: "F j, Y", 
        mode: 'range',
    });

    var minDate = moment(new Date()).format('YYYY-MM-DD');
    flatpickr('.with-time-flatpickr-no-config', {
        enableTime: true,
        dateFormat: "Y-m-d h:i:s",
        minDate: minDate,
    });
});

function iziToastAlert(res, btn, html) {
    let iziToastAlertConf = {
        close: true,
        displayMode: 2,
        layout: 2,
        title: res.status,
        message: res.message,
        position: 'topRight',
        transitionIn: 'bounceInDown',
        transitionOut: 'flipOutX',
        onClosing: function() {
            $(btn).html(html);
            $(btn).prop("disabled", false);
            if (res.status == "Success") {
                getPlantList();
            }
        },
        timeout: res.timeout,
    };

    if (res.status == "Success") {
        $("#createPlant").modal("hide");
        $("#editPlant").modal("hide");
        $("#createForm").trigger("reset");
        $(".filepond--action-remove-item").trigger("click");
        iziToast.success(iziToastAlertConf);
    } else {
        iziToast.error(iziToastAlertConf);
    }
}
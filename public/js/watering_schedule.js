var token = $("meta[name='csrf-token']").attr("content");
$(document).ready(function() {
    getWateringScheduleList();

    $(".reset-btn").click(function() {
        $("#createForm").trigger("reset");
        $("#editForm").trigger("reset");
    });
    $("#add-btn").click(function() {
        var html = $(this).html();
        var btn = $(this);

        $(this).prop("disabled", true);
        $(this).html('<span class="fa fa-spinner fa-spin"></span> Loading...');
        
        $.ajax({
            url: "../user/watering_schedule/store",
            type: "POST",
            data: {
                plant_id: $("#createForm").find("select[name='plant_id']").val(),
                watering_date: $("#createForm").find("input[name='watering_date']").val(),
                watering_time: $("#createForm").find("input[name='watering_time']").val(),
                _token: token
            }
        }).then(function(res) {
            iziToastAlert(res, btn, html);
        });
    });

    $("#save-changes-btn").click(function() {
        var html = $(this).html();
        var btn = $(this);

        var html = $(this).html();
        var btn = $(this);

        $(this).html('<span class="fa fa-spinner fa-spin"></span> Loading...');
        $(this).prop("disabled", true);

        $.ajax({
            url: "../user/watering_schedule/update",
            type: "POST",
            data: {
                id: btn.data('id'),
                watering_date: $("#editForm").find("input[name='watering_date']").val(),
                watering_time: $("#editForm").find("input[name='watering_time']").val(),
                _token: token
            }
        }).then(function(res) {
            iziToastAlert(res, btn, html);
        });
    });
});

function getWateringScheduleList() 
{
    $.get("../user/watering_schedule/data").then(function(data) {
        $("#data-container").html(data);
    });
}

$("#data-container").on("click", ".delete-btn", function() {
    var id = $(this).data('id');
    var html = $(this).html();
    var btn = $(this);

    $(this).prop("disabled", true);
    $(this).html('<span class="fa fa-spinner fa-spin"></span> Loading...');

    $.post("../user/watering_schedule/delete?_token="+ token + "&id=" + id).then(function(res) {
        iziToastAlert(res, btn, html);
    });
});

$("#data-container").on("change", ".status-switch", function() {
    var id = $(this).data("id");

    if($(this).is(":checked")) {
        var status = 1;
    } else {
        var status = 0;
    }

    $.ajax({
        url: "../user/watering_schedule/changeStatus",
        type: "POST",
        data: {
            id: id,
            status: status,
            _token: token
        }
    }).then(function(res) {
        iziToastAlert(res, null, null);
    });
});

$("#editWateringSchedule").on("shown.bs.modal", function(e) {
    let btn = $(e.relatedTarget);
    let watering_schedule = JSON.parse(atob(btn.data('watering_schedule')));

    $("#editForm").find("select[name='plant_id']").val(watering_schedule.plant_id);
    $("#editForm").find("input[name='watering_date']").val(watering_schedule.date);
    $("#editForm").find("input[name='watering_time']").val(watering_schedule.time);
    $("#save-changes-btn").attr("data-id", watering_schedule.id);
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
                getWateringScheduleList();
            }
        },
        timeout: res.timeout,
    };

    if (res.status == "Success") {
        $("#createWateringSchedule").modal("hide");
        $("#editWateringSchedule").modal("hide");
        $("#createForm").trigger("reset");
        iziToast.success(iziToastAlertConf);
    } else {
        iziToast.error(iziToastAlertConf);
    }
}
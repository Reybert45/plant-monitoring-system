var token = $("meta[name='csrf-token']").attr("content");
$(document).ready(function() {
    getCityList();

    $(".reset-btn").click(function() {
        $("#createForm").trigger("reset");
        $("#editForm").trigger("reset");
    });
    $("#add-btn").click(function() {
        var html = $(this).html();
        var btn = $(this);

        $(this).prop("disabled", true);
        $(this).html('<span class="fa fa-spinner fa-spin"></span> Loading...');

        $.post("../admin/city/store?_token="+ token + "&name=" + $("#createForm").find("input[name='name'").val() + "&region_id=" + $("#createForm").find("select[name='region_id'").val()).then(function(res) {
            iziToastAlert(res, btn, html);
        });
    });

    $("#edit-btn").click(function() {
        var html = $(this).html();
        var btn = $(this);

        $(this).prop("disabled", true);
        $(this).html('<span class="fa fa-spinner fa-spin"></span> Loading...');

        $.post("../admin/city/update?_token="+ token + "&id=" +$(this).data('id')+"&name="+$("#editForm").find("input[name='name']").val()+"&region_id="+$("#editForm").find("select[name='region_id']").val()).then(function(res) {
            iziToastAlert(res, btn, html);
        });
    });
});

function getCityList() 
{
    $.get("../admin/city/data").then(function(data) {
        $("#data-container").html(data);
    });
}

$("#data-container").on("click", ".delete-btn", function() {
    var id = $(this).data('id');
    var html = $(this).html();
    var btn = $(this);

    $(this).prop("disabled", true);
    $(this).html('<span class="fa fa-spinner fa-spin"></span> Loading...');

    $.post("../admin/city/delete?_token="+ token + "&id=" + id).then(function(res) {
        iziToastAlert(res, btn, html);
    });
});

$("#editCity").on("shown.bs.modal", function(e) {
    let btn = $(e.relatedTarget);
    $("#editForm").find("input[name='name']").val(btn.data('name'));
    $("#editForm").find("select[name='region_id']").val(btn.data('region_id'));
    $("#edit-btn").attr("data-id", btn.data('id'));
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
                getCityList();
            }
        },
        timeout: res.timeout,
    };

    if (res.status == "Success") {
        $("#createCity").modal("hide");
        $("#editCity").modal("hide");
        $("#createForm").trigger("reset");
        iziToast.success(iziToastAlertConf);
    } else {
        iziToast.error(iziToastAlertConf);
    }
}
var token = $("meta[name='csrf-token']").attr("content");
$(document).ready(function() {
    getStreetList();

    $(".reset-btn").click(function() {
        $("#createForm").trigger("reset");
        $("#editForm").trigger("reset");
    });
    $("#add-btn").click(function() {
        var html = $(this).html();
        var btn = $(this);

        $(this).prop("disabled", true);
        $(this).html('<span class="fa fa-spinner fa-spin"></span> Loading...');

        $.post("../admin/street/store?_token="+ token + "&name=" + $("#createForm").find("input[name='name'").val()).then(function(res) {
            iziToastAlert(res, btn, html);
        });
    });

    $("#edit-btn").click(function() {
        var html = $(this).html();
        var btn = $(this);

        $(this).prop("disabled", true);
        $(this).html('<span class="fa fa-spinner fa-spin"></span> Loading...');

        $.post("../admin/street/update?_token="+ token + "&id=" +$(this).data('id')+"&name="+$("#editForm").find("input[name='name']").val()).then(function(res) {
            iziToastAlert(res, btn, html);
        });
    });
});

function getStreetList() 
{
    $.get("../admin/street/data").then(function(data) {
        $("#data-container").html(data);
    });
}

$("#data-container").on("click", ".delete-btn", function() {
    var id = $(this).data('id');
    var html = $(this).html();
    var btn = $(this);

    $(this).prop("disabled", true);
    $(this).html('<span class="fa fa-spinner fa-spin"></span> Loading...');

    $.post("../admin/street/delete?_token="+ token + "&id=" + id).then(function(res) {
        iziToastAlert(res, btn, html);
    });
});

$("#editStreet").on("shown.bs.modal", function(e) {
    let btn = $(e.relatedTarget);
    $("#editForm").find("input[name='name']").val(btn.data('name'));
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
                getStreetList();
            }
        },
        timeout: res.timeout,
    };

    if (res.status == "Success") {
        $("#createStreet").modal("hide");
        $("#editStreet").modal("hide");
        $("#createForm").trigger("reset");
        iziToast.success(iziToastAlertConf);
    } else {
        iziToast.error(iziToastAlertConf);
    }
}
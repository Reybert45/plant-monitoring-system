var token = $("meta[name='csrf-token']").attr("content");
$(document).ready(function() {
    getZipCodeList();

    $(".reset-btn").click(function() {
        $("#createForm").trigger("reset");
        $("#editForm").trigger("reset");
    });
    $("#add-btn").click(function() {
        var html = $(this).html();
        var btn = $(this);

        $(this).prop("disabled", true);
        $(this).html('<span class="fa fa-spinner fa-spin"></span> Loading...');

        $.post("../admin/zipcode/store?_token="+ token + "&name=" + $("#createForm").find("input[name='name'").val() + "&province_id=" + $("#createForm").find("select[name='province_id'").val()).then(function(res) {
            iziToastAlert(res, btn, html);
        });
    });

    $("#edit-btn").click(function() {
        var html = $(this).html();
        var btn = $(this);

        $(this).prop("disabled", true);
        $(this).html('<span class="fa fa-spinner fa-spin"></span> Loading...');

        $.post("../admin/zipcode/update?_token="+ token + "&id=" +$(this).data('id')+"&name="+$("#editForm").find("input[name='name']").val()+"&province_id="+$("#editForm").find("select[name='province_id']").val()).then(function(res) {
            iziToastAlert(res, btn, html);
        });
    });
});

function getZipCodeList() 
{
    $.get("../admin/zipcode/data").then(function(data) {
        $("#data-container").html(data);
    });
}

$("#data-container").on("click", ".delete-btn", function() {
    var id = $(this).data('id');
    var html = $(this).html();
    var btn = $(this);

    $(this).prop("disabled", true);
    $(this).html('<span class="fa fa-spinner fa-spin"></span> Loading...');

    $.post("../admin/zipcode/delete?_token="+ token + "&id=" + id).then(function(res) {
        iziToastAlert(res, btn, html);
    });
});

$("#editZipCode").on("shown.bs.modal", function(e) {
    let btn = $(e.relatedTarget);
    $("#editForm").find("input[name='name']").val(btn.data('name'));
    $("#editForm").find("select[name='province_id']").val(btn.data('province_id'));
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
                getZipCodeList();
            }
        },
        timeout: res.timeout,
    };

    if (res.status == "Success") {
        $("#createZipCode").modal("hide");
        $("#editZipCode").modal("hide");
        $("#createForm").trigger("reset");
        iziToast.success(iziToastAlertConf);
    } else {
        iziToast.error(iziToastAlertConf);
    }
}
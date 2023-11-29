var token = $("meta[name='csrf-token']").attr("content");
$(document).ready(function() {
    getFertilizerList();

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
        $.ajax({
            url: "../gardening-essential/store",
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
        formData.append("id", btn.data('id'));
        $.ajax({
            url: "../gardening-essential/update",
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

function getFertilizerList() 
{
    $.get("../gardening-essential/data").then(function(data) {
        $("#data-container").html(data);
    });
}

$("#data-container").on("click", ".delete-btn", function() {
    var id = $(this).data('id');
    var html = $(this).html();
    var btn = $(this);

    $(this).prop("disabled", true);
    $(this).html('<span class="fa fa-spinner fa-spin"></span> Loading...');

    $.post("../gardening-essential/delete?_token="+ token + "&id=" + id).then(function(res) {
        iziToastAlert(res, btn, html);
    });
});

$("#editGardeningEssential").on("shown.bs.modal", function(e) {
    let btn = $(e.relatedTarget);
    console.log(btn)
    $("#editForm").find("select[name='plant_id']").val(btn.data('plant_id'));
    $("#editForm").find("select[name='essential_type_id']").val(btn.data('essential_type_id'));
    $("#editForm").find("input[name='link']").val(btn.data('link'));
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
                getFertilizerList();
            }
        },
        timeout: res.timeout,
    };

    if (res.status == "Success") {
        $("#createGardeningEssential").modal("hide");
        $("#editGardeningEssential").modal("hide");
        $("#createForm").trigger("reset");
        iziToast.success(iziToastAlertConf);
    } else {
        iziToast.error(iziToastAlertConf);
    }
}
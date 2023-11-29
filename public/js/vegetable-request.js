var token = $("meta[name='csrf-token']").attr("content");
$(document).ready(function() {
    $(".reset-btn").click(function() {
        $("#requestForm").trigger("reset");
    });
    $("#request-btn").click(function() {
        var html = $(this).html();
        var btn = $(this);

        $(this).prop("disabled", true);
        $(this).html('<span class="fa fa-spinner fa-spin"></span> Loading...');

        const formData = new FormData(document.getElementById('requestForm'));
        formData.append("_token", token);

        $.ajax({
            url: "../plant-request/store",
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
        },
        timeout: res.timeout,
    };

    if (res.status == "Success") {
        $("#requestModal").modal("hide");
        $("#requestForm").trigger("reset");
        $(".filepond--action-remove-item").trigger("click");
        iziToast.success(iziToastAlertConf);
    } else {
        iziToast.error(iziToastAlertConf);
    }
}
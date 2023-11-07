var token = $("meta[name='csrf-token']").attr("content");
$(document).ready(function() {
    getPlantList();
});

function getPlantList() 
{
    $.get("../admin/harvested_plants/data").then(function(data) {
        $("#data-container").html(data);
    });
}

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
        iziToast.success(iziToastAlertConf);
    } else {
        iziToast.error(iziToastAlertConf);
    }
}
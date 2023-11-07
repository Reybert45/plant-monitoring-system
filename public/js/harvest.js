var token = $("meta[name='csrf-token']").attr("content");

$(document).ready(function() {
    $("#plantModal").on("shown.bs.modal", function(e) {
        var img = $(e.relatedTarget);
        var plant = JSON.parse(atob(img.data('plant')));

        $("#plant-title").text(plant.name);
        if(plant.quantity > 1) {
            $("#remaining-quantity").text(" - " + plant.quantity + "pcs. for harvest");
        } else {
            $("#remaining-quantity").text(" - " + plant.quantity + "pc. for harvest");
        }

        $("#harvest-btn").attr("data-id", plant.id);
    });

    $("#harvest-btn").click(function() {
        var id = $(this).data("id");

        var html = $(this).html();
        var btn = $(this);

        $(this).html(`<span class="fa fa-spinner fa-spin"></span> Loading...`);
        $(btn).prop("disabled", true);

        $.ajax({
            url: "../harvest/store",
            type: "POST",
            data: {
                id: id,
                harvested_date: $("#harvest-form").find("input[name='harvested_date']").val(),
                quantity: $("#harvest-form").find("input[name='quantity']").val(),
                amount: $("#harvest-form").find("input[name='amount']").val(),
                _token: token
            }
        }).then(function(res) {
            var iziToastStatus = {
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
                timeout: 1000,
            }

            if(res.status == 'Failed') {
                iziToast.error(iziToastStatus);
            } else {
                iziToast.success(iziToastStatus);
                $("#plantModal").modal("hide");
                getPlants();
                $("#harvest-form").trigger("reset");
            }
        });
    });

    $("#reset-btn").click(function() {
        $("#harvest-form").trigger("reset");
    });
});

function getPlants()
{
    $.ajax({
        url: "../harvest/plants_list",
        type: "GET"
    }).then(function(data) {
        $("#row-gallery").html(data);
    });
}
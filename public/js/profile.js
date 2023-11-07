var token = $("meta[name='csrf-token']").attr("content");
$("#save-information-btn").click(function() {
    var html = $(this).html();
    var btn = $(this);

    $(this).html('<span class="fa fa-spinner fa-spin"></span> Loading...');
    $(this).prop("disabled", true);

    $.ajax({
        url: "../user/my_profile/update",
        type: "POST",
        data: {
            first_name: $("#first_name").val(),
            middle_name: $("#middle_name").val(),
            last_name: $("#last_name").val(),
            suffix_id: $("#suffix_id").val(),
            gender_id: $("#gender_id").val(),
            birthdate: $("#birthdate").val(),
            _token: token
        }
    }).then(function(res) {
        iziToastAlert(res, btn, html);
    });
});

$("#change-password-btn").click(function() {
    var html = $(this).html();
    var btn = $(this);

    $(this).html('<span class="fa fa-spinner fa-spin"></span> Loading...');
    $(this).prop("disabled", true);

    $.ajax({
        url: "../user/my_profile/changepass",
        type: "POST",
        data: {
            old_password: $("#old_password").val(),
            new_password: $("#new_password").val(),
            confirm_password: $("#confirm_password").val(),
            _token: token
        }
    }).then(function(res) {
        iziToastAlert(res, btn, html);
    });
});

$(".update-address-btn").click(function() {
    var address_id = $(this).data('address_id');
    var address_status_name = $(this).data('address_status_name');
    var btn = $(this);
    var html = $(this).html();
    
    $(this).html('<span class="fa fa-spinner fa-spin"></span> Loading...');
    $(this).prop("disabled", true);

    $.ajax({
        url: "../user/my_profile/update_address",
        type: "POST",
        data: {
            address_id: address_id,
            address_status_name: address_status_name,
            street_id: btn.closest(".addressForm").find("select[name='street_id']").val(),
            barangay_id: btn.closest(".addressForm").find("select[name='barangay_id']").val(),
            region_id: btn.closest(".addressForm").find("select[name='region_id']").val(),
            city_id: btn.closest(".addressForm").find("select[name='city_id']").val(),
            province_id: btn.closest(".addressForm").find("select[name='province_id']").val(),
            zipcode_id: btn.closest(".addressForm").find("select[name='zipcode_id']").val(),
            _token: token
        }
    }).then(function(res) {
        iziToastAlert(res, btn, html);
    });
});

$("select[name='street_id']").change(function() {
    var id = $(this).val();
    
    $(this).closest(".addressForm").find("select[name='barangay_id']").val("");
    $.map($(this).closest(".addressForm").find("select[name='barangay_id'] option"), function(option) {
        var street_id = $(option).data('street_id');

        if($(option).val() != "") {
            $(option).prop("hidden", true);
        }

        if(id == street_id) {
            $(option).prop("hidden", false);
        }
    });
});

$("select[name='barangay_id']").change(function() {
    var id = $(this).val();
    
    $(this).closest(".addressForm").find("select[name='region_id']").val("");
    $.map($(this).closest(".addressForm").find("select[name='region_id'] option"), function(option) {
        var barangay_id = $(option).data('barangay_id');

        if($(option).val() != "") {
            $(option).prop("hidden", true);
        }

        if(id == barangay_id) {
            $(option).prop("hidden", false);
        }
    });
});

$("select[name='region_id']").change(function() {
    var id = $(this).val();
    
    $(this).closest(".addressForm").find("select[name='city_id']").val("");
    $.map($(this).closest(".addressForm").find("select[name='city_id'] option"), function(option) {
        var region_id = $(option).data('region_id');

        if($(option).val() != "") {
            $(option).prop("hidden", true);
        }

        if(id == region_id) {
            $(option).prop("hidden", false);
        }
    });
});

$("select[name='city_id']").change(function() {
    var id = $(this).val();
    
    $(this).closest(".addressForm").find("select[name='province_id']").val("");
    $.map($(this).closest(".addressForm").find("select[name='province_id'] option"), function(option) {
        var city_id = $(option).data('city_id');

        if($(option).val() != "") {
            $(option).prop("hidden", true);
        }

        if(id == city_id) {
            $(option).prop("hidden", false);
        }
    });
});

$("select[name='province_id']").change(function() {
    var id = $(this).val();
    
    $(this).closest(".addressForm").find("select[name='zipcode_id']").val("");
    $.map($(this).closest(".addressForm").find("select[name='zipcode_id'] option"), function(option) {
        var province_id = $(option).data('province_id');

        if($(option).val() != "") {
            $(option).prop("hidden", true);
        }

        if(id == province_id) {
            $(option).prop("hidden", false);
        }
    });
});

function iziToastAlert(res, btn, html) {
    let iziToastAlertConf = {
        icon: false,
        close: true,
        displayMode: 1,
        layout: 1,
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
        iziToast.success(iziToastAlertConf);
        $("#securityForm").trigger("reset");
    } else {
        iziToast.error(iziToastAlertConf);
    }
}